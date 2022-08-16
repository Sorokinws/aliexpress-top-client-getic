<?php
/**
 * PHP version 7.3
 *
 * @category SolutionFeedListGetResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */

namespace GeticRetailCrm\Model\Response\AliExpress;

use GeticRetailCrm\Model\Response\BaseResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SolutionFeedListGetResponse
 *
 * @category SolutionFeedListGetResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */
class SolutionFeedListGetResponse extends BaseResponse
{
    /**
     * @var \RetailCrm\Model\Response\AliExpress\Data\SolutionFeedListGetResponseData $responseData
     *
     * @JMS\Type("RetailCrm\Model\Response\AliExpress\Data\SolutionFeedListGetResponseData")
     * @JMS\SerializedName("aliexpress_solution_feed_list_get_response")
     */
    public $responseData;
}
