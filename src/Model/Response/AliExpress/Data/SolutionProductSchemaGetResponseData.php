<?php
/**
 * PHP version 7.3
 *
 * @category SolutionProductSchemaGetResponseData
 * @package  RetailCrm\Model\Response\AliExpress\Data
 */

namespace GeticRetailCrm\Model\Response\AliExpress\Data;

use JMS\Serializer\Annotation as JMS;

/**
 * Class SolutionProductSchemaGetResponseData
 *
 * @category SolutionProductSchemaGetResponseData
 * @package  RetailCrm\Model\Response\AliExpress\Data
 */
class SolutionProductSchemaGetResponseData
{
    /**
     * @var \RetailCrm\Model\Response\AliExpress\Result\SolutionProductSchemaGetResponseResult $result
     *
     * @JMS\Type("RetailCrm\Model\Response\AliExpress\Result\SolutionProductSchemaGetResponseResult")
     * @JMS\SerializedName("result")
     */
    public $result;
}
