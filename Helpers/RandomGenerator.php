<?php

namespace Helpers;

use Faker\Factory;
use Models\Companies\RestaurantChains\RestaurantChain;
use Models\RestaurantLocations\RestaurantLocation;
use Models\Users\Employees\Employee;

class RandomGenerator {
    public static function employee(): Employee {
        $faker = Factory::create();

        return new Employee(
            $faker->randomNumber(),
            $faker->firstName(),
            $faker->lastName(),
            $faker->email,
            $faker->password,
            $faker->phoneNumber,
            $faker->address,
            $faker->dateTimeThisCentury,
            $faker->dateTimeBetween('-10 years', '+20 years'),
            $faker->randomElement(['admin', 'user', 'editor']),
            $faker->jobTitle(),
            $faker->randomFloat(),
            $faker->dateTimeBetween('-10 years', 'now'),
            array($faker->randomElement(["Good design","Good taste", "Good Customer service"]))
        );
    }

    public static function employees(int $min, int $max): array {
        $faker = Factory::create();
        $employees = [];
        $numberOfEmployees = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numberOfEmployees; $i++) {
            $employees[] = self::employee();
        }
        return $employees;
    }

    public static function restaurantLocation(): RestaurantLocation {
        $faker = Factory::create();

        return new RestaurantLocation(
            $faker->company(),
            $faker->address(),
            $faker->city(),
            $faker->state(),
            $faker->postcode(),
            self::employees(5,20),
            $faker->boolean(),
            $faker->boolean()
        );
    }

    public static function restaurantLocations(int $min, int $max): array {
        $faker = Factory::create();
        $restaurantLocations = [];
        $numberOfRestaurantLocations = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numberOfRestaurantLocations; $i++) {
            $restaurantLocations[] = self::restaurantLocation();
        }
        return $restaurantLocations;
    }

    public static function restaurantChain():RestaurantChain{
        $faker = Factory::create();

        return new RestaurantChain(
            $faker->company(),
            $faker->year(),
            $faker->text(100),
            $faker->url(),
            $faker->phoneNumber(),
            $faker->randomElement(['Restaurant','Hotel','IT','Bank']),
            $faker->name(),
            $faker->boolean(),
            $faker->country(),
            $faker->name(),
            $faker->randomNumber(),
            $faker->randomNumber(),
            self::restaurantLocations(1,3),
            $faker->randomElement(['Japanese','French','Chinese','Brazilian','Indian']),
            $faker->randomNumber(),
            $faker->company()
        );
    }

    public static function restaurantChains(int $min,int $max):array{
        $faker = Factory::create();
        $restaurantChains = [];
        $numberOfRestaurantChains = $faker->numberBetween($min,$max);

        for($i = 0;$i < $numberOfRestaurantChains; $i++){
            $restaurantChains[] = self::restaurantChain();
        }
        return $restaurantChains;
    }
}