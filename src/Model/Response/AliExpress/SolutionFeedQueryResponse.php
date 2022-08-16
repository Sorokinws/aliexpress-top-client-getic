<?php
/**
 * PHP version 7.3
 *
 * @category SolutionFeedQueryResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */

namespace GeticRetailCrm\Model\Response\AliExpress;

use GeticRetailCrm\Model\Response\BaseResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SolutionFeedQueryResponse
 *
 * @category SolutionFeedQueryResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */
class SolutionFeedQueryResponse extends BaseResponse
{
    /**
     * @var \RetailCrm\Model\Response\AliExpress\Data\SolutionFeedQueryResponseData $responseData
     *
     * @JMS\Type("RetailCrm\Model\Response\AliExpress\Data\SolutionFeedQueryResponseData")
     * @JMS\SerializedName("aliexpress_solution_feed_query_response")
     */
    public $responseData;
}
