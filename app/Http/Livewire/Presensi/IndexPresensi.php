<?php

namespace App\Http\Livewire\Presensi;

use Livewire\Component;

class IndexPresensi extends Component
{
    public $presence, $presences;

    protected $listeners = ['render'];

    public function render()
    {

        return view('livewire.presensi.index-presensi');
    }
}
