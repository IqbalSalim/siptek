<?php

namespace App\Http\Livewire\Presensi;

use App\Models\Presence;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class DlPresensi extends Component
{
    use WithFileUploads;

    public $file, $description, $preview, $longlat;

    protected $listeners = ['renderDLP', 'setLonglat'];



    public function setLonglat($long, $lat)
    {
        $array[0] = $lat;
        $array[1] = $long;
        $this->longlat = implode(",", $array);
    }

    public function renderDLP()
    {
        return view('livewire.presensi.dl-presensi');
    }

    public function setMap()
    {
        $this->dispatchBrowserEvent('setMap');
    }


    public function runmap()
    {
        $this->dispatchBrowserEvent('runmaps');
    }

    public function save()
    {
        $this->validate([
            'file' => 'mimes:pdf|max:2048',
            'description' => 'required|string|max:255'
        ]);
        $userId = auth()->user()->id;
        $dateNow = Carbon::today();

        $file = $this->file->store('files', 'public');

        try {
            // Transaction
            $exception = DB::transaction(function ()  use ($userId, $dateNow, $file) {
                $presensi = Presence::where('user_id', $userId)->whereDate('created_at', $dateNow)->first();
                if (!empty($presensi)) {
                    $this->dispatchBrowserEvent('swal:error', [
                        'type' => 'success',
                        'message' => 'Terjadi Kesalahan!',
                        'text' => 'jika sudah melakukan presensi WFO maka tidak bisa presensi DL'
                    ]);
                } else {
                    Presence::create([
                        'user_id' => $userId,
                        'type' => 'DL',
                        'file' => $file,
                        'come_presence' => '00:00:00',
                        'go_presence' => '00:00:00',
                        'description' => $this->description,
                        'status' => 'submission',
                        'longlat' => $this->longlat,
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
            if (Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
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
        $this->reset('file', 'description');
        $this->resetValidation();
        $this->dispatchBrowserEvent('close-modal-dl');
    }
}
