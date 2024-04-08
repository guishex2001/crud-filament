<?php

namespace App\Filament\Resources\TvboxResource\Pages;

use App\Filament\Resources\TvboxResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTvbox extends EditRecord
{
    protected static string $resource = TvboxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
