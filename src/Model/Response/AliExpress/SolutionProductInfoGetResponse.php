<?php
/**
 * PHP version 7.3
 *
 * @category SolutionProductInfoGetResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */

namespace GeticRetailCrm\Model\Response\AliExpress;

use GeticRetailCrm\Model\Response\BaseResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SolutionProductInfoGetResponse
 *
 * @category SolutionProductInfoGetResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */
class SolutionProductInfoGetResponse extends BaseResponse
{
    /**
     * @var \RetailCrm\Model\Response\AliExpress\Data\SolutionProductInfoGetResponseData $responseData
     *
     * @JMS\Type("RetailCrm\Model\Response\AliExpress\Data\SolutionProductInfoGetResponseData")
     * @JMS\SerializedName("aliexpress_solution_product_info_get_response")
     */
    public $responseData;
}
