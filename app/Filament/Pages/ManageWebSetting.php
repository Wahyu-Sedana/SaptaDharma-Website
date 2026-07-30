<?php

namespace App\Filament\Pages;

use App\Models\WebSetting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageWebSetting extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Web Settings';

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static string $view = 'filament.pages.manage-web-setting';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(WebSetting::first()?->toArray() ?? []);
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas Situs')
                    ->description('Nama, logo, dan favicon yang tampil di seluruh situs.')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->label('Nama Situs')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('logo')
                            ->image()
                            ->directory('settings'),
                        Forms\Components\FileUpload::make('favicon')
                            ->image()
                            ->directory('settings'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Kontak')
                    ->schema([
                        Forms\Components\Textarea::make('address')
                            ->label('Alamat')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('phone')
                            ->label('Telepon')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Media Sosial')
                    ->schema([
                        Forms\Components\TextInput::make('facebook')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('instagram')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('youtube')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Lainnya')
                    ->schema([
                        Forms\Components\Textarea::make('google_maps')
                            ->columnSpanFull()
                            ->helperText('Embed iframe URL Google Maps'),
                        Forms\Components\TextInput::make('copyright')
                            ->maxLength(255),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        WebSetting::updateOrCreate(['id' => 1], $data);

        Notification::make()
            ->title('Pengaturan berhasil disimpan')
            ->success()
            ->send();
    }
}
