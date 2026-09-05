<?php

namespace App\Filament\Pages\Setting;

use App\Settings\PortfolioPageSettings;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\SettingsPage;
use Filament\Support\Facades\FilamentView;
use Illuminate\Contracts\Support\Htmlable;

use function Filament\Support\is_app_url;

class ManagePortfolioPage extends SettingsPage
{
    use HasPageShield;

    protected static string $settings = PortfolioPageSettings::class;

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

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
                ->title('Portfolio page settings updated')
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
        return 'Portfolio Page';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Portfolio Page Settings';
    }

    public function getHeading(): string|Htmlable
    {
        return 'Portfolio Page Settings';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Manage headings shown on the Portfolio page';
    }
}
