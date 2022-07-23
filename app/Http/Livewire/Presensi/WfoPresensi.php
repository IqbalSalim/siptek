<?php

namespace App\Http\Livewire\Presensi;

use App\Models\Presence;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class WfoPresensi extends Component
{
    use WithFileUploads;

    public $foto;

    public function save()
    {
        $this->validate([
            'foto' => 'required|image',
        ]);
        $userId = auth()->user()->id;
        $dateNow = Carbon::today();
        $timeNow = Carbon::now()->format('H:i:m');


        $foto = $this->foto->store('presences', 'public');

        try {
            // Transaction
            $exception = DB::transaction(function ()  use ($userId, $dateNow, $foto, $timeNow) {
                $presensi = Presence::where('user_id', $userId)->whereDate('created_at', $dateNow)->first();
                if (!empty($presensi)) {
                    $presensi->update([
                        'user_id' => $userId,
                        'type' => 'WFO',
                        'go_photo' => $foto,
                        'go_presence' => $timeNow,
                    ]);
                } else {
                    Presence::create([
                        'user_id' => $userId,
                        'type' => 'WFO',
                        'come_photo' => $foto,
                        'come_presence' => $timeNow,
                    ]);
                }
            });

            if (is_null($exception)) {
                $this->closeForm();
                $this->dispatchBrowserEvent('swal:success', [
                    'type' => 'success',
                    'message' => 'Data Berhasil Disimpan!',
                    'text' => 'ini telah disimpan di tabel Presensi.'
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

        $this->reset('foto');
        $this->resetValidation();
        $this->dispatchBrowserEvent('close-modal-wfo');
    }
}
