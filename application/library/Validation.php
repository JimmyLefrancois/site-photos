<?php

/**
 * Abstract class with validation state and errors handling.
 *
 * @author Jimmy
 */
abstract class Validation extends Container
{
    /**
     * @var string[] The error list.
     */
    protected $errors;

    /**
     * Clears the error list and tests the object validity.
     *
     * @return boolean
     */
    public function isValid()
    {
        $this->errors = array();
        $this->validate();
        return empty($this->errors);
    }

    /**
     * Gets the validation errors.
     *
     * @return string[]
     */
    public function getErrors()
    {
        return $this->errors;
    }

    abstract protected function validate();
}
