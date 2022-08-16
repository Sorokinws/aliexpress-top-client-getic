<?php
/**
 * PHP version 7.3
 *
 * @category SolutionProductSchemaGetResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */

namespace GeticRetailCrm\Model\Response\AliExpress;

use GeticRetailCrm\Model\Response\AliExpress\Data\SolutionProductSchemaGetResponseData;
use GeticRetailCrm\Model\Response\BaseResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SolutionProductSchemaGetResponse
 *
 * @category SolutionProductSchemaGetResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */
class SolutionProductSchemaGetResponse extends BaseResponse
{
    /**
     * @var SolutionProductSchemaGetResponseData $responseData
     *
     * @JMS\Type("RetailCrm\Model\Response\AliExpress\Data\SolutionProductSchemaGetResponseData")
     * @JMS\SerializedName("aliexpress_solution_product_schema_get_response")
     */
    public $responseData;
}
