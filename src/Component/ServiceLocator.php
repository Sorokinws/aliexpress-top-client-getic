<?php

/**
 * PHP version 7.3
 *
 * @category ServiceLocator
 * @package  RetailCrm\Component
 */
namespace GeticRetailCrm\Component;

use GeticRetailCrm\Factory\FileItemFactory;
use GeticRetailCrm\Factory\OAuthTokenFetcherFactory;
use GeticRetailCrm\Interfaces\ContainerAwareInterface;
use GeticRetailCrm\Interfaces\FileItemFactoryInterface;
use GeticRetailCrm\Traits\ContainerAwareTrait;

/**
 * Class ServiceLocator
 *
 * @category ServiceLocator
 * @package  RetailCrm\Component
 */
class ServiceLocator implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @return \RetailCrm\Factory\OAuthTokenFetcherFactory
     */
    public function getOAuthTokenFetcherFactory(): OAuthTokenFetcherFactory
    {
        return $this->getContainer()->get(OAuthTokenFetcherFactory::class);
    }

    /**
     * @return \RetailCrm\Interfaces\FileItemFactoryInterface
     */
    public function getFileItemFactory(): FileItemFactoryInterface
    {
        return $this->getContainer()->get(FileItemFactory::class);
    }
}
