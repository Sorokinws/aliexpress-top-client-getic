<?php
/**
 * PHP version 7.3
 *
 * @category SynchronizeProductResponseList
 * @package  RetailCrm\Model\Response\AliExpress\Result\Entity
 */

namespace GeticRetailCrm\Model\Response\AliExpress\Result\Entity;

use JMS\Serializer\Annotation as JMS;
use GeticRetailCrm\Model\Response\AliExpress\Result\Entity\SynchronizeProductResponseDto;

/**
 * Class SynchronizeProductResponseList
 *
 * @category SynchronizeProductResponseList
 * @package  RetailCrm\Model\Response\AliExpress\Result\Entity
 */
class SynchronizeProductResponseList
{
    /**
     * @var SynchronizeProductResponseDto[] $synchronizeProductResponseDto
     *
     * @JMS\Type("array<RetailCrm\Model\Response\AliExpress\Result\Entity\SynchronizeProductResponseDto>")
     * @JMS\SerializedName("synchronize_product_response_dto")
     */
    public $synchronizeProductResponseDto;
}
