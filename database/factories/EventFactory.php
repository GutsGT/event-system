<?php

namespace Database\Factories;

use DateInterval;
use DatePeriod;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\Randomizer;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start_date = date_create("now");
        $end_date   = date_create("2026-01-01");

        $interval = DateInterval::createFromDateString('1 hour');
        $daterange = new DatePeriod($start_date, $interval ,$end_date);
        $dateArray = [];

        foreach($daterange as $date){
            $dateArray[] = $date->format('Y-m-d h:i:s');
        }

        return [
            'user_id'=>1,
            'title'=> $this->faker->name,
            'description'=> $this->faker->sentence,
            'city'=> $this->faker->city,
            'date'=> $dateArray[array_rand($dateArray)],
            'private'=> 0
        ];
    }
}
