<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class PortfolioPageSettings extends Settings
{
    public string $hero_title;

    public static function group(): string
    {
        return 'portfolio_page';
    }
}
