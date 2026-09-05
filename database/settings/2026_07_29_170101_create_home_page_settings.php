<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('home_page.sidebar_about_text', 'Living Interior adalah studio desain interior berpengalaman lebih dari 10 tahun, menghadirkan solusi desain rumah, kantor, apartemen, kafe, dan klinik yang fungsional dan estetis.');

        $this->migrator->add('home_page.hero_slug_text', 'Jasa Desain Interior Profesional');
        $this->migrator->add('home_page.hero_title', 'Wujudkan Interior Impian Anda Bersama Living Interior');
        $this->migrator->add('home_page.hero_paragraph', 'Kami menghadirkan desain interior modern, elegan, dan fungsional untuk hunian, kantor, dan ruang komersial Anda.');
        $this->migrator->add('home_page.hero_button_text', 'Gratis Konsultasi');
        $this->migrator->add('home_page.hero_counter_number', '10');
        $this->migrator->add('home_page.hero_counter_suffix', '+');
        $this->migrator->add('home_page.hero_counter_text', 'Berpengalaman 10 tahun lebih mengerjakan furniture dan interior rumah, kantor, apartement, kafe dan klinik');

        $this->migrator->add('home_page.feature_cta_text', 'Siap Mulai Proyek Interior Anda?');
        $this->migrator->add('home_page.feature_cta_link_text', 'Hubungi Kami Sekarang:');

        $this->migrator->add('home_page.about_heading', 'Pastikan Anda Mendapatkan Layanan Interior yang Tepat untuk Ruang Anda');
        $this->migrator->add('home_page.about_subheading', 'Didukung oleh tim desainer interior berpengalaman dan sistem kerja profesional.');
        $this->migrator->add('home_page.about_features', [
            'Desain 3D Rendering Realistis',
            'Gambar Kerja Detail & Teknis',
            'Pemilihan Material & Finishing',
            'Custom Furniture & Built-in',
            'Supervisi & Instalasi',
            'Konsultasi Desain Interior',
        ]);
        $this->migrator->add('home_page.about_image', 'assets/img/about/about-us.jpg');
        $this->migrator->add('home_page.about_experience_number', '10');
        $this->migrator->add('home_page.about_experience_suffix', '+');
        $this->migrator->add('home_page.about_experience_label', 'Layanan Interior Profesional');

        $this->migrator->add('home_page.contact_heading', 'Konsultasikan Proyek Interior Anda');
        $this->migrator->add('home_page.contact_image', 'assets/img/about/contact.jpg');
        $this->migrator->add('home_page.map_embed_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.5142938960028!2d106.67996027913325!3d-6.256198512948139!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fb44d4dc33bb%3A0xf9dec3a71537b63e!2sWorkshop%20Living%20Interior!5e0!3m2!1sen!2sid!4v1774843905515!5m2!1sen!2sid');
    }
};
