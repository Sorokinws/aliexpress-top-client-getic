<?php
/**
 * PHP version 7.3
 *
 * @category SolutionOrderGetResponseResult
 * @package  RetailCrm\Model\Response\AliExpress\Result
 */

namespace GeticRetailCrm\Model\Response\AliExpress\Result;

use GeticRetailCrm\Model\Response\AliExpress\Result\Interfaces\ErrorInterface;
use GeticRetailCrm\Model\Response\AliExpress\Result\Traits\ErrorTrait;
use JMS\Serializer\Annotation as JMS;
use GeticRetailCrm\Model\Response\AliExpress\Result\Traits\SuccessTrait;

/**
 * Class SolutionOrderGetResponseResult
 *
 * @category SolutionOrderGetResponseResult
 * @package  RetailCrm\Model\Response\AliExpress\Result
 */
class SolutionOrderGetResponseResult implements ErrorInterface
{
    use ErrorTrait;
    use SuccessTrait;

    /**
     * @var int $totalCount
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("total_count")
     */
    public $totalCount;

    /**
     * @var \RetailCrm\Model\Response\AliExpress\Result\Entity\OrderDtoList $targetList
     *
     * @JMS\Type("RetailCrm\Model\Response\AliExpress\Result\Entity\OrderDtoList")
     * @JMS\SerializedName("target_list")
     */
    public $targetList;

    /**
     * @var int $pageSize
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("page_size")
     */
    public $pageSize;

    /**
     * @var int $currentPage
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("current_page")
     */
    public $currentPage;

    /**
     * @var int $totalPage
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("total_page")
     */
    public $totalPage;

    /**
     * @var string $timestamp
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("time_stamp")
     */
    public $timeStamp;
}
