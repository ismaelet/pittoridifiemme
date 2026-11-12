<?php

namespace App\Filament\Resources\Artists\Pages\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

// The biography PDF is stored as documents/{artist ID}.pdf, and is mutually exclusive with the bio URL.
trait HandlesBiographyPdf
{
    protected function syncBiographyPdf(): void
    {
        $disk = Storage::disk('public');
        $target = 'documents/'.$this->record->ID.'.pdf';
        $uploaded = Arr::first(Arr::wrap($this->data['bio_pdf'] ?? []));

        if ($uploaded && $uploaded !== $target) {
            $disk->delete($target);
            $disk->move($uploaded, $target);
            $this->record->update(['bio' => '']);
        } elseif (! $uploaded || ($this->record->bio ?? '') !== '') {
            $disk->delete($target);
        }
    }
}
