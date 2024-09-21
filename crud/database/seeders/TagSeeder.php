<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create(['name'=>'Building']);
        Tag::create(['name'=>'Commercial']);
        Tag::create(['name'=>'Industrial']);
        Tag::create(['name'=>'Residential']);
    }
}
