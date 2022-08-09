<?php

namespace App\Http\Livewire\Presensi;

use App\Models\Presence;
use App\Models\Time;
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
            'foto' => 'mimes:png,jpg,webp,heic',
        ]);
        $userId = auth()->user()->id;
        $dateNow = Carbon::today();
        $timeNow = Carbon::now()->format('H:i:m');
        $day = Carbon::now()->isoFormat('dddd');





        $foto = $this->foto->store('presences', 'public');

        try {
            // Transaction
            $exception = DB::transaction(function ()  use ($userId, $dateNow, $foto, $timeNow, $day) {
                $presensi = Presence::where('user_id', $userId)->whereDate('created_at', $dateNow)->first();
                $time = Time::where('day', 'like', $day)->first();

                if (!empty($presensi)) {
                    $a = Carbon::parse($timeNow);
                    $b = Carbon::parse($time->go_time);
                    $percent = null;
                    $code = null;
                    $selisih = null;
                    if ($a->lt($b)) {
                        $selisih = $a->diffInMinutes($b);
                        gmdate('H:i:s', $selisih);
                    }

                    if ($selisih >= 1 && $selisih <= 30) {
                        $percent = 0;
                        $code = 'CP1';
                    } elseif ($selisih >= 31 && $selisih <= 60) {
                        $percent = 0.5;
                        $code = 'CP2';
                    } elseif ($selisih >= 61 && $selisih <= 90) {
                        $percent = 1;
                        $code = 'CP3';
                    } elseif ($selisih > 90) {
                        $percent = 1.25;
                        $code = 'CP4';
                    } else {
                        $percent = null;
                        $code = null;
                    }

                    $presensi->update([
                        'user_id' => $userId,
                        'type' => 'WFO',
                        'go_photo' => $foto,
                        'go_presence' => $timeNow,
                        'quick_minutes' => $selisih,
                        'code' => $presensi->code . ', ' . $code,
                        'percent' => $presensi->percent + $percent,
                    ]);
                } else {
                    $a = Carbon::parse($timeNow);
                    $b = Carbon::parse($time->come_time);
                    $percent = null;
                    $code = null;
                    $selisih = null;
                    if ($a->gt($b)) {
                        $selisih = $a->diffInMinutes($b);
                        gmdate('H:i:s', $selisih);
                    }

                    if ($selisih >= 1 && $selisih <= 30) {
                        $percent = 0;
                        $code = 'TL1';
                    } elseif ($selisih >= 31 && $selisih <= 60) {
                        $percent = 0.5;
                        $code = 'TL2';
                    } elseif ($selisih >= 61 && $selisih <= 90) {
                        $percent = 1;
                        $code = 'TL3';
                    } elseif ($selisih > 90) {
                        $percent = 1.25;
                        $code = 'TL4';
                    } else {
                        $percent = null;
                        $code = null;
                    }
                    Presence::create([
                        'user_id' => $userId,
                        'type' => 'WFO',
                        'come_photo' => $foto,
                        'come_presence' => $timeNow,
                        'late_minutes' => $selisih,
                        'code' => $code,
                        'percent' => $percent,
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
