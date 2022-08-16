<?php
/**
 * PHP version 7.3
 *
 * @category SolutionBatchProductInventoryUpdateResponseData
 * @package  RetailCrm\Model\Response\AliExpress\Data
 */

namespace GeticRetailCrm\Model\Response\AliExpress\Data;

use JMS\Serializer\Annotation as JMS;

/**
 * Class SolutionBatchProductInventoryUpdateResponseData
 *
 * @category SolutionBatchProductInventoryUpdateResponseData
 * @package  RetailCrm\Model\Response\AliExpress\Data
 */
class SolutionBatchProductInventoryUpdateResponseData
{

    /**
     * @var string $updateErrorCode
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("update_error_code")
     */
    public $updateErrorCode;

    /**
     * @var string $updateErrorMessage
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("update_error_message")
     */
    public $updateErrorMessage;

    /**
     * @var string $updateSuccess
     *
     * @JMS\Type("boolean")
     * @JMS\SerializedName("update_success")
     */
    public $updateSuccess;

    /**
     * @var \RetailCrm\Model\Response\AliExpress\Result\Entity\SynchronizeProductResponseList $updateFailedList
     *
     * @JMS\Type("RetailCrm\Model\Response\AliExpress\Result\Entity\SynchronizeProductResponseList")
     * @JMS\SerializedName("update_failed_list")
     */
    public $updateFailedList;

    /**
     * @var \RetailCrm\Model\Response\AliExpress\Result\Entity\SynchronizeProductResponseList $updateSuccessfulList
     *
     * @JMS\Type("RetailCrm\Model\Response\AliExpress\Result\Entity\SynchronizeProductResponseList")
     * @JMS\SerializedName("update_successful_list")
     */
    public $updateSuccessfulList;
}
