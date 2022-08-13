<?php

namespace App\Http\Livewire\Tenagakontrak;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UbahPassword extends Component
{
    public $password, $password_confirmation;

    public function render()
    {
        return view('livewire.tenagakontrak.ubah-password');
    }

    public function update()
    {

        $this->validate([
            'password' => 'required|confirmed|min:6',
        ]);
        $id = Auth::user()->id;
        $user =  User::find($id);
        $user->update([
            'password' => Hash::make($this->password),
        ]);

        return redirect()->route('logout.destroy');
    }

    public function kembali()
    {
        return redirect()->route('dashboard');
    }
}
