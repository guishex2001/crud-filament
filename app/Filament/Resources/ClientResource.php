<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nombre')->label('Nombre'),
            Forms\Components\Datepicker::make('fecha_pago')->label('Fecha de pago')->placeholder('Fecha de pago'), // Modificado
            Forms\Components\Datepicker::make('fecha_vencimiento')->label('Fecha de vencimiento'),
            // Aquí cambiamos Boolean::make por Toggle::make
            Forms\Components\Toggle::make('estado_pago')->label('Estado de pago'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->label('Nombre')->searchable(),
                Tables\Columns\TextColumn::make('fecha_pago')->label('Fecha de Pago')->date(),
                Tables\Columns\TextColumn::make('fecha_vencimiento')->label('Fecha de Vencimiento')->date(),
                Tables\Columns\BooleanColumn::make('estado_pago')
                    ->label('Estado de Pago')
                    ->trueIcon('heroicon-s-check')
                    ->falseIcon('heroicon-s-x-mark')
                    ->colors([
                        'true' => 'success',
                        'false' => 'danger',
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
