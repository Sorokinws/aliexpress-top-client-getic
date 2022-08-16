<?php

/**
 * PHP version 7.3
 *
 * @category RequestSigner
 * @package  RetailCrm\Service
 */
namespace GeticRetailCrm\Service;

use GeticRetailCrm\Component\Exception\NotImplementedException;
use GeticRetailCrm\Interfaces\AppDataInterface;
use GeticRetailCrm\Interfaces\RequestSignerInterface;
use GeticRetailCrm\Model\Enum\AvailableSignMethods;

/**
 * Class RequestSigner
 *
 * @category RequestSigner
 * @package  RetailCrm\Service
 */
class RequestSigner implements RequestSignerInterface
{
    /**
     * @var RequestDataFilter $filter
     */
    private $filter;

    /**
     * RequestSigner constructor.
     *
     * @param \RetailCrm\Service\RequestDataFilter $filter
     */
    public function __construct(RequestDataFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @param array                                  $request
     * @param \RetailCrm\Interfaces\AppDataInterface $appData
     * @param string                                 $signMethod
     *
     * @return string
     * @throws \RetailCrm\Component\Exception\NotImplementedException
     */
    public function generateSign(array $request, AppDataInterface $appData, string $signMethod): string
    {
        $stringToBeSigned = '';
        $params           = $this->getDataForSigning($request);

        foreach ($params as $param => $value) {
            $stringToBeSigned .= $param . $value;
        }

        switch ($signMethod) {
            case AvailableSignMethods::MD5:
                $stringToBeSigned = $appData->getAppSecret() . $stringToBeSigned . $appData->getAppSecret();
                return strtoupper(md5($stringToBeSigned));
            case AvailableSignMethods::HMAC_MD5:
                return strtoupper(hash_hmac('md5', $stringToBeSigned, $appData->getAppSecret()));
            default:
                throw new NotImplementedException(sprintf('Invalid signing method: %s', $signMethod));
        }
    }

    /**
     * @param array $request
     *
     * @return array
     */
    private function getDataForSigning(array $request): array
    {
        $params = $this->filter->filterBinaryFromRequestData($request);

        unset($params['sign']);
        ksort($params);

        return $params;
    }
}
