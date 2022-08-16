<?php
/**
 * PHP version 7.3
 *
 * @category PostproductRedefiningCategoryForecastResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */

namespace GeticRetailCrm\Model\Response\AliExpress;

use GeticRetailCrm\Model\Response\AliExpress\Data\PostproductRedefiningCategoryForecastResponseData;
use GeticRetailCrm\Model\Response\BaseResponse;

use JMS\Serializer\Annotation as JMS;

/**
 * Class PostproductRedefiningCategoryForecastResponse
 *
 * @category PostproductRedefiningCategoryForecastResponse
 * @package  RetailCrm\Model\Response\AliExpress
 */
class PostproductRedefiningCategoryForecastResponse extends BaseResponse
{
    /**
     * @var PostproductRedefiningCategoryForecastResponseData $responseData
     *
     * @JMS\Type("RetailCrm\Model\Response\AliExpress\Data\PostproductRedefiningCategoryForecastResponseData")
     * @JMS\SerializedName("aliexpress_postproduct_redefining_categoryforecast_response")
     */
    public $responseData;
}
