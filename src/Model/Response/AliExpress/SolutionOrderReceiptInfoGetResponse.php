<?php
/**
 * PHP version 7.3
 *
 * @category SolutionOrderReceiptInfoGetResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */

namespace GeticRetailCrm\Model\Response\AliExpress;

use GeticRetailCrm\Model\Response\AliExpress\Data\SolutionOrderReceiptInfoGetResponseData;
use GeticRetailCrm\Model\Response\BaseResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SolutionOrderReceiptInfoGetResponse
 *
 * @category SolutionOrderReceiptInfoGetResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */
class SolutionOrderReceiptInfoGetResponse extends BaseResponse
{
    /**
     * @var SolutionOrderReceiptInfoGetResponseData $responseData
     *
     * @JMS\Type("RetailCrm\Model\Response\AliExpress\Data\SolutionOrderReceiptInfoGetResponseData")
     * @JMS\SerializedName("aliexpress_solution_order_receiptinfo_get_response")
     */
    public $responseData;
}
