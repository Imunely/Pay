<?php

namespace Imynely\Pay\Services\Config;

use Imynely\Pay\Contract\Config;

abstract class AbstractConfig implements Config
{
    /**
     *
     * @var array
     */
    protected $attributes = [];

    /**
     *
     * @var \App\PaymentSystem|array
     */
    protected $config;


    public function __construct(array $attributes)
    {
        if (!array_key_exists('driver', $attributes)) {

            throw new \InvalidArgumentException("Argument driver is required", 1);
        }

        $this->attributes = $attributes;
    }

    public static function instance(array $attributes): Config
    {
        return new self($attributes);
    }


    public function config(): \App\PaymentSystem|array
    {
        return $this->config;
    }
}
