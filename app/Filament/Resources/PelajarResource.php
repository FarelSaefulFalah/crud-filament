<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pelajar;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PelajarResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PelajarResource\RelationManagers;

class PelajarResource extends Resource
{
    protected static ?string $model = Pelajar::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nim')->required()->unique(ignorable:fn($record)=>$record),
                        TextInput::make('nama')->required(),
                        Select::make('jurusan')
                            ->options([
                                'RPL'=>'RPL',
                                'TKRO'=>'TKRO',
                                'TBSM'=>'TBSM',
                            ]),

                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nim')->searchable()->sortable(),
                TextColumn::make('nama')->searchable()->sortable(),
                TextColumn::make('jurusan')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPelajars::route('/'),
            'create' => Pages\CreatePelajar::route('/create'),
            'edit' => Pages\EditPelajar::route('/{record}/edit'),
        ];
    }
}
