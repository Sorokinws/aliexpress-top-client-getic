<?php
/**
 * PHP version 7.3
 *
 * @category SolutionMerchantProfileGet
 * @package  RetailCrm\Model\Request\AliExpress
 */

namespace GeticRetailCrm\Model\Request\AliExpress;

use GeticRetailCrm\Model\Request\BaseRequest;
use GeticRetailCrm\Model\Response\AliExpress\SolutionMerchantProfileGetResponse;

/**
 * Class SolutionMerchantProfileGet
 *
 * @category SolutionMerchantProfileGet
 * @package  RetailCrm\Model\Request\AliExpress
 */
class SolutionMerchantProfileGet extends BaseRequest
{
    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return 'aliexpress.solution.merchant.profile.get';
    }

    /**
     * @inheritDoc
     */
    public function getExpectedResponse(): string
    {
        return SolutionMerchantProfileGetResponse::class;
    }
}
