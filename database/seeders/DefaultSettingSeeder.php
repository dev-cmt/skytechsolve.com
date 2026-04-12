<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class DefaultSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'title'     => 'home',
            'slug'      => 'home',
            'content'   => 'This is the home page content.',
        ]);
        Page::create([
            'title'     => 'about',
            'slug'      => 'about',
            'content'   => 'This is the home page content.',
        ]);
        Page::create([
            'title'     => 'teams',
            'slug'      => 'teams',
            'content'   => 'This is the home page content.',
        ]);
        Page::create([
            'title'     => 'contact',
            'slug'      => 'contact',
            'content'   => 'This is the home page content.',
        ]);
        Page::create([
            'title'     => 'services',
            'slug'      => 'services',
            'content'   => 'This is the home page content.',
        ]);
        Page::create([
            'title'     => 'projects',
            'slug'      => 'projects',
            'content'   => 'This is the home page content.',
        ]);
        Page::create([
            'title'     => 'projects-video',
            'slug'      => 'projects-video',
            'content'   => 'This is the home page content.',
        ]);
        Page::create([
            'title'     => 'blogs',
            'slug'      => 'blogs',
            'content'   => 'This is the home page content.',
        ]);

    }
}
