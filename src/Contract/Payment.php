<?php

namespace Imynely\Pay\Contract;


interface Payment
{
    public function __construct(array $config);

    public function create(array $attributes = []);

    public function getUrl();

    public function getAStatus();
}
