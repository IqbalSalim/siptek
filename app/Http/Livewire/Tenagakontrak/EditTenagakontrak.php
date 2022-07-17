<?php

namespace App\Http\Livewire\Tenagakontrak;

use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditTenagakontrak extends Component
{
    use WithFileUploads;

    public $employee, $kdAnggota, $nama, $tempat, $tanggal, $email, $pendidikan, $nohp, $alamat, $foto, $preview, $iteration;
    public $employee_id;
    protected $listeners = ['getEmployee'];

    public function getEmployee($id)
    {
        $query = Employee::where('user_id', $id)->first();
        $this->employee = $query;
        $this->kdAnggota = $query->member_id;
        $this->nama = $query->user->name;
        $this->iteration = $query->user_id;
        $this->tempat = $query->birthplace;
        $this->tanggal = $query->birthdate;
        $this->email = $query->user->email;
        $this->pendidikan = $query->last_education;
        $this->nohp = $query->phone;
        $this->alamat = $query->address;
        $this->preview = $query->image;
        $this->employee_id = $id;
    }


    public function closeForm()
    {
        $this->reset('kdAnggota', 'nama', 'tempat', 'tanggal', 'email', 'pendidikan', 'nohp', 'alamat', 'foto', 'preview');

        $this->dispatchBrowserEvent('close-modal-edit');
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->employee->user_id,
            'tempat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'pendidikan' => 'required|string|max:255',
            'nohp' => 'required|numeric|digits_between:9,13',
            'alamat' => 'required|string|max:255',
        ]);


        if ($this->foto) {
            $foto = $this->foto->store('photos', 'public');
        } else {
            $foto = $this->preview;
        }

        $id = $this->employee_id;

        try {
            // Transaction
            $exception = DB::transaction(function () use ($foto, $id) {
                User::find($id)->update([
                    'name' => $this->nama,
                    'email' => $this->email,
                ]);

                $employee = Employee::find($id);
                $employee->update([
                    'birthplace' => $this->tempat,
                    'birthdate' => $this->tanggal,
                    'last_education' => $this->pendidikan,
                    'phone' => $this->nohp,
                    'address' => $this->alamat,
                    'image' => $foto,
                ]);
            });

            if (is_null($exception)) {
                if (!empty($this->foto) && Storage::disk('public')->exists($this->preview)) {
                    Storage::disk('public')->delete($this->preview);
                }
                $this->closeForm();
                $this->dispatchBrowserEvent('swal:success', [
                    'type' => 'success',
                    'message' => 'Data Berhasil Diubah!',
                    'text' => 'ini telah disimpan di tabel Tenaga Kontrak.'
                ]);
                $this->emit('render');
            } else {
                throw new Exception();
            }
        } catch (Exception $e) {
            if (Storage::disk('public')->exists($foto)) {
                Storage::disk('public')->delete($foto);
            }
            $this->dispatchBrowserEvent('swal:error', [
                'type' => 'success',
                'message' => 'Terjadi Kesalahan!',
                'text' => 'silahkan periksa kembali inputan atau hubungi developer.'
            ]);
        }
    }
}
