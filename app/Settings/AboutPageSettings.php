<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AboutPageSettings extends Settings
{
    public string $hero_title;

    public string $about_subtitle;
    public string $about_heading;
    public string $about_paragraph_1;
    public string $about_paragraph_2;
    public string $about_image;
    public string $about_button_text;

    public string $cta_heading;
    public string $cta_button_text;

    public string $faq_subtitle;
    public string $faq_heading;
    public string $faq_image;

    public string $testimonial_subtitle;
    public string $testimonial_heading;
    public string $testimonial_image;

    public static function group(): string
    {
        return 'about_page';
    }
}
