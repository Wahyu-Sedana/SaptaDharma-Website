<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroResource\Pages;
use App\Filament\Support\TranslatableTabs;
use App\Models\Hero;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HeroResource extends Resource
{
    protected static ?string $model = Hero::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Konten Halaman';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Utama')
                    ->description('Halaman tujuan dan teks utama hero.')
                    ->schema([
                        Forms\Components\Select::make('page_id')
                            ->label('Halaman')
                            ->relationship('page', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TranslatableTabs::make([
                            'title' => fn (string $name) => Forms\Components\TextInput::make($name)
                                ->label('Judul')
                                ->required()
                                ->maxLength(255),
                            'subtitle' => fn (string $name) => Forms\Components\Textarea::make($name)
                                ->label('Subjudul')
                                ->required(),
                        ]),
                    ]),

                Forms\Components\Section::make('Media')
                    ->description('Gambar latar atau video hero.')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar')
                            ->image()
                            ->directory('heroes')
                            ->required(),
                        Forms\Components\FileUpload::make('video')
                            ->label('Video (opsional)')
                            ->directory('videos')
                            ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg']),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'publish' => 'Publish',
                            ])
                            ->native(false)
                            ->default('publish')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page.name')
                    ->label('Page')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->defaultImageUrl(asset('images/no-image.png')),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'publish' ? 'success' : 'gray'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'publish' => 'Publish',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroes::route('/'),
            'create' => Pages\CreateHero::route('/create'),
            'edit' => Pages\EditHero::route('/{record}/edit'),
        ];
    }
}
