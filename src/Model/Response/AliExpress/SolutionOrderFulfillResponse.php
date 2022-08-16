<?php
/**
 * PHP version 7.3
 *
 * @category SolutionOrderFulfillResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */

namespace GeticRetailCrm\Model\Response\AliExpress;

use GeticRetailCrm\Model\Response\AliExpress\Data\SolutionOrderFulfillResponseData;
use GeticRetailCrm\Model\Response\BaseResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SolutionOrderFulfillResponse
 *
 * @category SolutionOrderFulfillResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */
class SolutionOrderFulfillResponse extends BaseResponse
{
    /**
     * @var SolutionOrderFulfillResponseData $responseData
     *
     * @JMS\Type("RetailCrm\Model\Response\AliExpress\Data\SolutionOrderFulfillResponseData")
     * @JMS\SerializedName("aliexpress_solution_order_fulfill_response")
     */
    public $responseData;
}
