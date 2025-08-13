<?php

namespace App\Livewire\SuperDuper\Pages;

use App\Models\CustomPage;
use App\Models\Partner;
use App\Models\Team;
use App\Models\Testimonial;
use Livewire\Component;

class AboutUs extends Component
{
    public $content = [];

    public $partners = [];

    public $teams = [];

    public $testimonials = [];

    public function mount()
    {
        // Load content, partners, teams, and testimonials
        $this->loadContent();
        $this->loadPartners();
        $this->loadTeams();
        $this->loadTestimonials();
    }

    protected function loadContent()
    {
        $this->content = CustomPage::where('group', 'about_page')
            ->first();

        if ($this->content && $this->content->payload) {
            // Kalau payload masih string → decode JSON
            // Kalau sudah array → langsung pakai
            $payload = is_string($this->content->payload)
                ? json_decode($this->content->payload, true)
                : $this->content->payload;

            // Assign setiap key payload ke $content
            foreach ($payload as $key => $value) {
                $this->content->{$key} = $value;
            }
        }
    }

    protected function loadPartners()
    {
        // Load partners data
        $this->partners = Partner::where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    protected function loadTeams()
    {
        // Load team members data
        $this->teams = Team::where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    protected function loadTestimonials()
    {
        // Load testimonials data
        $this->testimonials = Testimonial::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.superduper.pages.about-us')->layout('components.superduper.main');
    }
}
