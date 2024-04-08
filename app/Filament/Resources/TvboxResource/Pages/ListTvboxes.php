<?php

namespace App\Filament\Resources\TvboxResource\Pages;

use App\Filament\Resources\TvboxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTvboxes extends ListRecords
{
    protected static string $resource = TvboxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
