<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            'Main',
            'Consultation',
            'Laboratory',
            'X-Ray'
        ];

        foreach ($departments as $department) {
            \App\Models\Department::create([
                'name'  => $department,
                'slug'  => \Illuminate\Support\Str::slug($department)
            ]);
        }
    }
}
