<?php

/**
 * PHP version 7.3
 *
 * @category ValidationException
 * @package  RetailCrm\Component\Exception
 */
namespace GeticRetailCrm\Component\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Throwable;

/**
 * Class ValidationException
 *
 * @category ValidationException
 * @package  RetailCrm\Component\Exception
 */
class ValidationException extends \Exception
{
    /**
     * @var \Symfony\Component\Validator\ConstraintViolationListInterface|null
     */
    private $violations;

    /**
     * ValidationException constructor.
     *
     * @param string                                                             $message
     * @param \Symfony\Component\Validator\ConstraintViolationListInterface|null $violations
     * @param int                                                                $code
     * @param \Throwable|null                                                    $previous
     */
    public function __construct(
        $message = "",
        ?ConstraintViolationListInterface $violations = null,
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->violations = $violations;
    }

    /**
     * @return \Symfony\Component\Validator\ConstraintViolationListInterface|null
     */
    public function getViolations(): ?ConstraintViolationListInterface
    {
        return $this->violations;
    }
}
