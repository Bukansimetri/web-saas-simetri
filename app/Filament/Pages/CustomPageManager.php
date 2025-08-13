<?php

namespace App\Filament\Pages;

use App\Models\CustomPage;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class CustomPageManager extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.custom-page-manager';

    public ?string $activeGroup = null;

    public ?string $activeSection = null;

    public Collection $groups;

    public Collection $sections;

    public ?array $payloadData = [];

    public bool $showSectionForm = false;

    public ?array $newSectionData = [
        'name' => null,
        'type' => null,
        'description' => null,
        'image' => null,
    ];

    public function mount(): void
    {
        $this->loadGroups();

        // Jika tidak ada groups
        if ($this->groups->isEmpty()) {
            $this->groups = collect();
            $this->activeGroup = null;

            return;
        }

        // Set active group ke yang pertama jika belum ada
        $this->activeGroup = $this->activeGroup ?? $this->groups->first()->group;

        // Load sections berdasarkan group
        $this->loadSections();

        // Ambil section aktif
        $section = $this->sections->firstWhere('section', $this->activeSection);

        if ($section) {
            // Pastikan payload jadi array
            $payload = is_string($section->payload)
                ? json_decode($section->payload, true)
                : $section->payload;

            if (! is_array($payload)) {
                $payload = [];
            }

            // Jika ada field background_image, ubah dari URL → relative path
            if (! empty($payload['background_image'])) {
                $payload['background_image'] = str_replace(
                    Storage::disk('public')->url(''),
                    '',
                    $payload['background_image']
                );
            }

            // Isi form
            $this->form->fill($payload);
        }
    }

    protected function loadGroups(): void
    {
        $this->groups = CustomPage::query()
            ->select('group', 'name')
            ->whereNotNull('group') // Pastikan group tidak null
            ->whereNotNull('name')  // Pastikan name tidak null
            ->distinct()
            ->orderBy('group')
            ->get()
            ->keyBy('group')
            ->filter(); // Hapus entry kosong
    }

    public function selectGroup(string $group): void
    {
        $this->activeGroup = $group;
        $this->loadSections(); // Pastikan ini dijalankan

        // Reset form dan active section
        $this->activeSection = null;
        $this->payloadData = [];
        $this->showSectionForm = false;

        // Force refresh komponen
        $this->dispatch('groupSelected', group: $group);
    }

    public function loadSections(): void
    {
        if (! $this->activeGroup) {
            $this->sections = collect();

            return;
        }

        $this->sections = CustomPage::where('group', $this->activeGroup)
            ->orderBy('id')
            ->get()
            ->map(function ($item) {
                $item->payload = is_string($item->payload)
                    ? json_decode($item->payload, true)
                    : ($item->payload ?? []);

                return $item;
            });

        // Reset active section dan payload data
        $this->activeSection = $this->sections->first()->section ?? null;
        $this->payloadData = $this->sections->first()->payload ?? [];
    }

    public function selectSection(string $section): void
    {
        $this->activeSection = $section;
        $activeSection = $this->sections->firstWhere('section', $this->activeSection);
        $this->payloadData = is_string($activeSection->payload) ?
            json_decode($activeSection->payload, true) :
            ($activeSection->payload ?? []);
    }

    public function form(Form $form): Form
    {
        $schema = [
            Tabs::make('Page Content')
                ->tabs(function () {
                    $tabs = [];

                    foreach ($this->sections ?? [] as $section) {
                        $tabs[] = Tabs\Tab::make($section->name ?: ucfirst($section->section))
                            ->icon($this->getSectionIcon($section->section))
                            ->schema($this->getSectionFormSchema($section));
                    }

                    return $tabs;
                })
                ->persistTabInQueryString()
                ->columnSpanFull(),
        ];

        // Hanya tambahkan form section baru jika showSectionForm true
        if ($this->showSectionForm) {
            $schema[] = $this->getNewSectionForm();
        }

        return $form
            ->schema($schema)
            ->statePath('payloadData');
    }

    protected function getNewSectionForm(): Section
    {
        return Section::make('Add New Section')
            ->schema([
                TextInput::make('name')
                    ->label('Section Name')
                    ->required(),
                Select::make('type')
                    ->label('Section Type')
                    ->options([
                        'text' => 'Text Content',
                        'list' => 'List Content',
                        'gallery' => 'Image Gallery',
                        'features' => 'Features List',
                        'custom' => 'Custom Fields',
                    ])
                    ->required(),
                Textarea::make('description')
                    ->label('Description'),
                FileUpload::make('image')
                    ->label('Featured Image')
                    ->image()
                    ->directory('custom-pages'),
            ]);
    }

    protected function getSectionIcon(string $section): string
    {
        return match ($section) {
            'head' => 'heroicon-o-identification',
            'main' => 'heroicon-o-document-text',
            'footer' => 'heroicon-o-queue-list',
            default => 'heroicon-o-cog'
        };
    }

    protected function getSectionFormSchema($section): array
    {
        // Tambahkan logika untuk menangani berbagai jenis section
        switch ($section->type ?? 'default') {
            case 'hero':
                return $this->getHeroSectionSchema();
            case 'gallery':
                return $this->getGallerySectionSchema();
            case 'features':
                return $this->getFeaturesSectionSchema();
            case 'text':
                return $this->getTextSectionSchema();
            case 'list':
                return $this->getListSectionSchema();
            default:
                return $this->getDefaultSectionSchema($section);
        }
    }

    protected function getHeroSectionSchema(): array
    {
        return [
            Section::make('Hero Section')
                ->schema([
                    TextInput::make('title')
                        ->label('Title')
                        ->required(),

                    Textarea::make('subtitle')
                        ->label('Subtitle'),

                    FileUpload::make('background_image')
                        ->label('Background Image')
                        ->image()
                        ->directory('custom-pages/hero')
                        ->disk('public') // pastikan pakai public disk
                        ->visibility('public'),

                    TextInput::make('button_text')
                        ->label('Button Text'),

                    TextInput::make('button_link')
                        ->label('Button Link')
                        ->url(),
                ]),
        ];
    }

    protected function getGallerySectionSchema(): array
    {
        return [
            Section::make('Image Gallery')
                ->schema([
                    Repeater::make('images')
                        ->schema([
                            Forms\Components\Section::make('Image')
                                ->description('Upload image here')
                                ->schema([
                                    SpatieMediaLibraryFileUpload::make('galleries')
                                        ->collection('galleries')
                                        ->multiple(false)
                                        ->maxFiles(1)
                                        ->imagePreviewHeight('250')
                                        ->panelLayout('compact')
                                        ->imageResizeMode('cover')
                                        ->imageResizeTargetWidth('1200')
                                        ->imageResizeTargetHeight('800')
                                        ->acceptedFileTypes(['image/*'])
                                        ->columnSpanFull(),
                                ])
                                ->compact(),
                        ])
                        ->grid(2),
                ]),
        ];
    }

    protected function getFeaturesSectionSchema(): array
    {
        return [
            Section::make('Features')
                ->schema([
                    Repeater::make('features')
                        ->schema([
                            TextInput::make('title')
                                ->label('Title')
                                ->required(),
                            Textarea::make('description')
                                ->label('Description'),
                            Forms\Components\Section::make('Image')
                                ->description('Upload image here')
                                ->schema([
                                    SpatieMediaLibraryFileUpload::make('features')
                                        ->collection('features')
                                        ->multiple(false)
                                        ->maxFiles(1)
                                        ->imagePreviewHeight('250')
                                        ->panelLayout('compact')
                                        ->imageResizeMode('cover')
                                        ->imageResizeTargetWidth('1200')
                                        ->imageResizeTargetHeight('800')
                                        ->acceptedFileTypes(['image/*'])
                                        ->columnSpanFull(),
                                ])
                                ->compact(),
                        ])
                        ->grid(2),
                ]),
        ];
    }

    protected function getTextSectionSchema(): array
    {
        return [
            Section::make('Text Content')
                ->schema([
                    TextInput::make('title')
                        ->label('Title'),
                    Textarea::make('content')
                        ->label('Content')
                        ->columnSpanFull(),
                ]),
        ];
    }

    protected function getListSectionSchema(): array
    {
        return [
            Section::make('List Content')
                ->schema([
                    TextInput::make('ca_list')
                        ->label('List 1'),
                    TextInput::make('cb_list')
                        ->label('List 2'),
                    TextInput::make('cc_list')
                        ->label('List 3'),
                    TextInput::make('cd_list')
                        ->label('List 4'),
                    TextInput::make('ce_list')
                        ->label('List 5'),
                ]),
        ];
    }

    protected function getDefaultSectionSchema($section): array
    {
        return [
            Section::make($section->name ?: ucfirst($section->section))
                ->schema([
                    KeyValue::make('fields')
                        ->keyLabel('Field Name')
                        ->valueLabel('Value')
                        ->columnSpanFull(),
                ]),
        ];
    }

    // Tambahkan method untuk menangani section baru
    public function addNewSection(): void
    {
        $this->validate([
            'newSectionData.name' => 'required',
            'newSectionData.type' => 'required',
        ]);

        $section = CustomPage::create([
            'group' => $this->activeGroup,
            'section' => strtolower(str_replace(' ', '_', $this->newSectionData['name'])),
            'name' => $this->newSectionData['name'],
            'type' => $this->newSectionData['type'],
            'payload' => $this->newSectionData,
        ]);

        $this->showSectionForm = false;
        $this->newSectionData = [];
        $this->loadSections();
        $this->selectSection($section->section);

        Notification::make()
            ->title('Section created successfully!')
            ->success()
            ->send();
    }

    public function save(): void
    {
        try {
            $section = $this->sections->firstWhere('section', $this->activeSection);

            if (! $section) {
                return;
            }

            // Ambil data dari form
            $data = $this->form->getState();

            // Jika ada background_image, simpan sebagai URL publik
            if (! empty($data['background_image'])) {
                $data['background_image'] = Storage::disk('public')->url($data['background_image']);
            }

            // Update payload sebagai JSON
            $section->update([
                'payload' => $data,
            ]);

            Notification::make()
                ->title('Section updated successfully!')
                ->body("The {$this->activeSection} section has been saved.")
                ->success()
                ->send();

        } catch (\Throwable $th) {
            Notification::make()
                ->title('Error saving section')
                ->body($th->getMessage())
                ->danger()
                ->send();
        }
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Sites');
    }

    public static function getNavigationLabel(): string
    {
        return __('Custom Pages');
    }

    public function getTitle(): string
    {
        return __('Manage Custom Pages');
    }

    public function getHeading(): string
    {
        return __('Custom Page Manager');
    }

    public function getSubheading(): ?string
    {
        return __('Manage all your custom page content in one place');
    }
}
