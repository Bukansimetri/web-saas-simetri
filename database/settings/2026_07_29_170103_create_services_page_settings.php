<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('services_page.hero_title', 'Layanan Kami');

        $this->migrator->add('services_page.cta_heading', 'Kami Menyediakan Layanan Interior dengan Harga Terjangkau, Hemat Waktu & Biaya');
        $this->migrator->add('services_page.cta_button_text', 'Hubungi Kami');

        $this->migrator->add('services_page.skill_subtitle', 'Keahlian Kami');
        $this->migrator->add('services_page.skill_heading', 'Bagaimana Kami Menilai Kualitas dan Keahlian Tim Kami?');
        $this->migrator->add('services_page.skill_paragraph', 'Tim kami memiliki keahlian teknis dan estetika yang terus diasah melalui pengalaman menangani berbagai proyek interior dan arsitektur selama lebih dari 10 tahun.');
        $this->migrator->add('services_page.skill_image', 'assets/img/about/ws2.jpg');

        $this->migrator->add('services_page.pricing_subtitle', 'Paket Layanan');
        $this->migrator->add('services_page.pricing_heading', 'Pilihan Paket Sesuai Kebutuhan dan Budget Anda');

        $this->migrator->add('services_page.work_process_subtitle', 'Proses Kerja');
        $this->migrator->add('services_page.work_process_heading', 'Bagaimana Kami Menyelesaikan Proyek');
        $this->migrator->add('services_page.work_process_paragraph', 'Kami mengikuti tahapan kerja yang terstruktur mulai dari perencanaan hingga instalasi, memastikan hasil akhir sesuai harapan Anda.');
    }
};
