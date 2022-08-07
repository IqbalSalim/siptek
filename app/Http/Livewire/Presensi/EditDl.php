<?php

namespace App\Http\Livewire\Presensi;

use App\Models\Presence;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditDl extends Component
{
    use WithFileUploads;

    public $file, $filePreview, $description, $idPresence, $date, $feedback;

    protected $listeners = ['getPresenceDl'];

    public function getPresenceDl($id)
    {
        $presensi = Presence::find($id);
        $this->filePreview = $presensi->file;
        $this->description = $presensi->description;
        $this->feedback = $presensi->feedback;
        $this->date = $presensi->created_at;
        $this->idPresence = $presensi->id;
    }

    public function update()
    {
        $this->validate([
            'file' => 'required|file',
            'description' => 'required|string|max:255'
        ]);


        $file = $this->file->store('files', 'public');

        try {
            // Transaction
            $exception = DB::transaction(function ()  use ($file) {
                $presensi = Presence::find($this->idPresence);
                if (empty($presensi)) {
                    dd('oke');
                    $this->dispatchBrowserEvent('swal:error', [
                        'type' => 'success',
                        'message' => 'Terjadi Kesalahan!',
                        'text' => 'presensi DL tidak ditemukan'
                    ]);
                } else {
                    $presensi->update([
                        'file' => $file,
                        'description' => $this->description,
                        'status' => 'submission',
                    ]);
                }
            });

            if (is_null($exception)) {
                if (Storage::disk('public')->exists($this->filePreview)) {
                    Storage::disk('public')->delete($this->filePreview);
                }
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
        $this->dispatchBrowserEvent('close-modal-editdl');
    }
}
