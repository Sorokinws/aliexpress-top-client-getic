<?php

/**
 * PHP version 7.3
 *
 * @category TopClient
 * @package  RetailCrm\TopClient
 */
namespace GeticRetailCrm\TopClient;

use JMS\Serializer\SerializerInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use GeticRetailCrm\Builder\AuthorizationUriBuilder;
use GeticRetailCrm\Component\Environment;
use GeticRetailCrm\Component\Exception\TopApiException;
use GeticRetailCrm\Component\Exception\TopClientException;
use GeticRetailCrm\Component\OAuthTokenFetcher;
use GeticRetailCrm\Component\ServiceLocator;
use GeticRetailCrm\Component\Storage\ProductSchemaStorage;
use GeticRetailCrm\Factory\ProductSchemaStorageFactory;
use GeticRetailCrm\Interfaces\AppDataInterface;
use GeticRetailCrm\Interfaces\AuthenticatorInterface;
use GeticRetailCrm\Interfaces\BuilderInterface;
use GeticRetailCrm\Interfaces\TopClientInterface;
use GeticRetailCrm\Interfaces\TopRequestFactoryInterface;
use GeticRetailCrm\Model\Request\BaseRequest;
use GeticRetailCrm\Model\Response\BaseResponse;
use GeticRetailCrm\Model\Response\TopResponseInterface;
use GeticRetailCrm\Traits\ValidatorAwareTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class TopClient
 *
 * @category TopClient
 * @package  RetailCrm\TopClient
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class TopClient implements TopClientInterface
{
    use ValidatorAwareTrait;

    /**
     * @var \RetailCrm\Interfaces\AppDataInterface $appData
     */
    protected $appData;

    /**
     * @var ClientInterface $httpClient
     * @Assert\NotNull(message="HTTP client should be provided")
     */
    protected $httpClient;

    /**
     * @var \RetailCrm\Interfaces\TopRequestFactoryInterface $requestFactory
     * @Assert\NotNull(message="RequestFactoryInterface should be provided")
     */
    protected $requestFactory;

    /**
     * @var SerializerInterface $serializer
     * @Assert\NotNull(message="Serializer should be provided")
     */
    protected $serializer;

    /**
     * @var \RetailCrm\Component\ServiceLocator $serviceLocator
     */
    protected $serviceLocator;

    /**
     * @var \RetailCrm\Interfaces\AuthenticatorInterface $authenticator
     */
    protected $authenticator;

    /**
     * @var ProductSchemaStorageFactory $productSchemaStorageFactory
     */
    protected $productSchemaStorageFactory;

    /**
     * @var \Psr\Log\LoggerInterface $logger
     */
    protected $logger;

    /**
     * @var Environment $environment
     */
    protected $env;

    /**
     * TopClient constructor.
     *
     * @param \RetailCrm\Interfaces\AppDataInterface       $appData
     */
    public function __construct(AppDataInterface $appData)
    {
        $this->appData = $appData;
    }

    /**
     * @throws \RetailCrm\Component\Exception\ValidationException
     */
    public function validateSelf(): void
    {
        $this->validate($this);
        $this->validate($this->appData);
    }

    /**
     * @param \Psr\Http\Client\ClientInterface $httpClient
     */
    public function setHttpClient(ClientInterface $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param \JMS\Serializer\SerializerInterface $serializer
     */
    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }

    /**
     * @param \RetailCrm\Interfaces\TopRequestFactoryInterface $requestFactory
     */
    public function setRequestFactory(TopRequestFactoryInterface $requestFactory): void
    {
        $this->requestFactory = $requestFactory;
    }

    /**
     * @param \RetailCrm\Component\ServiceLocator $serviceLocator
     */
    public function setServiceLocator(ServiceLocator $serviceLocator): void
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @param \RetailCrm\Interfaces\AuthenticatorInterface $authenticator
     *
     * @return TopClient
     */
    public function setAuthenticator(AuthenticatorInterface $authenticator): TopClient
    {
        $this->authenticator = $authenticator;
        return $this;
    }

    /**
     * @param \RetailCrm\Factory\ProductSchemaStorageFactory $productSchemaStorageFactory
     *
     * @return TopClient
     */
    public function setProductSchemaStorageFactory(ProductSchemaStorageFactory $productSchemaStorageFactory): TopClient
    {
        $this->productSchemaStorageFactory = $productSchemaStorageFactory;
        return $this;
    }

    /**
     * @param \Psr\Log\LoggerInterface $logger
     *
     * @return TopClient
     */
    public function setLogger(LoggerInterface $logger): TopClient
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @param \RetailCrm\Component\Environment $env
     *
     * @return TopClient
     */
    public function setEnv(Environment $env): TopClient
    {
        $this->env = $env;
        return $this;
    }

    /**
     * @return \RetailCrm\Component\ServiceLocator
     */
    public function getServiceLocator(): ServiceLocator
    {
        return $this->serviceLocator;
    }

    /**
     * @param string $state
     *
     * @return BuilderInterface
     */
    public function getAuthorizationUriBuilder(string $state = ''): BuilderInterface
    {
        return new AuthorizationUriBuilder($this->appData->getAppKey(), $this->appData->getRedirectUri(), $state);
    }

    /**
     * @return \RetailCrm\Component\OAuthTokenFetcher
     */
    public function getTokenFetcher(): OAuthTokenFetcher
    {
        return $this->getServiceLocator()->getOAuthTokenFetcherFactory()->create($this->appData);
    }

    /**
     * @return \RetailCrm\Component\Storage\ProductSchemaStorage
     */
    public function getProductSchemaStorage(): ProductSchemaStorage
    {
        return $this->productSchemaStorageFactory->setClient($this)->create();
    }

    /**
     * Send TOP request. Can throw several exceptions:
     *  - ValidationException - when request didn't pass validation.
     *  - FactoryException - when PSR-7 request cannot be built.
     *  - TopClientException - when PSR-7 request cannot be processed by client, or xml mode is used
     *    (always use JSON mode, it's already chosen in the BaseRequest model). Previous error will contain HTTP
     *    client processing error (if it's present).
     *  - TopApiException - when request is not processed and API returned error. Note: this exception is only thrown
     *    when request cannot be processed by API at all (for example, if signature is invalid). It will not be thrown
     *    if request was processed, but API returned error in the response result. In that case you can use error fields
     *    from the response result itself; those results implement ErrorInterface via ErrorTrait.
     *    However, some result classes may contain different format for error data. Those result classes won't implement
     *    ErrorInterface - you can use `instanceof` to differentiate such results from the others. This inconsistency
     *    is brought by the API design itself, and cannot be easily removed.
     *
     * @param \RetailCrm\Model\Request\BaseRequest $request
     *
     * @return TopResponseInterface
     * @throws \RetailCrm\Component\Exception\ValidationException
     * @throws \RetailCrm\Component\Exception\FactoryException
     * @throws \RetailCrm\Component\Exception\TopClientException
     * @throws \RetailCrm\Component\Exception\TopApiException
     */
    public function sendRequest(BaseRequest $request): TopResponseInterface
    {
        if ('json' !== $request->format) {
            throw new TopClientException(sprintf('TopClient only supports JSON mode, got `%s` mode', $request->format));
        }

        $httpRequest = $this->requestFactory->fromModel($request, $this->appData);

        try {
            $httpResponse = $this->httpClient->sendRequest($httpRequest);
        } catch (ClientExceptionInterface $exception) {
            throw new TopClientException(sprintf('Error sending request: %s', $exception->getMessage()), 0, $exception);
        }

        $bodyData = self::getBodyContents($httpResponse->getBody());

        if ($this->debugLogging()) {
            $this->logger->debug(sprintf(
                '<AliExpress TOP Client> Request %s (%s) (%s): got response %s',
                $request->getMethod(),
                $httpRequest->getUri()->__toString(),
                $httpRequest->getBody()->__toString(),
                $bodyData
            ));
        }

        /** @var BaseResponse $response */
        $response = $this->serializer->deserialize(
            $bodyData,
            $request->getExpectedResponse(),
            $request->format
        );

        if (!($response instanceof BaseResponse) && !is_subclass_of($response, BaseResponse::class)) {
            throw new TopClientException(sprintf('Invalid response class: %s', get_class($response)));
        }

        if (null !== $response->errorResponse) {
            if ($this->debugLogging()) {
                $this->logger->debug(sprintf(
                    '<AliExpress TOP Client> Request %s (%s) (%s): got error response %s',
                    $request->getMethod(),
                    $httpRequest->getUri()->__toString(),
                    $httpRequest->getBody()->__toString(),
                    $bodyData
                ));
            }

            throw new TopApiException($response->errorResponse);
        }

        return $response;
    }

    /**
     * Send authenticated TOP request. Authenticator should be present in order to use this method.
     *
     * @param \RetailCrm\Model\Request\BaseRequest $request
     *
     * @return \RetailCrm\Model\Response\TopResponseInterface
     * @throws \RetailCrm\Component\Exception\FactoryException
     * @throws \RetailCrm\Component\Exception\TopApiException
     * @throws \RetailCrm\Component\Exception\TopClientException
     * @throws \RetailCrm\Component\Exception\ValidationException
     */
    public function sendAuthenticatedRequest(BaseRequest $request): TopResponseInterface
    {
        if (null === $this->authenticator) {
            throw new TopClientException('Authenticator is not provided');
        }

        $this->authenticator->authenticate($request);

        return $this->sendRequest($request);
    }

    /**
     * @return bool
     */
    protected function debugLogging(): bool
    {
        return null !== $this->logger && !($this->logger instanceof NullLogger) && $this->env->isDebug();
    }

    /**
     * Returns body stream data (it should work like that in order to keep compatibility with some implementations).
     *
     * @param \Psr\Http\Message\StreamInterface $stream
     *
     * @return string
     */
    protected static function getBodyContents(StreamInterface $stream): string
    {
        return $stream->isSeekable() ? $stream->__toString() : $stream->getContents();
    }
}
