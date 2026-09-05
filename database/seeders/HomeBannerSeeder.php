<?php

namespace Database\Seeders;

use App\Models\Banner\Category;
use App\Models\Banner\Content;
use Illuminate\Database\Seeder;

class HomeBannerSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::firstOrCreate(
            ['slug' => 'home-banner'],
            ['name' => 'Home Banner', 'is_active' => true, 'locale' => 'id']
        );

        if ($category->banners()->count() > 0) {
            return;
        }

        $banner = Content::create([
            'banner_category_id' => $category->id,
            'sort' => 1,
            'is_active' => true,
            'title' => 'Wujudkan Interior Impian Anda Bersama Living Interior',
            'description' => 'Kami menghadirkan desain interior modern, elegan, dan fungsional untuk hunian, kantor, dan ruang komersial Anda.',
            'click_url' => '/contact-us',
            'click_url_target' => '_self',
            'locale' => 'id',
            'options' => ['button_text' => 'Gratis Konsultasi'],
        ]);

        $imagePath = public_path('assets/img/slider-2/home2.jpg');

        if (file_exists($imagePath)) {
            $banner->addMedia($imagePath)->preservingOriginal()->toMediaCollection('banners');
        }
    }
}
