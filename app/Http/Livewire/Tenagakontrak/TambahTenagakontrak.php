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
        'email' => 'required|email',
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
                dd("berhasil simpan");
            } else {
                throw new Exception();
            }
        } catch (Exception $e) {
            dd($e);
        }


        dd('lolos validasi');
    }
}
