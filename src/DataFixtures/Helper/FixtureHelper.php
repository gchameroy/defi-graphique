<?php

namespace App\DataFixtures\Helper;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory as Faker;
use Faker\Generator;

abstract class FixtureHelper extends Fixture
{
    /** @var Generator */
    public $faker;
    public function __construct()
    {
        $this->faker = Faker::create();
    }
}