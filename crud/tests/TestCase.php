<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getBaseUrl(): string
    {
        $host = config('app.url');
        $prefix = '/api';
        return $host . $prefix;
    }
}
