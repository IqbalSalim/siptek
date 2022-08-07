<?php

namespace App\Http\Livewire\Verifikasi;

use App\Models\Presence;
use Livewire\Component;
use Livewire\WithPagination;

class DinasLuar extends Component
{
    use WithPagination;

    public $paginate = 10, $search = null;
    protected $listeners = ['render', 'delete'];

    public function render()
    {
        return view('livewire.verifikasi.dinas-luar', [
            'presences' => ($this->search == null || $this->search == '') ?
                Presence::whereNotNull('status')->orderByDesc('status')->paginate($this->paginate) :
                Presence::whereNotNull('status')->orderByDesc('status')->cariNama($this->search)->paginate($this->paginate)
        ]);
    }
}
