<?php

namespace Imynely\Pay\Contract;

use Illuminate\Http\Request;

interface Payment
{
    public function __construct(Request $request, Config $config);

    public function create(array $attributes);

    public function callback();

    public function status();

    public function redirect();
}
