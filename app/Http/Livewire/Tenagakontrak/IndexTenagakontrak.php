<?php

namespace App\Http\Livewire\Tenagakontrak;

use Livewire\Component;

class IndexTenagakontrak extends Component
{


    public $nama;


    protected $rules = [
        'nama' => 'required|integer',
    ];

    public function store()
    {
        // dd(trans('validation.required'));
        $this->validate();

        dd('lolos validasi');
    }
}
