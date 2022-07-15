<?php

namespace App\Http\Livewire\Tenagakontrak;

use App\Models\Employee;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class IndexTenagakontrak extends Component
{
    use WithPagination;

    public $paginate = 10, $search = null;

    protected $listeners = ['render'];

    public function render()
    {
        // dd(User::find(8));
        return view('livewire.tenagakontrak.index-tenagakontrak', [
            'employees' => ($this->search == null || $this->search == '') ?
                Employee::latest()->paginate($this->paginate) :
                Employee::cariNama($this->search)->paginate($this->paginate)
        ]);
    }
}
