<?php

namespace App\Filament\Resources\BarangResourceResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StocksRelationManager extends RelationManager
{
    protected static string $relationship = 'stocks';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('gudang_id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('gudang_id')
            ->columns([
                Tables\Columns\TextColumn::make('gudang.nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('balance')
                    ->sortable(),
                Tables\Columns\TextColumn::make('barang.satuan'),
            ])
            ->filters([
                TernaryFilter::make('balance')
                ->label('Stock Balance')
                ->placeholder('All')
                ->trueLabel('ha Balance')
                ->falseLabel('no Balance')
                ->queries(
                    true: fn (Builder $query) => $query->hasBalance(),
                    false: fn (Builder $query) => $query->noBalance(),
                    blank: fn (Builder $query) => $query,
                )
            ])
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