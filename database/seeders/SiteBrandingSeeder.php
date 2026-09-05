<?php

namespace Database\Seeders;

use App\Settings\GeneralSettings;
use App\Settings\MailSettings;
use App\Settings\SiteSeoSettings;
use App\Settings\SiteSettings;
use App\Settings\SiteSocialSettings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SiteBrandingSeeder extends Seeder
{
    /**
     * Replaces the generic "SuperDuper Starter Kit" placeholder values (left over
     * from the base template) with the real Living Interior brand/contact info.
     */
    public function run(): void
    {
        $this->seedBrandAssets();
        $this->seedGeneralSettings();
        $this->seedSiteSettings();
        $this->seedShareImageSettings();
    }

    private function seedBrandAssets(): void
    {
        $logoSource = public_path('assets/img/logo/logoLV250.png');
        if (file_exists($logoSource)) {
            Storage::disk('public')->put('sites/brand-logo.png', file_get_contents($logoSource));
        }

        // public/favicon.ico ships as an empty placeholder in this repo, so use the
        // brand logo (already a small square image) as the favicon source instead.
        $faviconSource = public_path('assets/img/logo/logoLV100.png');
        if (file_exists($faviconSource)) {
            Storage::disk('public')->put('sites/favicon.png', file_get_contents($faviconSource));
        }
    }

    private function seedGeneralSettings(): void
    {
        $settings = app(GeneralSettings::class);
        $settings->brand_name = 'Living Interior';
        $settings->brand_logo = 'sites/brand-logo.png';
        $settings->site_favicon = 'sites/favicon.png';
        $settings->save();
    }

    private function seedSiteSettings(): void
    {
        $settings = app(SiteSettings::class);
        $settings->name = 'Living Interior';
        $settings->tagline = 'Jasa Desain Interior Profesional';
        $settings->description = 'Wujudkan Interior Impian Anda Bersama Living Interior';
        $settings->logo = 'sites/brand-logo.png';
        $settings->company_name = 'Living Interior';
        $settings->company_email = 'livingsmeinterior@gmail.com';
        $settings->company_phone = '+62 821-3035-4599';
        $settings->company_address = 'Gg. Sanan, Pd. Kacang Bar., Kec. Pd. Aren, Tangerang Selatan';
        $settings->copyright_text = '© '.date('Y').' All rights reserved. Living Interior';
        $settings->save();
    }

    /**
     * The base template ships placeholder paths (sites/og-image.png, etc.) that
     * were never uploaded, so og:image/twitter:image/schema logo/email logo all
     * point at files that don't exist. Point them at the brand logo we already
     * seeded above so social shares, structured data, and emails render a real
     * image instead of a broken link.
     */
    private function seedShareImageSettings(): void
    {
        if (! Storage::disk('public')->exists('sites/brand-logo.png')) {
            return;
        }

        $seo = app(SiteSeoSettings::class);
        $seo->og_image = 'sites/brand-logo.png';
        $seo->twitter_image = 'sites/brand-logo.png';
        $seo->schema_logo = 'sites/brand-logo.png';
        $seo->save();

        $social = app(SiteSocialSettings::class);
        $social->social_share_default_image = 'sites/brand-logo.png';
        $social->save();

        $mail = app(MailSettings::class);
        $mail->logo_path = 'sites/brand-logo.png';
        $mail->save();
    }
}
