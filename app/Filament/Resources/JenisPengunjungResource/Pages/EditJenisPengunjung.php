<?php

namespace App\Filament\Resources\JenisPengunjungResource\Pages;

use App\Filament\Resources\JenisPengunjungResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisPengunjung extends EditRecord
{
    protected static string $resource = JenisPengunjungResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
