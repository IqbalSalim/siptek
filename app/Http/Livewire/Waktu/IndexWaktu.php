<?php

namespace App\Http\Livewire\Waktu;

use App\Models\Time;
use Carbon\Carbon;
use Livewire\Component;

class IndexWaktu extends Component
{
    public $times;
    protected $listeners = ['render'];

    public function mount()
    {
        //Penting
        // $today = Carbon::createFromFormat('Y-m-d', '2022-05-22')->isoFormat('dddd');
        // dd($today);
        $this->times = Time::all();
    }

    public function render()
    {
        return view('livewire.waktu.index-waktu');
    }
}
