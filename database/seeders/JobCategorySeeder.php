<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobCategory;
use Illuminate\Support\Str;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Information Technology',
            'Government',
            'Accounting',
            'Banking',
            'Healthcare',
            'Education',
            'Marketing',
            'Sales',
            'Human Resources',
            'Engineering',
        ];

        foreach ($categories as $category) {

            JobCategory::updateOrCreate(
    [
        'slug' => Str::slug($category),
    ],
    [
        'name' => $category,
        'description' => $category . ' Jobs',
        'is_active' => true,
    ]
);
        }
    }
}
