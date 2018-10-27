<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CustomDimensions implements Rule
{
    /**
     * The constraints for the dimensions rule.
     *
     * @var array
     */
    protected $constraints = [];

    /**
     * Create a new dimensions rule instance.
     *
     * @param  array  $constraints;
     * @return void
     */
    public function __construct(array $constraints = [])
    {
        $this->constraints = $constraints;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (! $this->isValidFileInstance($value) || ! $sizeDetails = @getimagesize($value->getRealPath())) {
            return false;
        }

        $this->requireConstraintCount(1, $this->constraints, 'CustomDimensions');

        list($width, $height) = $sizeDetails;

        if (isset($this->constraints['orientation_agnostic']) && $this->constraints['orientation_agnostic']) {
            if ($height > $width) {
                $temp = $width;
                $width = $height;
                $height = $temp;
            }
        }

        if ($this->failsBasicDimensionChecks($this->constraints, $width, $height) ||
            $this->failsRatioCheck($this->constraints, $width, $height)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute has invalid image dimensions.';
    }

    /**
     * Check that the given value is a valid file instance.
     *
     * @param  mixed  $value
     * @return bool
     */
    public function isValidFileInstance($value)
    {
        if ($value instanceof UploadedFile && ! $value->isValid()) {
            return false;
        }
        return $value instanceof File;
    }

    /**
     * Require a certain number of parameters to be present.
     *
     * @param  int    $count
     * @param  array  $parameters
     * @param  string  $rule
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    protected function requireConstraintCount($count, $parameters, $rule)
    {
        if (count($parameters) < $count) {
            throw new InvalidArgumentException("Validation rule $rule requires at least $count parameters.");
        }
    }

    /**
     * Test if the given width and height fail any conditions.
     *
     * @param  array  $parameters
     * @param  int  $width
     * @param  int  $height
     * @return bool
     */
    protected function failsBasicDimensionChecks($parameters, $width, $height)
    {
        return (isset($parameters['width']) && $parameters['width'] != $width) ||
               (isset($parameters['min_width']) && $parameters['min_width'] > $width) ||
               (isset($parameters['max_width']) && $parameters['max_width'] < $width) ||
               (isset($parameters['height']) && $parameters['height'] != $height) ||
               (isset($parameters['min_height']) && $parameters['min_height'] > $height) ||
               (isset($parameters['max_height']) && $parameters['max_height'] < $height);
    }

    /**
     * Determine if the given parameters fail a dimension ratio check.
     *
     * @param  array  $parameters
     * @param  int  $width
     * @param  int  $height
     * @return bool
     */
    protected function failsRatioCheck($parameters, $width, $height)
    {
        if (! isset($parameters['ratio'])) {
            return false;
        }

        list($numerator, $denominator) = array_replace(
            [1, 1],
            array_filter(sscanf($parameters['ratio'], '%f/%d'))
        );

        $precision = 1 / max($width, $height);

        return abs($numerator / $denominator - $width / $height) > $precision;
    }
}
