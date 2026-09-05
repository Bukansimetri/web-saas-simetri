<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ServicesPageSettings extends Settings
{
    public string $hero_title;

    public string $cta_heading;
    public string $cta_button_text;

    public string $skill_subtitle;
    public string $skill_heading;
    public string $skill_paragraph;
    public string $skill_image;

    public string $pricing_subtitle;
    public string $pricing_heading;

    public string $work_process_subtitle;
    public string $work_process_heading;
    public string $work_process_paragraph;

    public static function group(): string
    {
        return 'services_page';
    }
}
