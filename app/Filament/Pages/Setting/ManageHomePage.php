<?php

namespace App\Filament\Pages\Setting;

use App\Settings\HomePageSettings;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\SettingsPage;
use Filament\Support\Facades\FilamentView;
use Illuminate\Contracts\Support\Htmlable;

use function Filament\Support\is_app_url;

class ManageHomePage extends SettingsPage
{
    use HasPageShield;

    protected static string $settings = HomePageSettings::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->fillForm();
    }

    protected function fillForm(): void
    {
        $settings = app(static::getSettings());

        $data = $this->mutateFormDataBeforeFill($settings->toArray());

        $this->form->fill($data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero Slider')
                    ->icon('heroicon-o-photo')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('hero_slug_text')->label('Small Tagline')->maxLength(255),
                        Forms\Components\TextInput::make('hero_title')->label('Hero Title')->required()->maxLength(255),
                        Forms\Components\Textarea::make('hero_paragraph')->label('Hero Paragraph')->rows(2)->maxLength(500),
                        Forms\Components\TextInput::make('hero_button_text')->label('Hero Button Text')->maxLength(100),
                        Forms\Components\Grid::make()->schema([
                            Forms\Components\TextInput::make('hero_counter_number')->label('Counter Number'),
                            Forms\Components\TextInput::make('hero_counter_suffix')->label('Counter Suffix'),
                        ])->columns(2),
                        Forms\Components\Textarea::make('hero_counter_text')->label('Counter Description')->rows(2)->maxLength(300),
                    ])->columns(2),

                Forms\Components\Section::make('Sidebar')
                    ->icon('heroicon-o-bars-3')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Textarea::make('sidebar_about_text')->label('Sidebar About Text')->rows(3)->maxLength(500)->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Feature / CTA Strip')
                    ->icon('heroicon-o-megaphone')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('feature_cta_text')->label('CTA Text')->maxLength(255),
                        Forms\Components\TextInput::make('feature_cta_link_text')->label('CTA Link Label')->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('About Section')
                    ->icon('heroicon-o-information-circle')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('about_heading')->label('Heading')->required()->maxLength(255)->columnSpanFull(),
                        Forms\Components\TextInput::make('about_subheading')->label('Subheading')->maxLength(255)->columnSpanFull(),
                        Forms\Components\TagsInput::make('about_features')->label('Feature List')->helperText('Press enter to add each item')->columnSpanFull(),
                        Forms\Components\FileUpload::make('about_image')->label('About Image')->image()->directory('pages/home')->visibility('public')->moveFiles()->imagePreviewHeight('100'),
                        Forms\Components\Grid::make()->schema([
                            Forms\Components\TextInput::make('about_experience_number')->label('Experience Number'),
                            Forms\Components\TextInput::make('about_experience_suffix')->label('Suffix'),
                            Forms\Components\TextInput::make('about_experience_label')->label('Label'),
                        ])->columns(3),
                    ])->columns(2),

                Forms\Components\Section::make('Contact / Map Section')
                    ->icon('heroicon-o-map-pin')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('contact_heading')->label('Heading')->maxLength(255),
                        Forms\Components\FileUpload::make('contact_image')->label('Contact Image')->image()->directory('pages/home')->visibility('public')->moveFiles()->imagePreviewHeight('100'),
                        Forms\Components\TextInput::make('map_embed_url')->label('Google Maps Embed URL')->url()->columnSpanFull(),
                    ])->columns(2),
            ])
            ->columns(1)
            ->statePath('data');
    }

    public function save(): void
    {
        try {
            $data = $this->mutateFormDataBeforeSave($this->form->getState());

            $settings = app(static::getSettings());

            $settings->fill($data);
            $settings->save();

            Notification::make()
                ->title('Home page settings updated')
                ->success()
                ->send();

            $this->redirect(static::getUrl(), navigate: FilamentView::hasSpaMode() && is_app_url(static::getUrl()));
        } catch (\Throwable $th) {
            Notification::make()
                ->title('Error saving settings')
                ->body($th->getMessage())
                ->danger()
                ->send();

            throw $th;
        }
    }

    public static function getNavigationGroup(): ?string
    {
        return __('menu.nav_group.content');
    }

    public static function getNavigationLabel(): string
    {
        return 'Home Page';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Home Page Settings';
    }

    public function getHeading(): string|Htmlable
    {
        return 'Home Page Settings';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Manage headings, paragraphs, and single images shown on the homepage';
    }
}
