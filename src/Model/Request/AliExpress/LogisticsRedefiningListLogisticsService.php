<?php
/**
 * PHP version 7.3
 *
 * @category LogisticsRedefiningListLogisticsService
 * @package  RetailCrm\Model\Request\AliExpress
 */

namespace GeticRetailCrm\Model\Request\AliExpress;

use GeticRetailCrm\Model\Request\BaseRequest;
use GeticRetailCrm\Model\Response\AliExpress\LogisticsRedefiningListLogisticsServiceResponse;

/**
 * Class LogisticsRedefiningListLogisticsService
 *
 * @category LogisticsRedefiningListLogisticsService
 * @package  RetailCrm\Model\Request\AliExpress
 */
class LogisticsRedefiningListLogisticsService extends BaseRequest
{
    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return 'aliexpress.logistics.redefining.listlogisticsservice';
    }

    /**
     * @inheritDoc
     */
    public function getExpectedResponse(): string
    {
        return LogisticsRedefiningListLogisticsServiceResponse::class;
    }
}
