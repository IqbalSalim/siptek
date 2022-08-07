<?php

namespace App\Http\Livewire\Verifikasi;

use App\Models\Presence;
use Livewire\Component;

class ModalVerifikasi extends Component
{
    public $file, $keterangan, $nama, $tanggal;
    public $idVerifikasi;

    protected $listeners = ['getVerifikasi', 'reject'];

    public function getVerifikasi($id)
    {
        $presence = Presence::find($id);
        $this->file = $presence->file;
        $this->keterangan = $presence->description;
        $this->nama = $presence->user->name;
        $this->tanggal = $presence->created_at->isoFormat('dddd, D MMMM Y');
        $this->idVerifikasi = $presence->id;
    }

    public function approve()
    {
        $presence = Presence::find($this->idVerifikasi);
        $presence->update([
            'status' => 'approved',
            'feedback' => null,
        ]);
        $this->dispatchBrowserEvent('close-modal-verifikasi');
        $this->emit('render');
    }

    public function rejected()
    {
        $this->dispatchBrowserEvent('swal:addDescription', [
            'message' => 'Keterangan ditolak',
        ]);
    }

    public function reject($description)
    {
        $presence = Presence::find($this->idVerifikasi);
        $presence->update([
            'status' => 'rejected',
            'feedback' => $description,
        ]);
        $this->dispatchBrowserEvent('close-modal-verifikasi');
        $this->emit('render');
    }

    public function closeForm()
    {
        $this->reset('file', 'idVerifikasi');
        $this->dispatchBrowserEvent('close-modal-verifikasi');
    }
}
