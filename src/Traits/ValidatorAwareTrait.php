<?php

/**
 * PHP version 7.3
 *
 * @category ValidatorAwareTrait
 * @package  RetailCrm\Traits
 */

namespace GeticRetailCrm\Traits;

use Symfony\Component\Validator\Constraints as Assert;
use GeticRetailCrm\Component\Exception\ValidationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Trait ValidatorAwareTrait
 *
 * @category ValidatorAwareTrait
 * @package  RetailCrm\Traits
 */
trait ValidatorAwareTrait
{
    /**
     * @var ValidatorInterface $validator
     * @Assert\NotNull(message="Validator should be provided")
     */
    protected $validator;

    /**
     * @param \Symfony\Component\Validator\Validator\ValidatorInterface $validator
     *
     * @return $this
     */
    public function setValidator(ValidatorInterface $validator): self
    {
        $this->validator = $validator;
        return $this;
    }

    /**
     * @param mixed $item
     *
     * @throws \RetailCrm\Component\Exception\ValidationException
     */
    protected function validate($item): void
    {
        $violations = $this->validator->validate($item);

        if ($violations->count()) {
            throw new ValidationException("Invalid data", $violations);
        }
    }
}
