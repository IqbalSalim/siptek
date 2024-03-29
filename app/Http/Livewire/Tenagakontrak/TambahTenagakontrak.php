<?php

namespace App\Http\Livewire\Tenagakontrak;

use App\Models\Area;
use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\ComponentConcerns\ValidatesInput;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class TambahTenagakontrak extends Component
{
    use ValidatesInput, WithFileUploads;

    public $kdAnggota, $areaId, $nama, $tempat, $tanggal, $email, $pendidikan, $nohp, $alamat, $foto;
    public $areas;

    public function mount()
    {
        $this->areas = Area::all();
    }

    protected $rules = [
        'kdAnggota' => 'required|numeric|digits:5|unique:employees,member_id',
        'areaId' => 'required|integer',
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'tempat' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'pendidikan' => 'required|string|max:255',
        'nohp' => 'required|numeric|digits_between:9,13',
        'alamat' => 'required|string|max:255',
        'foto' => 'required|image|max:2048'
    ];

    public function store()
    {
        $this->validate();
        $foto = $this->foto->store('photos', 'public');

        try {
            // Transaction
            $exception = DB::transaction(function () use ($foto) {
                // Do your SQL here
                $user = User::create([
                    'name' => $this->nama,
                    'email' => $this->email,
                    'password' => Hash::make('password')
                ]);

                Employee::create([
                    'user_id' => $user->id,
                    'member_id' => $this->kdAnggota,
                    'area_id' => $this->areaId,
                    'birthplace' => $this->tempat,
                    'birthdate' => $this->tanggal,
                    'last_education' => $this->pendidikan,
                    'phone' => $this->nohp,
                    'address' => $this->alamat,
                    'image' => $foto,
                ]);

                $role = Role::where('name', 'tenaga kontrak')->first();
                $user->assignRole($role);
            });

            if (is_null($exception)) {
                $this->closeForm();
                $this->dispatchBrowserEvent('swal:success', [
                    'type' => 'success',
                    'message' => 'Data Berhasil Ditambahkan!',
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

    public function closeForm()
    {
        $this->reset('kdAnggota', 'nama', 'tempat', 'tanggal', 'email', 'pendidikan', 'nohp', 'alamat', 'foto');
        $this->resetValidation();
        $this->dispatchBrowserEvent('close-modal-tambah');
    }
}
