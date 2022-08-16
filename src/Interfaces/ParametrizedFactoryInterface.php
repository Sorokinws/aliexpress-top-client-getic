<?php

/**
 * PHP version 7.3
 *
 * @category ParametrizedFactoryInterface
 * @package  RetailCrm\Interfaces
 */

namespace GeticRetailCrm\Interfaces;

/**
 * Interface ParametrizedFactoryInterface
 *
 * @category ParametrizedFactoryInterface
 * @package  RetailCrm\Interfaces
 */
interface ParametrizedFactoryInterface
{
    /**
     * @param mixed $params
     *
     * @return object
     */
    public function create($params);
}
