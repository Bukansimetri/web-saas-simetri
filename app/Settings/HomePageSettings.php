<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class HomePageSettings extends Settings
{
    public string $sidebar_about_text;

    public string $hero_slug_text;
    public string $hero_title;
    public string $hero_paragraph;
    public string $hero_button_text;
    public string $hero_counter_number;
    public string $hero_counter_suffix;
    public string $hero_counter_text;

    public string $feature_cta_text;
    public string $feature_cta_link_text;

    public string $about_heading;
    public string $about_subheading;
    /** @var string[] */
    public array $about_features;
    public string $about_image;
    public string $about_experience_number;
    public string $about_experience_suffix;
    public string $about_experience_label;

    public string $contact_heading;
    public string $contact_image;
    public string $map_embed_url;

    public static function group(): string
    {
        return 'home_page';
    }
}
