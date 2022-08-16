<?php

/**
 * PHP version 7.3
 *
 * @category HttpDnsGetResponse
 * @package  RetailCrm\Model\Response\Taobao
 */
namespace GeticRetailCrm\Model\Response\Taobao;

use JMS\Serializer\Annotation as JMS;
use GeticRetailCrm\Model\Response\BaseResponse;

/**
 * Class HttpDnsGetResponse
 *
 * @category HttpDnsGetResponse
 * @package  RetailCrm\Model\Response\Taobao
 */
class HttpDnsGetResponse extends BaseResponse
{
    /**
     * @var \RetailCrm\Model\Response\Taobao\Data\HttpDnsGetResponseData $responseData
     *
     * @JMS\Type("RetailCrm\Model\Response\Taobao\Data\HttpDnsGetResponseData")
     * @JMS\SerializedName("httpdns_get_response")
     */
    public $responseData;
}
