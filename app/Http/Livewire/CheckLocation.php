<?php

namespace App\Http\Livewire;

use App\Models\Presence;
use Livewire\Component;

class CheckLocation extends Component
{
    protected $listeners = ['checkLocation'];

    public function render()
    {
        return view('livewire.check-location');
    }

    public function checkLocation($id)
    {
        $location = Presence::find($id);
        dd($location);
    }

    public function closeLocation()
    {
        $this->dispatchBrowserEvent('close-modal-check-location');
    }
}
