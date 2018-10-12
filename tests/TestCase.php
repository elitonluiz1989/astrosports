<?php

namespace Tests;

use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    protected $faker;

    public function setUp()
    {
        parent::setUp();

        $this->faker = Faker::create();

        $this->seed();
    }

    public function tearDown()
    {
        $this->artisan('migrate:reset');

        parent::tearDown();
    }
}
