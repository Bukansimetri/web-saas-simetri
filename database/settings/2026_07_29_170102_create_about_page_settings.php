<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('about_page.hero_title', 'Tentang Living Interior');

        $this->migrator->add('about_page.about_subtitle', 'Tentang Living Interior');
        $this->migrator->add('about_page.about_heading', 'Kami Menghadirkan Desain Interior yang Fungsional dan Berkarakter');
        $this->migrator->add('about_page.about_paragraph_1', 'Living Interior adalah studio desain interior yang telah berpengalaman lebih dari 10 tahun dalam menangani berbagai proyek interior dan furniture custom. Kami membantu klien mewujudkan ruang yang tidak hanya indah secara visual, tetapi juga nyaman dan fungsional untuk digunakan setiap hari.');
        $this->migrator->add('about_page.about_paragraph_2', 'Proyek yang kami tangani meliputi hunian pribadi, kantor, apartemen, kafe, hingga klinik. Setiap desain dibuat secara khusus berdasarkan kebutuhan ruang, karakter pemilik, serta efisiensi penggunaan area.');
        $this->migrator->add('about_page.about_image', 'assets/img/about/about-us.jpg');
        $this->migrator->add('about_page.about_button_text', 'Lihat Proyek Kami');

        $this->migrator->add('about_page.cta_heading', 'Butuh Desain Interior untuk Rumah atau Bisnis Anda?');
        $this->migrator->add('about_page.cta_button_text', 'Hubungi Kami');

        $this->migrator->add('about_page.faq_subtitle', 'FAQ SECTION');
        $this->migrator->add('about_page.faq_heading', 'Pertanyaan yang Sering Diajukan');
        $this->migrator->add('about_page.faq_image', 'assets/img/about/about-faq.jpg');

        $this->migrator->add('about_page.testimonial_subtitle', 'Klien Review');
        $this->migrator->add('about_page.testimonial_heading', 'Apa kata klien kami');
        $this->migrator->add('about_page.testimonial_image', 'assets/img/testimonial/testi.jpg');
    }
};
