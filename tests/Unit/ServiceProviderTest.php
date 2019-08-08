<?php

use Hpolthof\Laravel\EloquentUuid\Providers\ServiceProvider;
use Hpolthof\Laravel\EloquentUuid\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    public function test_it_extends_laravel()
    {
        $serviceProvider = new ServiceProvider(app());

        $this->assertInstanceOf(\Illuminate\Support\ServiceProvider::class, $serviceProvider);
    }
}