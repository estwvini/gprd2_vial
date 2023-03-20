<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class CentralTestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

//        $this->actingAs(User::factory()->create(), 'web_central_app');

//        URL::forceRootUrl('http://localhost');
    }
}
