<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Pages;
use App\Filament\Resources\SectionResource\RelationManagers\ItemsRelationManager;
use App\Filament\Support\TranslatableTabs;
use App\Models\Section;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Konten Halaman';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Utama')
                    ->description('Halaman tujuan, slug, dan konten section.')
                    ->schema([
                        Forms\Components\Select::make('page_id')
                            ->label('Halaman')
                            ->relationship('page', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        TranslatableTabs::make([
                            'title' => fn (string $name) => Forms\Components\TextInput::make($name)
                                ->label('Judul')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $state, callable $set) use ($name) {
                                    if (str_ends_with($name, '.id')) {
                                        $set('slug', Str::slug($state));
                                    }
                                }),
                            'subtitle' => fn (string $name) => Forms\Components\Textarea::make($name)
                                ->label('Subjudul'),
                            'description' => fn (string $name) => Forms\Components\RichEditor::make($name)
                                ->label('Deskripsi'),
                        ]),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Media & Tombol')
                    ->description('Gambar section dan tombol aksi opsional.')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar')
                            ->image()
                            ->directory('sections'),
                        TranslatableTabs::make([
                            'button_text' => fn (string $name) => Forms\Components\TextInput::make($name)
                                ->label('Teks Tombol')
                                ->maxLength(255),
                        ]),
                        Forms\Components\TextInput::make('button_link')
                            ->label('Tautan Tombol')
                            ->maxLength(255),
                    ]),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'publish' => 'Publish',
                            ])
                            ->native(false)
                            ->default('publish')
                            ->required(),
                    ])
                    ->columns(2),
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
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->defaultImageUrl(asset('images/no-image.png')),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'publish' ? 'success' : 'gray'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
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

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSections::route('/'),
            'create' => Pages\CreateSection::route('/create'),
            'edit' => Pages\EditSection::route('/{record}/edit'),
        ];
    }
}
