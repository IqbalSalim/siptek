<?php

namespace App\Http\Livewire\Presensi;

use App\Models\Presence;
use App\Models\Time;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class IndexPresensi extends Component
{
    use WithPagination;

    public $userId, $date, $year, $month, $perMonth, $day = 0, $openPresenceWFO, $openPresenceDL;

    protected $listeners = ['render'];



    public function mount()
    {
        $timeNow = Carbon::now()->format('H:i:m');
        $day = Carbon::now()->isoFormat('dddd');
        $time = Time::where('day', 'like', $day)->first();
        if (empty($time)) {
            $this->openPresenceWFO = false;
            $this->openPresenceDL = false;
        } else {
            $comeStartTime = $time->come_start_time;
            $comeEndTime = $time->come_end_time;
            $presenceToDay = Presence::where('user_id', auth()->user()->id)->whereDate('created_at', Carbon::now())->first();
            // dd($presenceToDay);

            if (Carbon::parse($timeNow)->gt($comeStartTime) && Carbon::parse($timeNow)->lt($comeEndTime)) {
                $this->openPresenceWFO = true;
            } else if (Carbon::parse($timeNow)->gt($comeStartTime) && Carbon::parse($timeNow)->gt($comeEndTime) && !empty($presenceToDay)) {
                $this->openPresenceWFO = true;
            } else {
                $this->openPresenceWFO = false;
            }

            if (Carbon::parse($timeNow)->gt('08:00:00') && Carbon::parse($timeNow)->lt('16:00:00')) {
                $this->openPresenceDL = true;
            } else {
                $this->openPresenceDL = false;
            }
        }

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
        $typeToDay = null;
        $file = null;
        if ($presenceToDay) {
            $typeToDay = $presenceToDay->type;
            $file = $presenceToDay->file;
        }

        return view('livewire.presensi.index-presensi', [
            'presences' => Presence::where('user_id', $this->userId)->whereYear('created_at', $this->year)->whereMonth('created_at', $this->month)->latest()->paginate(10),
            'dinasluar' => Presence::where('user_id', $this->userId)->whereYear('created_at', $this->year)->whereMonth('created_at', $this->month)->whereNotNull('status')->latest()->paginate(10),
            'presence' => $presence,
            'come' => $presence ? $presence->come_presence : null,
            'go' => $presence ? $presence->go_presence : null,
            'status' => $presence ? $presence->type : null,
            'typeToDay' => $typeToDay,
            'file' => $file,
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
