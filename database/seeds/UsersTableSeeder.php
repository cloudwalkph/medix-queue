<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $admin = \App\User::create([
            'user_role_id'  => 1,
            'department_id' => 1,
            'email' => 'admin@medix.ph',
            'password'  => Hash::make('password')
        ]);
        $admin->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'middle_name'   => $faker->lastName,
            'birthdate'     => $faker->date(),
            'civil_status'  => 'single',
            'gender'        => 'male'
        ]);

        $practitioner = \App\User::create([
            'user_role_id'  => 2,
            'department_id' => 2,
            'email' => 'practitioner@medix.ph',
            'password'  => Hash::make('password')
        ]);
        $practitioner->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'middle_name'   => $faker->lastName,
            'birthdate'     => $faker->date(),
            'civil_status'  => 'single',
            'gender'        => 'male'
        ]);

        $practitioner = \App\User::create([
            'user_role_id'  => 2,
            'department_id' => 3,
            'email' => 'laboratory@medix.ph',
            'password'  => Hash::make('password')
        ]);
        $practitioner->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'middle_name'   => $faker->lastName,
            'birthdate'     => $faker->date(),
            'civil_status'  => 'single',
            'gender'        => 'male'
        ]);

        $practitioner = \App\User::create([
            'user_role_id'  => 2,
            'department_id' => 4,
            'email' => 'xray@medix.ph',
            'password'  => Hash::make('password')
        ]);
        $practitioner->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'middle_name'   => $faker->lastName,
            'birthdate'     => $faker->date(),
            'civil_status'  => 'single',
            'gender'        => 'male'
        ]);

    }
}
