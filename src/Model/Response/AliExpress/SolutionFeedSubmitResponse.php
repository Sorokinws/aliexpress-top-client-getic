<?php
/**
 * PHP version 7.3
 *
 * @category SolutionFeedSubmitResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */

namespace GeticRetailCrm\Model\Response\AliExpress;

use GeticRetailCrm\Model\Response\BaseResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SolutionFeedSubmitResponse
 *
 * @category SolutionFeedSubmitResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */
class SolutionFeedSubmitResponse extends BaseResponse
{
    /**
     * @var \RetailCrm\Model\Response\AliExpress\Data\SolutionFeedSubmitResponseData $responseData
     *
     * @JMS\Type("RetailCrm\Model\Response\AliExpress\Data\SolutionFeedSubmitResponseData")
     * @JMS\SerializedName("aliexpress_solution_feed_submit_response")
     */
    public $responseData;
}
