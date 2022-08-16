<?php

/**
 * PHP version 7.3
 *
 * @category TopRequestFactory
 * @package  RetailCrm\Factory
 */
namespace GeticRetailCrm\Factory;

use Http\Message\MultipartStream\MultipartStreamBuilder;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use GeticRetailCrm\Component\Exception\FactoryException;
use GeticRetailCrm\Component\Exception\NotImplementedException;
use GeticRetailCrm\Interfaces\AppDataInterface;
use GeticRetailCrm\Interfaces\FileItemInterface;
use GeticRetailCrm\Interfaces\RequestSignerInterface;
use GeticRetailCrm\Interfaces\RequestTimestampProviderInterface;
use GeticRetailCrm\Interfaces\TopRequestFactoryInterface;
use GeticRetailCrm\Model\Request\BaseRequest;
use GeticRetailCrm\Service\RequestDataFilter;
use GeticRetailCrm\Service\TopRequestProcessor;
use UnexpectedValueException;

/**
 * Class TopRequestFactory
 *
 * @category TopRequestFactory
 * @package  RetailCrm\Factory
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class TopRequestFactory implements TopRequestFactoryInterface
{
    /**
     * @var RequestDataFilter $filter
     */
    private $filter;

    /**
     * @var SerializerInterface|\JMS\Serializer\Serializer $serializer
     */
    private $serializer;

    /**
     * @var StreamFactoryInterface $streamFactory
     */
    private $streamFactory;

    /**
     * @var \Psr\Http\Message\RequestFactoryInterface $requestFactory
     */
    private $requestFactory;

    /**
     * @var \Psr\Http\Message\UriFactoryInterface $uriFactory
     */
    private $uriFactory;

    /**
     * @var \RetailCrm\Interfaces\RequestSignerInterface $signer
     */
    private $signer;

    /**
     * @var RequestTimestampProviderInterface $timestampProvider
     */
    private $timestampProvider;

    /**
     * @param \RetailCrm\Interfaces\RequestSignerInterface $signer
     *
     * @return \RetailCrm\Factory\TopRequestFactory
     */
    public function setSigner(RequestSignerInterface $signer): TopRequestFactory
    {
        $this->signer = $signer;
        return $this;
    }

    /**
     * @param \RetailCrm\Interfaces\RequestTimestampProviderInterface $timestampProvider
     *
     * @return \RetailCrm\Factory\TopRequestFactory
     */
    public function setTimestampProvider(RequestTimestampProviderInterface $timestampProvider): TopRequestFactory
    {
        $this->timestampProvider = $timestampProvider;
        return $this;
    }

    /**
     * @param \RetailCrm\Service\RequestDataFilter $filter
     *
     * @return TopRequestFactory
     */
    public function setFilter(RequestDataFilter $filter): TopRequestFactory
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * @param \JMS\Serializer\Serializer|\JMS\Serializer\SerializerInterface $serializer
     *
     * @return TopRequestFactory
     */
    public function setSerializer($serializer): TopRequestFactory
    {
        $this->serializer = $serializer;
        return $this;
    }

    /**
     * @param \Psr\Http\Message\StreamFactoryInterface $streamFactory
     *
     * @return TopRequestFactory
     */
    public function setStreamFactory(StreamFactoryInterface $streamFactory): TopRequestFactory
    {
        $this->streamFactory = $streamFactory;
        return $this;
    }

    /**
     * @param \Psr\Http\Message\RequestFactoryInterface $requestFactory
     *
     * @return TopRequestFactory
     */
    public function setRequestFactory(RequestFactoryInterface $requestFactory): TopRequestFactory
    {
        $this->requestFactory = $requestFactory;
        return $this;
    }

    /**
     * @param \Psr\Http\Message\UriFactoryInterface $uriFactory
     *
     * @return TopRequestFactory
     */
    public function setUriFactory(UriFactoryInterface $uriFactory): TopRequestFactory
    {
        $this->uriFactory = $uriFactory;
        return $this;
    }

    /**
     * @param \RetailCrm\Model\Request\BaseRequest $request
     *
     * @return array
     * @throws \RetailCrm\Component\Exception\FactoryException
     */
    public function getRequestArray(BaseRequest $request): array
    {
        return $this->processRequestArray($this->serializer->toArray($request));
    }

    /**
     * @param \RetailCrm\Model\Request\BaseRequest         $request
     * @param \RetailCrm\Interfaces\AppDataInterface       $appData
     *
     * @return \Psr\Http\Message\RequestInterface
     * @throws \RetailCrm\Component\Exception\FactoryException
     */
    public function fromModel(
        BaseRequest $request,
        AppDataInterface $appData
    ): RequestInterface {
        $request->appKey = $appData->getAppKey();
        $this->timestampProvider->provide($request);
        $requestData = $this->getRequestArray($request);

        try {
            $requestData['sign'] = $this->signer->generateSign($requestData, $appData, $request->signMethod);
        } catch (NotImplementedException $exception) {
            throw new FactoryException(sprintf('Cannot sign request: %s', $exception->getMessage()));
        }

        if ($this->filter->hasBinaryFromRequestData($requestData)) {
            return $this->makeMultipartRequest($appData->getServiceUrl(), $requestData);
        }

        $postData = http_build_query($requestData);

        try {
            return $this->requestFactory
                ->createRequest(
                    'POST',
                    $this->uriFactory->createUri($appData->getServiceUrl())
                )->withBody($this->streamFactory->createStream($postData))
                ->withHeader('content-type', 'application/x-www-form-urlencoded; charset=UTF-8');
        } catch (\Exception $exception) {
            throw new FactoryException(
                sprintf('Error building request: %s', $exception->getMessage()),
                0,
                $exception
            );
        }
    }

    /**
     * @param array $requestData
     *
     * @return array
     * @throws \RetailCrm\Component\Exception\FactoryException
     */
    protected function processRequestArray(array $requestData): array
    {
        foreach ($requestData as $key => $value) {
            if ($value instanceof FileItemInterface) {
                continue;
            }

            $requestData[$key] = $this->castValue($value);
        }

        if (empty($requestData)) {
            throw new FactoryException('Empty request data');
        }

        ksort($requestData);

        return $requestData;
    }

    /**
     * @param string $endpoint
     * @param array  $contents
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    private function makeMultipartRequest(string $endpoint, array $contents): RequestInterface
    {
        $builder = new MultipartStreamBuilder($this->streamFactory);

        foreach ($contents as $param => $value) {
            if ($value instanceof FileItemInterface) {
                $builder->addResource($param, $value->getStream(), ['filename' => $value->getFileName()]);
            } else {
                $builder->addResource($param, $value);
            }
        }

        $stream = $builder->build();

        if ($stream->isSeekable()) {
            $stream->seek(0);
        }

        return $this->requestFactory
            ->createRequest('POST', $this->uriFactory->createUri($endpoint))
            ->withBody($stream)
            ->withHeader('Content-Type', 'multipart/form-data; boundary="'.$builder->getBoundary().'"')
            ->withHeader('Content-Length', $stream->getSize());
    }

    /**
     * Cast any type to one supported by MultipartStreamBuilder. NULL should be ignored.
     *
     * @param mixed $value
     *
     * @return string|resource|null
     * @todo Arrays will be encoded to JSON. Is this correct? Press X to doubt.
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    private function castValue($value)
    {
        $type = gettype($value);

        switch ($type) {
            case 'resource':
            case 'NULL':
                return $value;
            case 'boolean':
                return $value ? 'true' : 'false';
            case 'integer':
            case 'double':
            case 'string':
                return (string) $value;
            case 'array':
            case 'object':
                return (string) $this->serializer->serialize($value, 'json');
            default:
                throw new UnexpectedValueException(sprintf('Got value with unsupported type: %s', $type));
        }
    }
}
