<?php
/**
 * PHP version 7.3
 *
 * @category SolutionProductSchemaGet
 * @package  RetailCrm\Model\Request\AliExpress
 */

namespace GeticRetailCrm\Model\Request\AliExpress;

use JMS\Serializer\Annotation as JMS;
use GeticRetailCrm\Model\Request\BaseRequest;
use Symfony\Component\Validator\Constraints as Assert;
use GeticRetailCrm\Model\Response\AliExpress\SolutionProductSchemaGetResponse;

/**
 * Class SolutionProductSchemaGet
 *
 * @category SolutionProductSchemaGet
 * @package  RetailCrm\Model\Request\AliExpress
 */
class SolutionProductSchemaGet extends BaseRequest
{
    /**
     * @var int $aliexpressCategoryId
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("aliexpress_category_id")
     * @Assert\NotBlank()
     */
    public $aliexpressCategoryId;

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return 'aliexpress.solution.product.schema.get';
    }

    /**
     * @inheritDoc
     */
    public function getExpectedResponse(): string
    {
        return SolutionProductSchemaGetResponse::class;
    }
}
