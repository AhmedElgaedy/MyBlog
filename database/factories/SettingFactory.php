<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'header_logo'  =>'hamada',  
            'footer_logo'  =>'hamada',  
            'footer_desc'  =>$this->faker->paragraph(),  
            'email'        =>$this->faker->email(),
            'phone'        =>$this->faker->phoneNumber(),
            'address'      =>'egypt', 
            'facebook'     =>'facebook', 
            'instagram'    =>'instagram',
            'youtube'      =>'youtube',
            'about_title'  =>$this->faker->paragraph(),
            'about_desc'   =>$this->faker->sentence(),
        ];
    }
}
