<?php

namespace Database\Seeders;

use App\Models\Content\Category;
use App\Models\Content\Item;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedTestimonials();
        $this->seedSponsors();
        $this->seedFaqHome();
        $this->seedFaqAboutUs();
        $this->seedHomeFeatures();
        $this->seedBeforeAfter();
        $this->seedAboutServicePreview();
        $this->seedStats();
        $this->seedServicesGrid();
        $this->seedSkills();
        $this->seedPricingPlans();
        $this->seedWorkProcessSteps();
        $this->seedPortfolio();
    }

    private function category(string $name, string $slug, ?string $parentId = null): Category
    {
        return Category::firstOrCreate(
            ['slug' => $slug],
            ['name' => $name, 'parent_id' => $parentId, 'is_active' => true, 'locale' => 'id']
        );
    }

    private function item(Category $category, array $attrs, ?string $image = null, ?string $imageSecondary = null): Item
    {
        $item = Item::create(array_merge([
            'content_category_id' => $category->id,
            'is_active' => true,
            'locale' => 'id',
        ], $attrs));

        if ($image && file_exists(public_path($image))) {
            $item->addMedia(public_path($image))->preservingOriginal()->toMediaCollection('images');
        }

        if ($imageSecondary && file_exists(public_path($imageSecondary))) {
            $item->addMedia(public_path($imageSecondary))->preservingOriginal()->toMediaCollection('images_secondary');
        }

        return $item;
    }

    private function alreadySeeded(string $slug): bool
    {
        $category = Category::where('slug', $slug)->first();

        return $category && $category->items()->count() > 0;
    }

    private function seedTestimonials(): void
    {
        if ($this->alreadySeeded('testimonial')) {
            return;
        }

        $category = $this->category('Testimonial', 'testimonial');

        $data = [
            ['title' => 'Mrs. Yana Depok', 'description' => 'Living Interior benar-benar memahami kebutuhan kami. Hasil akhirnya sesuai dengan desain 3D dan sangat memuaskan.'],
            ['title' => 'Mr. Doni Tangerang', 'description' => 'Prosesnya rapi, komunikatif, dan hasilnya premium. Recommended!'],
            ['title' => 'Mrs. Shinta', 'description' => 'Pengerjaan semua rapih dengan semua kemauan ku dan sesuai timeline suka bgt!'],
        ];

        foreach ($data as $i => $row) {
            $this->item($category, array_merge($row, ['sort' => $i + 1]));
        }
    }

    private function seedSponsors(): void
    {
        if ($this->alreadySeeded('sponsor')) {
            return;
        }

        $category = $this->category('Sponsor / Klien', 'sponsor');

        $clients = [
            ['title' => 'Aghasar Law Firm', 'image' => 'aghasar2.jpg'],
            ['title' => 'Alam Sutera', 'image' => 'alamsutra.jpg'],
            ['title' => 'BSD City', 'image' => 'bsd.jpg'],
            ['title' => 'Cendana Essence', 'image' => 'cendana.jpg'],
            ['title' => 'CitraGarden Bintaro', 'image' => 'citragarden.jpg'],
            ['title' => 'Enchanté Residence', 'image' => 'enchante.jpg'],
            ['title' => 'Summarecon', 'image' => 'summarecon.jpg'],
            ['title' => 'Summarecon Serpong', 'image' => 'gadingserpong.jpg'],
            ['title' => 'Universitas Pembangunan Jaya', 'image' => 'upjata.jpg'],
            ['title' => 'Yura Dental', 'image' => 'yuradental.jpg'],
            ['title' => 'Bank Mandiri', 'image' => 'mandiri.jpg'],
            ['title' => 'Lippo Group', 'image' => 'lippo.jpg'],
        ];

        foreach ($clients as $i => $client) {
            $this->item($category, ['title' => $client['title'], 'sort' => $i + 1], "assets/img/sponsor/{$client['image']}");
        }
    }

    private function seedFaqHome(): void
    {
        if ($this->alreadySeeded('faq-home')) {
            return;
        }

        $category = $this->category('FAQ - Home', 'faq-home');

        $data = [
            ['title' => 'Apakah hasil desain akan sesuai dengan visual 3D?', 'description' => 'Ya, kami memastikan hasil akhir sesuai dengan konsep desain yang telah disepakati melalui gambar kerja dan supervisi proyek.'],
            ['title' => 'Berapa lama proses desain interior berlangsung?', 'description' => 'Durasi pengerjaan tergantung pada luas dan kompleksitas ruangan. Umumnya proses desain memakan waktu 1–3 minggu, mulai dari konsultasi, pembuatan konsep, revisi, hingga finalisasi gambar kerja.'],
            ['title' => 'Apakah Living Interior menyediakan layanan desain & build?', 'description' => 'Ya, kami menyediakan layanan lengkap mulai dari perencanaan desain, pembuatan gambar kerja, hingga tahap produksi dan instalasi di lapangan.'],
            ['title' => 'Bagaimana sistem pembayaran di Living Interior?', 'description' => 'Pembayaran dilakukan secara bertahap sesuai progress pekerjaan, mulai dari DP awal, termin selama pengerjaan, hingga pelunasan setelah proyek selesai.'],
        ];

        foreach ($data as $i => $row) {
            $this->item($category, array_merge($row, ['sort' => $i + 1]));
        }
    }

    private function seedFaqAboutUs(): void
    {
        if ($this->alreadySeeded('faq-about-us')) {
            return;
        }

        $category = $this->category('FAQ - About Us', 'faq-about-us');

        $data = [
            ['title' => 'Apakah Living Interior melayani desain saja tanpa pengerjaan?', 'description' => 'Ya. Kami menyediakan layanan desain interior saja, namun juga dapat membantu proses produksi dan instalasi jika dibutuhkan.'],
            ['title' => 'Apakah bisa membuat furniture custom sesuai ukuran ruangan?', 'description' => 'Tentu. Semua furniture yang kami produksi dapat disesuaikan dengan ukuran ruang, konsep desain, dan kebutuhan klien.'],
            ['title' => 'Berapa lama proses pengerjaan interior?', 'description' => 'Waktu pengerjaan bergantung pada skala proyek. Untuk desain biasanya memerlukan waktu 1–3 minggu, sedangkan pengerjaan interior akan disesuaikan dengan kompleksitas proyek.'],
        ];

        foreach ($data as $i => $row) {
            $this->item($category, array_merge($row, ['sort' => $i + 1]));
        }
    }

    private function seedHomeFeatures(): void
    {
        if ($this->alreadySeeded('home-feature')) {
            return;
        }

        $category = $this->category('Home - Feature Strip', 'home-feature');

        $data = [
            ['title' => 'Harga Transparan', 'description' => 'Kami memberikan penawaran yang jelas dan detail tanpa biaya tersembunyi.', 'image' => 'assets/icon/ar-ic1.png'],
            ['title' => 'Desain Eksklusif', 'description' => 'Setiap desain dibuat sesuai karakter, kebutuhan, dan gaya hidup klien.', 'image' => 'assets/icon/ar-ic2.png'],
            ['title' => 'Pengerjaan Profesional', 'description' => 'Dikerjakan oleh tim berpengalaman dengan hasil rapi dan tepat waktu.', 'image' => 'assets/icon/ar-ic3.png'],
        ];

        foreach ($data as $i => $row) {
            $image = $row['image'];
            unset($row['image']);
            $this->item($category, array_merge($row, ['sort' => $i + 1]), $image);
        }
    }

    private function seedBeforeAfter(): void
    {
        if ($this->alreadySeeded('before-after')) {
            return;
        }

        $category = $this->category('Before / After', 'before-after');

        $this->item(
            $category,
            ['title' => 'Furniture', 'sort' => 1],
            'assets/img/about/dabur-before.jpeg',
            'assets/img/about/dapur-after.jpeg'
        );

        $this->item(
            $category,
            ['title' => 'Interior Rumah', 'sort' => 2],
            'assets/img/about/kamar-before.jpeg',
            'assets/img/about/kamar-after.jpeg'
        );

        // No real before/after photos yet for these — created inactive so they
        // don't render an empty tab publicly until real photos are uploaded via admin.
        foreach (['Interior Kantor', 'Apartment', 'Kafe', 'Klinik'] as $i => $title) {
            $this->item($category, ['title' => $title, 'sort' => 3 + $i, 'is_active' => false]);
        }
    }

    private function seedAboutServicePreview(): void
    {
        if ($this->alreadySeeded('about-service-preview')) {
            return;
        }

        $category = $this->category('About Us - Service Preview', 'about-service-preview');

        $data = [
            ['title' => 'Desain Interior', 'description' => 'Kami merancang konsep interior yang menyesuaikan kebutuhan ruang, gaya hidup, serta karakter klien untuk menghasilkan desain yang estetis dan fungsional.', 'image' => 'assets/icon/ic1.png'],
            ['title' => 'Custom Furniture', 'description' => 'Kami memproduksi furniture custom dengan material berkualitas yang dirancang khusus agar menyatu dengan konsep interior ruangan.', 'image' => 'assets/icon/ic2.png'],
            ['title' => 'Interior Renovation', 'description' => 'Kami membantu proses renovasi interior dengan perencanaan yang matang, pengerjaan rapi, dan pengawasan profesional.', 'image' => 'assets/icon/ic3.png'],
        ];

        foreach ($data as $i => $row) {
            $image = $row['image'];
            unset($row['image']);
            $this->item($category, array_merge($row, ['sort' => $i + 1, 'click_url' => '/services']), $image);
        }
    }

    private function seedStats(): void
    {
        if ($this->alreadySeeded('stat')) {
            return;
        }

        $category = $this->category('Stat / Counter', 'stat');

        $data = [
            ['title' => '10+', 'description' => 'Tahun Pengalaman'],
            ['title' => '150+', 'description' => 'Proyek Selesai'],
            ['title' => '150+', 'description' => 'Klien Puas'],
            ['title' => '5+', 'description' => 'Jenis Industri'],
        ];

        foreach ($data as $i => $row) {
            $this->item($category, array_merge($row, ['sort' => $i + 1]));
        }
    }

    private function seedServicesGrid(): void
    {
        if ($this->alreadySeeded('services-grid')) {
            return;
        }

        $category = $this->category('Services - Grid', 'services-grid');

        $data = [
            ['title' => 'Perencanaan & Desain', 'description' => 'Kami merancang konsep ruang yang matang mulai dari denah, tata letak, hingga gaya visual sesuai kebutuhan Anda.', 'image' => 'assets/icon/ic11.png'],
            ['title' => 'Solusi Custom', 'description' => 'Setiap ruang punya tantangan berbeda, kami memberikan solusi desain yang disesuaikan dengan kondisi dan kebutuhan spesifik Anda.', 'image' => 'assets/icon/ic12.png'],
            ['title' => 'Furniture & Dekorasi', 'description' => 'Produksi furniture custom dan pemilihan dekorasi yang menyatu dengan konsep interior keseluruhan.', 'image' => 'assets/icon/ic13.png'],
            ['title' => 'Visualisasi 3D', 'description' => 'Gambar rendering 3D realistis agar Anda bisa melihat hasil akhir sebelum proses pengerjaan dimulai.', 'image' => 'assets/icon/ic14.png'],
            ['title' => 'Renovasi Rumah', 'description' => 'Layanan renovasi menyeluruh dengan perencanaan matang dan pengawasan proyek yang rapi.', 'image' => 'assets/icon/ic15.png'],
            ['title' => 'Ide & Inspirasi', 'description' => 'Konsultasi desain untuk membantu Anda menemukan gaya interior yang paling sesuai dengan karakter Anda.', 'image' => 'assets/icon/ic16.png'],
        ];

        foreach ($data as $i => $row) {
            $image = $row['image'];
            unset($row['image']);
            $this->item($category, array_merge($row, ['sort' => $i + 1]), $image);
        }
    }

    private function seedSkills(): void
    {
        if ($this->alreadySeeded('skill')) {
            return;
        }

        $category = $this->category('Working Skill', 'skill');

        $data = [
            ['title' => 'Desain Arsitektur', 'percent' => 92],
            ['title' => 'Desain Interior', 'percent' => 85],
            ['title' => 'Desain 3D', 'percent' => 85],
        ];

        foreach ($data as $i => $row) {
            $this->item($category, [
                'title' => $row['title'],
                'sort' => $i + 1,
                'options' => ['percent' => $row['percent']],
            ]);
        }
    }

    private function seedPricingPlans(): void
    {
        if ($this->alreadySeeded('pricing-plan')) {
            return;
        }

        $category = $this->category('Pricing Plan', 'pricing-plan');

        $features = "- 20 Tim Pekerja\n- 4 Engineer Pendamping\n- 8 Bulan Masa Garansi";

        $data = [
            ['title' => 'Paket Reguler', 'objects' => 17, 'featured' => false],
            ['title' => 'Paket Utama', 'objects' => 25, 'featured' => true],
            ['title' => 'Paket Premium', 'objects' => 30, 'featured' => false],
        ];

        foreach ($data as $i => $row) {
            $this->item($category, [
                'title' => $row['title'],
                'description' => "- {$row['objects']} Objek Interior\n".$features,
                'sort' => $i + 1,
                'options' => [
                    'price' => 'Hubungi Kami',
                    'unit' => 'Per Ruangan',
                    'is_featured' => $row['featured'] ? 'true' : 'false',
                    'button_text' => 'Pilih Paket',
                ],
            ]);
        }
    }

    private function seedWorkProcessSteps(): void
    {
        if ($this->alreadySeeded('work-process-step')) {
            return;
        }

        $category = $this->category('Work Process', 'work-process-step');

        $data = [
            ['title' => 'Perencanaan & Desain', 'description' => 'Kami mulai dengan memahami kebutuhan Anda, melakukan survei lokasi, dan menyusun konsep desain awal.', 'image' => 'assets/icon/ic4.png', 'step' => '01'],
            ['title' => 'Gambar & Sketsa', 'description' => 'Konsep dikembangkan menjadi gambar kerja detail dan visualisasi 3D agar Anda bisa melihat hasil akhir sebelum pengerjaan.', 'image' => 'assets/icon/ic5.png', 'step' => '02'],
            ['title' => 'Mulai Pengerjaan', 'description' => 'Tim kami melakukan produksi, instalasi, dan supervisi hingga proyek selesai sesuai rencana.', 'image' => 'assets/icon/ic6.png', 'step' => '03'],
        ];

        foreach ($data as $i => $row) {
            $image = $row['image'];
            $step = $row['step'];
            $this->item($category, [
                'title' => $row['title'],
                'description' => $row['description'],
                'sort' => $i + 1,
                'options' => ['step_number' => $step],
            ], $image);
        }
    }

    private function seedPortfolio(): void
    {
        if ($this->alreadySeeded('interior-rumah')) {
            return;
        }

        $parent = $this->category('Portofolio', 'portofolio');

        $children = [
            'interior-rumah' => 'Interior Rumah',
            'interior-kantor' => 'Interior Kantor',
            'interior-apartemen' => 'Interior Apartemen',
            'custom-furniture' => 'Custom Furniture',
            'interior-komersial' => 'Interior Komersial (Cafe, Klinik, dll)',
        ];

        $categories = [];
        foreach ($children as $slug => $name) {
            $categories[$slug] = $this->category($name, $slug, $parent->id);
        }

        $data = [
            ['title' => 'Backdrop Ruang Tamu', 'image' => 'assets/img/project/Backdrop_lg.jpg', 'cat' => 'interior-rumah'],
            ['title' => 'Kamar Tidur Modern', 'image' => 'assets/img/project/Bedroom_2_lg.jpg', 'cat' => 'interior-rumah'],
            ['title' => 'Interior Kantor', 'image' => 'assets/img/project/Bedroom_3_lg.jpg', 'cat' => 'interior-kantor'],
            ['title' => 'Kamar Tidur Minimalis', 'image' => 'assets/img/project/Bedroom_lg.jpg', 'cat' => 'interior-rumah'],
            ['title' => 'Dapur Komersial', 'image' => 'assets/img/project/kitchen_set_2_lg.jpg', 'cat' => 'interior-komersial'],
            ['title' => 'Kitchen Set Custom', 'image' => 'assets/img/project/kitchen_set_3_lg.jpg', 'cat' => 'custom-furniture'],
            ['title' => 'Pantry Kantor', 'image' => 'assets/img/project/Kitchen_set_lg.jpg', 'cat' => 'interior-kantor'],
            ['title' => 'Mini Bar Cafe', 'image' => 'assets/img/project/Mini_Bar_lg.jpg', 'cat' => 'interior-komersial'],
            ['title' => 'Area Resepsionis', 'image' => 'assets/img/project/Receptionis_lg.jpg', 'cat' => 'interior-kantor'],
            ['title' => 'Walk-in Closet', 'image' => 'assets/img/project/Walking_Closet_lg.jpg', 'cat' => 'interior-rumah'],
        ];

        foreach ($data as $i => $row) {
            $this->item($categories[$row['cat']], [
                'title' => $row['title'],
                'sort' => $i + 1,
            ], $row['image']);
        }
    }
}
