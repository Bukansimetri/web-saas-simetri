<?php

namespace App\Filament\Pages\Setting;

use App\Settings\ServicesPageSettings;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\SettingsPage;
use Filament\Support\Facades\FilamentView;
use Illuminate\Contracts\Support\Htmlable;

use function Filament\Support\is_app_url;

class ManageServicesPage extends SettingsPage
{
    use HasPageShield;

    protected static string $settings = ServicesPageSettings::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

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

                Forms\Components\Section::make('CTA Section')
                    ->icon('heroicon-o-megaphone')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('cta_heading')->label('Heading')->maxLength(255),
                        Forms\Components\TextInput::make('cta_button_text')->label('Button Text')->maxLength(100),
                    ])->columns(2),

                Forms\Components\Section::make('Working Skill Section')
                    ->icon('heroicon-o-chart-bar')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('skill_subtitle')->label('Subtitle')->maxLength(255),
                        Forms\Components\TextInput::make('skill_heading')->label('Heading')->maxLength(255),
                        Forms\Components\Textarea::make('skill_paragraph')->label('Paragraph')->rows(2)->maxLength(500)->columnSpanFull(),
                        Forms\Components\FileUpload::make('skill_image')->label('Image')->image()->directory('pages/services')->visibility('public')->moveFiles()->imagePreviewHeight('100'),
                    ])->columns(2),

                Forms\Components\Section::make('Pricing Section')
                    ->icon('heroicon-o-currency-dollar')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('pricing_subtitle')->label('Subtitle')->maxLength(255),
                        Forms\Components\TextInput::make('pricing_heading')->label('Heading')->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Work Process Section')
                    ->icon('heroicon-o-list-bullet')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('work_process_subtitle')->label('Subtitle')->maxLength(255),
                        Forms\Components\TextInput::make('work_process_heading')->label('Heading')->maxLength(255),
                        Forms\Components\Textarea::make('work_process_paragraph')->label('Paragraph')->rows(2)->maxLength(500)->columnSpanFull(),
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
                ->title('Services page settings updated')
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
        return 'Services Page';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Services Page Settings';
    }

    public function getHeading(): string|Htmlable
    {
        return 'Services Page Settings';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Manage headings and paragraphs shown on the Services page';
    }
}
