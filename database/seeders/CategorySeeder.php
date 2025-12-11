<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            "name" => "Adventure",
            "icon" => "icons/adventure.png",
        ]);

        Storage::disk('public')->put("icons/adventure.png", file_get_contents(public_path("icons/adventure.png")));

        Category::create([
            "name" => "Horror",
            "icon" => "icons/ghost.png",
        ]);

        Storage::disk('public')->put("icons/ghost.png", file_get_contents(public_path("icons/ghost.png")));

        Category::create([
            "name" => "Sport",
            "icon" => "icons/basketball.svg",
        ]);

        Storage::disk('public')->put("icons/basketball.svg", file_get_contents(public_path("icons/basketball.svg")));

        Category::create([
            "name" => "Romance",
            "icon" => "icons/heart.svg",
        ]);

        Storage::disk('public')->put("icons/heart.svg", file_get_contents(public_path("icons/heart.svg")));

        Category::create([
            "name" => "Finance",
            "icon" => "icons/money-bag.svg",
        ]);

        Storage::disk('public')->put("icons/money-bag.svg", file_get_contents(public_path("icons/money-bag.svg")));
        
    }
}
