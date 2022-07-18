<?php

namespace App\Http\Livewire\Waktu;

use App\Models\Time;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditWaktu extends Component
{
    public $timeId, $day, $come_start_time, $come_end_time, $go_start_time, $go_end_time;

    protected $listeners = ['getTime'];

    public function getTime($id)
    {
        $time = Time::find($id);
        $this->day = $time->day;
        $this->come_start_time = $time->come_start_time;
        $this->come_end_time = $time->come_end_time;
        $this->go_start_time = $time->go_start_time;
        $this->go_end_time = $time->go_end_time;
        $this->timeId = $id;
    }

    public function closeForm()
    {
        $this->reset('day', 'come_start_time', 'come_end_time', 'go_start_time', 'go_end_time');
        $this->resetValidation();
        $this->dispatchBrowserEvent('close-modal-edit');
    }

    protected $validationAttributes = [
        'day' => 'hari',
        'come_start_time' => 'Mulai waktu datang',
        'come_end_time' => 'Selesai waktu datang',
        'go_start_time' => 'Mulai waktu pulang',
        'go_end_time' => 'Selesai waktu pulang',

    ];

    public function update()
    {
        $validate = $this->validate([
            'come_start_time' => 'required|string',
            'come_end_time' => 'required|string',
            'go_start_time' => 'required|string',
            'go_end_time' => 'required|string',
        ]);


        try {
            // Transaction
            $exception = DB::transaction(function ()  use ($validate) {
                Time::find($this->timeId)->update($validate);
            });

            if (is_null($exception)) {
                $this->closeForm();
                $this->dispatchBrowserEvent('swal:success', [
                    'type' => 'success',
                    'message' => 'Data Berhasil Diubah!',
                    'text' => 'ini telah disimpan di tabel Waktu Presensi.'
                ]);
                $this->emit('render');
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
}
