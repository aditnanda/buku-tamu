<?php

namespace App\Filament\Resources\JenisPengunjungResource\Pages;

use App\Filament\Resources\JenisPengunjungResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisPengunjungs extends ListRecords
{
    protected static string $resource = JenisPengunjungResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
