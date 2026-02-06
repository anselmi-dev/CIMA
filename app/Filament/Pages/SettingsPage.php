<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Filament\Support\Enums\Alignment;

class SettingsPage extends Page
{
    use InteractsWithFormActions;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Configuración';

    protected static ?string $navigationLabel = 'Configuración del sitio web';

    protected static ?string $title = 'Configuración del sitio web';

    protected static ?int $navigationSort = 100;

    protected static string $view = 'filament.pages.settings';

    /**
     * @var array<string, mixed>
     */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        return app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin');
    }

    protected function getFormStatePath(): ?string
    {
        return 'data';
    }

    public function mount(): void
    {
        $this->form->fill($this->getInitialData());
    }

    /**
     * @return array<string, mixed>
     */
    protected function getInitialData(): array
    {
        $social = \Rawilk\Settings\Facades\Settings::get('social', []) ?: [];
        $seo = \Rawilk\Settings\Facades\Settings::get('seo', []) ?: [];

        return [
            'email' => \Rawilk\Settings\Facades\Settings::get('email', '') ?? '',
            'facebook_url' => $social['facebook_url'] ?? '',
            'instagram_url' => $social['instagram_url'] ?? '',
            'twitter_url' => $social['twitter_url'] ?? '',
            'linkedin_url' => $social['linkedin_url'] ?? '',
            'youtube_url' => $social['youtube_url'] ?? '',
            'tiktok_url' => $social['tiktok_url'] ?? '',
            'meta_title' => $seo['meta_title'] ?? '',
            'meta_description' => $seo['meta_description'] ?? '',
            'meta_keywords' => $seo['meta_keywords'] ?? '',
            'og_image' => $seo['og_image'] ?? '',
        ];
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema($this->getFormSchema())
                    ->statePath('data'),
            ),
        ];
    }

    /**
     * @return array<int, \Filament\Forms\Components\Component>
     */
    protected function getFormSchema(): array
    {
        return [
            Section::make('Contacto')
                ->schema([
                    TextInput::make('email')
                        ->label('Correo de la web')
                        ->email()
                        ->maxLength(255),
                ])
                ->columns(1),

            Section::make('Redes sociales')
                ->schema([
                    TextInput::make('facebook_url')
                        ->label('Facebook')
                        ->prefix('https://')
                        ->maxLength(255),
                    TextInput::make('instagram_url')
                        ->label('Instagram')
                        ->prefix('https://')
                        ->maxLength(255),
                    TextInput::make('twitter_url')
                        ->label('Twitter / X')
                        ->prefix('https://')
                        ->maxLength(255),
                    TextInput::make('linkedin_url')
                        ->label('LinkedIn')
                        ->prefix('https://')
                        ->maxLength(255),
                    TextInput::make('youtube_url')
                        ->label('YouTube')
                        ->prefix('https://')
                        ->maxLength(255),
                    TextInput::make('tiktok_url')
                        ->label('TikTok')
                        ->prefix('https://')
                        ->maxLength(255),
                ])
                ->columns(2),

            Section::make('SEO')
                ->schema([
                    TextInput::make('meta_title')
                        ->label('Título SEO')
                        ->maxLength(255)
                        ->columnSpanFull(),
                    Textarea::make('meta_description')
                        ->label('Descripción SEO')
                        ->rows(3)
                        ->columnSpanFull(),
                    TextInput::make('meta_keywords')
                        ->label('Palabras clave (separadas por coma)')
                        ->placeholder('palabra1, palabra2, palabra3')
                        ->maxLength(255)
                        ->columnSpanFull(),
                    TextInput::make('og_image')
                        ->label('Imagen para redes sociales (Open Graph)')
                        ->url()
                        ->maxLength(500)
                        ->columnSpanFull(),
                ]),
        ];
    }

    /**
     * @return array<Action | \Filament\Actions\ActionGroup>
     */
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Guardar')
                ->submit('save')
                ->keyBindings(['mod+s']),
        ];
    }

    public function getFormActionsAlignment(): string | Alignment
    {
        return Alignment::Start;
    }

    public function save(): void
    {
        $data = $this->form->getState();

        \Rawilk\Settings\Facades\Settings::set('email', $data['email'] ?? '');

        \Rawilk\Settings\Facades\Settings::set('social', [
            'facebook_url' => $data['facebook_url'] ?? '',
            'instagram_url' => $data['instagram_url'] ?? '',
            'twitter_url' => $data['twitter_url'] ?? '',
            'linkedin_url' => $data['linkedin_url'] ?? '',
            'youtube_url' => $data['youtube_url'] ?? '',
            'tiktok_url' => $data['tiktok_url'] ?? '',
        ]);

        \Rawilk\Settings\Facades\Settings::set('seo', [
            'meta_title' => $data['meta_title'] ?? '',
            'meta_description' => $data['meta_description'] ?? '',
            'meta_keywords' => $data['meta_keywords'] ?? '',
            'og_image' => $data['og_image'] ?? '',
        ]);

        Notification::make()
            ->success()
            ->title('Configuración guardada')
            ->send();
    }
}
