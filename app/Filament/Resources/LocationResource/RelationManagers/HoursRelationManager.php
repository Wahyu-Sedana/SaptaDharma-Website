<?php

namespace App\Filament\Resources\LocationResource\RelationManagers;

use App\Models\LocationHour;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class HoursRelationManager extends RelationManager
{
    protected static string $relationship = 'hours';

    protected static ?string $title = 'Jam Operasional';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('day')
                    ->label('Hari')
                    ->options(LocationHour::DAYS)
                    ->required()
                    ->native(false)
                    ->unique(
                        ignoreRecord: true,
                        modifyRuleUsing: fn (\Illuminate\Validation\Rules\Unique $rule) => $rule->where('location_id', $this->getOwnerRecord()->id),
                    ),
                Forms\Components\Toggle::make('is_closed')
                    ->label('Tutup Sepanjang Hari')
                    ->live()
                    ->default(false),
                Forms\Components\TimePicker::make('open_time')
                    ->label('Buka')
                    ->required(fn (Forms\Get $get) => ! $get('is_closed'))
                    ->hidden(fn (Forms\Get $get) => (bool) $get('is_closed')),
                Forms\Components\TimePicker::make('close_time')
                    ->label('Tutup')
                    ->required(fn (Forms\Get $get) => ! $get('is_closed'))
                    ->hidden(fn (Forms\Get $get) => (bool) $get('is_closed')),
            ])
            ->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('day')
            ->columns([
                Tables\Columns\TextColumn::make('day')
                    ->label('Hari')
                    ->formatStateUsing(fn (int $state): string => LocationHour::DAYS[$state] ?? '-'),
                Tables\Columns\IconColumn::make('is_closed')
                    ->label('Tutup')
                    ->boolean(),
                Tables\Columns\TextColumn::make('open_time')
                    ->label('Buka')
                    ->time(),
                Tables\Columns\TextColumn::make('close_time')
                    ->label('Tutup')
                    ->time(),
            ])
            ->defaultSort('day')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
