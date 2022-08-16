<?php
/**
 * PHP version 7.3
 *
 * @category SolutionSellerCategoryTreeQueryResponseData
 * @package  RetailCrm\Model\Response\AliExpress\Data
 */

namespace GeticRetailCrm\Model\Response\AliExpress\Data;

use JMS\Serializer\Annotation as JMS;
use GeticRetailCrm\Model\Response\AbstractResponseData;

/**
 * Class SolutionSellerCategoryTreeQueryResponseData
 *
 * @category SolutionSellerCategoryTreeQueryResponseData
 * @package  RetailCrm\Model\Response\AliExpressSolution\Data
 */
class SolutionSellerCategoryTreeQueryResponseData extends AbstractResponseData
{
    /**
     * @var SolutionSellerCategoryTreeQueryResponseDataChildrenCategoryList
     *
     * @JMS\Type("RetailCrm\Model\Response\AliExpress\Data\SolutionSellerCategoryTreeQueryResponseDataChildrenCategoryList")
     * @JMS\SerializedName("children_category_list")
     */
    public $childrenCategoryList;

    /**
     * @var bool $isSuccess
     *
     * @JMS\Type("bool")
     * @JMS\SerializedName("is_success")
     */
    public $isSuccess;
}
