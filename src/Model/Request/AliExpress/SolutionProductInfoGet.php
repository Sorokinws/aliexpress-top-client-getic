<?php
/**
 * PHP version 7.3
 *
 * @category SolutionProductInfoGet
 * @package  RetailCrm\Model\Request\AliExpress
 */

namespace GeticRetailCrm\Model\Request\AliExpress;

use JMS\Serializer\Annotation as JMS;
use GeticRetailCrm\Model\Request\BaseRequest;
use GeticRetailCrm\Model\Response\AliExpress\SolutionProductInfoGetResponse;

/**
 * Class SolutionProductInfoGet
 *
 * @category SolutionProductInfoGet
 * @package  RetailCrm\Model\Request\AliExpress
 */
class SolutionProductInfoGet extends BaseRequest
{
    /**
     * @var int $productId
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("product_id")
     */
    public $productId;

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return 'aliexpress.solution.product.info.get';
    }

    /**
     * @inheritDoc
     */
    public function getExpectedResponse(): string
    {
        return SolutionProductInfoGetResponse::class;
    }
}
