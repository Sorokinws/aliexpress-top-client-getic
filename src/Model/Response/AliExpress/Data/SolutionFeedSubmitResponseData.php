<?php
/**
 * PHP version 7.3
 *
 * @category SolutionFeedSubmitResponseData
 * @package  RetailCrm\Model\Response\AliExpress\Data
 */

namespace GeticRetailCrm\Model\Response\AliExpress\Data;

use GeticRetailCrm\Model\Response\AbstractResponseData;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SolutionFeedSubmitResponseData
 *
 * @category SolutionFeedSubmitResponseData
 * @package  RetailCrm\Model\Response\AliExpress\Data
 */
class SolutionFeedSubmitResponseData extends AbstractResponseData
{
    /**
     * @var int $jobId
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("job_id")
     */
    public $jobId;
}
