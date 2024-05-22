<?php

namespace App\Livewire;

use Ijpatricio\Mingle\Concerns\InteractsWithMingles;
use Ijpatricio\Mingle\Contracts\HasMingles;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Vite;
use Livewire\Component;

class billy extends Component implements HasMingles
{
    use InteractsWithMingles;

    public function component(): string
    {

        return 'resources/js/billy.js';
    }

    public function mingleData(): array
    {
        return [
            'message' => 'Message in a bottle 🍾',
        ];
    }

    public function doubleIt($amount)
    {
        return $amount * 2;
    }
}
