<?php

namespace App\Http\Livewire\Tenagakontrak;

use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\ComponentConcerns\ValidatesInput;
use Livewire\WithFileUploads;

class TambahTenagakontrak extends Component
{
    use ValidatesInput, WithFileUploads;

    public $nama, $tempat, $tanggal, $email, $pendidikan, $nohp, $alamat, $foto;


    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'tempat' => 'required|string|max:255',
        'tanggal' => 'required|date',
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
                    'email' => $this->email,
                    'password' => Hash::make('password')
                ]);

                Employee::create([
                    'user_id' => $user->id,
                    'name' => $this->nama,
                    'birthplace' => $this->tempat,
                    'birthdate' => $this->tanggal,
                    'last_education' => $this->pendidikan,
                    'phone' => $this->nohp,
                    'address' => $this->alamat,
                    'image' => $foto,
                ]);
            });

            if (is_null($exception)) {
                $this->resetInput();
                $this->dispatchBrowserEvent('close-modal-tambah');
                $this->dispatchBrowserEvent('swal:success', [
                    'type' => 'success',
                    'message' => 'Data Berhasil Ditambahkan!',
                    'text' => 'ini telah disimpan di tabel Tenaga Kontrak.'
                ]);
            } else {
                throw new Exception();
            }
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('swal:error', [
                'type' => 'success',
                'message' => 'Terjadi Kesalahan!',
                'text' => 'silahkan periksa kembali inputan atau hubungi developer.'
            ]);
        }
    }

    public function resetInput()
    {
        $this->nama = null;
        $this->tempat = null;
        $this->tanggal = null;
        $this->email = null;
        $this->pendidikan = null;
        $this->nohp = null;
        $this->alamat = null;
        $this->foto = null;
    }
}
