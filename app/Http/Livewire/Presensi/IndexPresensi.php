<?php

namespace App\Http\Livewire\Presensi;

use App\Models\Presence;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class IndexPresensi extends Component
{
    use WithPagination;

    public $userId, $date, $year, $month, $perMonth, $day = 0;

    protected $listeners = ['render'];

    public function mount()
    {
        $this->userId = auth()->user()->id;
        $this->year = Carbon::now()->format('Y');
        $this->month = Carbon::now()->format('m');
        $this->perMonth = Carbon::now()->format('Y-m');
    }


    public function render()
    {
        $this->date = Carbon::today()->subDays($this->day);
        $presence = Presence::where('user_id', $this->userId)->whereDate('created_at', $this->date)->first();
        $presenceToDay = Presence::where('user_id', $this->userId)->whereDate('created_at', Carbon::now())->first();
        $comeToDay = null;
        if ($presenceToDay) {
            $comeToDay = $presenceToDay->come_presence;
        }

        return view('livewire.presensi.index-presensi', [
            'presences' => Presence::where('user_id', $this->userId)->whereYear('created_at', $this->year)->whereMonth('created_at', $this->month)->latest()->paginate(10),
            'presence' => $presence,
            'come' => $presence ? $presence->come_presence : null,
            'go' => $presence ? $presence->go_presence : null,
            'status' => $presence ? $presence->type : null,
            'comeToDay' => $comeToDay
        ]);
    }

    public function changePerMonth()
    {
        $this->year = Carbon::createFromFormat('Y-m', $this->perMonth)->format('Y');
        $this->month = Carbon::createFromFormat('Y-m', $this->perMonth)->format('m');
    }

    public function plusDay()
    {
        $this->day++;
    }
    public function minusDay()
    {
        $this->day--;
    }
}
