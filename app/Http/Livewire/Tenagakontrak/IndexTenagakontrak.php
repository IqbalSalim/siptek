<?php

namespace App\Http\Livewire\Tenagakontrak;

use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class IndexTenagakontrak extends Component
{
    use WithPagination;

    public $paginate = 10, $search = null;
    protected $listeners = ['render', 'delete'];

    public function render()
    {
        // dd(User::find(8));
        return view('livewire.tenagakontrak.index-tenagakontrak', [
            'employees' => ($this->search == null || $this->search == '') ?
                Employee::latest()->paginate($this->paginate) :
                Employee::cariNama($this->search)->paginate($this->paginate)
        ]);
    }

    public function delete($id)
    {
        $employee = Employee::find($id);
        $foto = $employee->image;
        try {
            // Transaction
            $exception = DB::transaction(function () use ($id, $employee, $foto) {
                // Do your SQL here
                User::find($id)->delete();
                $employee->delete();
            });

            if (is_null($exception)) {
                if (Storage::disk('public')->exists($foto)) {
                    Storage::disk('public')->delete($foto);
                }
                $this->dispatchBrowserEvent('swal:success', [
                    'type' => 'success',
                    'message' => 'Data Berhasil Dihapus!',
                    'text' => '...'
                ]);
                $this->emit('render');
            } else {
                throw new Exception();
            }
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('swal:error', [
                'type' => 'success',
                'message' => 'Terjadi Kesalahan!',
                'text' => 'silahkan hubungi developer.'
            ]);
        }
    }
}
