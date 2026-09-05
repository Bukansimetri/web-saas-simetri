<?php

namespace App\Filament\Pages\Setting;

use App\Settings\AboutPageSettings;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\SettingsPage;
use Filament\Support\Facades\FilamentView;
use Illuminate\Contracts\Support\Htmlable;

use function Filament\Support\is_app_url;

class ManageAboutPage extends SettingsPage
{
    use HasPageShield;

    protected static string $settings = AboutPageSettings::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

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
                Forms\Components\TextInput::make('hero_title')->label('Breadcrumb Title')->required()->maxLength(255),

                Forms\Components\Section::make('About Section')
                    ->icon('heroicon-o-information-circle')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('about_subtitle')->label('Subtitle')->maxLength(255),
                        Forms\Components\TextInput::make('about_heading')->label('Heading')->maxLength(255),
                        Forms\Components\Textarea::make('about_paragraph_1')->label('Paragraph 1')->rows(3)->maxLength(1000)->columnSpanFull(),
                        Forms\Components\Textarea::make('about_paragraph_2')->label('Paragraph 2')->rows(3)->maxLength(1000)->columnSpanFull(),
                        Forms\Components\FileUpload::make('about_image')->label('Image')->image()->directory('pages/about')->visibility('public')->moveFiles()->imagePreviewHeight('100'),
                        Forms\Components\TextInput::make('about_button_text')->label('Button Text')->maxLength(100),
                    ])->columns(2),

                Forms\Components\Section::make('CTA Section')
                    ->icon('heroicon-o-megaphone')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('cta_heading')->label('Heading')->maxLength(255),
                        Forms\Components\TextInput::make('cta_button_text')->label('Button Text')->maxLength(100),
                    ])->columns(2),

                Forms\Components\Section::make('FAQ Section')
                    ->icon('heroicon-o-question-mark-circle')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('faq_subtitle')->label('Subtitle')->maxLength(255),
                        Forms\Components\TextInput::make('faq_heading')->label('Heading')->maxLength(255),
                        Forms\Components\FileUpload::make('faq_image')->label('Image')->image()->directory('pages/about')->visibility('public')->moveFiles()->imagePreviewHeight('100'),
                    ])->columns(2),

                Forms\Components\Section::make('Testimonial Section')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('testimonial_subtitle')->label('Subtitle')->maxLength(255),
                        Forms\Components\TextInput::make('testimonial_heading')->label('Heading')->maxLength(255),
                        Forms\Components\FileUpload::make('testimonial_image')->label('Image')->image()->directory('pages/about')->visibility('public')->moveFiles()->imagePreviewHeight('100'),
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
                ->title('About page settings updated')
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
        return 'About Us Page';
    }

    public function getTitle(): string|Htmlable
    {
        return 'About Us Page Settings';
    }

    public function getHeading(): string|Htmlable
    {
        return 'About Us Page Settings';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Manage headings, paragraphs, and single images shown on the About Us page';
    }
}
