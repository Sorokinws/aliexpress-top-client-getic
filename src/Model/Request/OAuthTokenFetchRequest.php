<?php
/**
 * PHP version 7.3
 *
 * @category OAuthTokenFetchRequest
 * @package  RetailCrm\Model\Request
 * @author   RetailCRM <integration@retailcrm.ru>
 * @license  http://retailcrm.ru Proprietary
 * @link     http://retailcrm.ru
 * @see      http://help.retailcrm.ru
 */

namespace RetailCrm\Model\Request;

use JMS\Serializer\Annotation as JMS;

/**
 * Class OAuthTokenFetchRequest
 *
 * @category OAuthTokenFetchRequest
 * @package  RetailCrm\Model\Request
 * @author   RetailDriver LLC <integration@retailcrm.ru>
 * @license  https://retailcrm.ru Proprietary
 * @link     http://retailcrm.ru
 * @see      https://help.retailcrm.ru
 */
class OAuthTokenFetchRequest
{
    /**
     * @var string $clientId
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("client_id")
     */
    public $clientId;

    /**
     * @var string $clientSecret
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("client_secret")
     */
    public $clientSecret;

    /**
     * @var string $grantType
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("grant_type")
     */
    public $grantType = 'authorization_code';

    /**
     * @var string $code
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("code")
     */
    public $code;

    /**
     * @var string $redirectUri
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("redirect_uri")
     */
    public $redirectUri;

    /**
     * @var string $sp
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("sp")
     */
    public $sp = 'ae';

    /**
     * @var string $state
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("state")
     */
    public $state;

    /**
     * @var string $view
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("view")
     */
    public $view = 'web';
}
