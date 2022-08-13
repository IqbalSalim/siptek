<?php

namespace App\Http\Livewire\Rekapan;

use App\Models\Presence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Rekap extends Component
{
    public $perMonth, $rekapan = [];

    public function render()
    {
        return view('livewire.rekapan.rekap');
    }

    public function filter()
    {
        if ($this->perMonth) {
            $year = Carbon::createFromFormat('Y-m', $this->perMonth)->format('Y');
            $month = Carbon::createFromFormat('Y-m', $this->perMonth)->format('m');
            $presensi = Presence::where('user_id', Auth::user()->id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get()->toArray();
            if (count($presensi) > 0) {
                $array = [];
                $this->countDays = Carbon::parse($this->perMonth)->daysInMonth;


                foreach ($presensi as $row) {
                    $a = Carbon::parse($row['created_at'])->format('Y-m-d');
                    $b = (int) Carbon::parse($row['created_at'])->format('d');
                    $c = Carbon::now();
                    if ($c->gt($row['created_at'])) {

                        if ($row['type'] == 'DL') {
                            $tanggal = Carbon::parse($row['created_at']);
                            $array[$b]['tanggal'] = $tanggal->format('d M Y');
                            $array[$b]['code'] = $row['type'];
                            $array[$b]['come_presence'] = $row['come_presence'] ? $row['come_presence'] : null;
                            $array[$b]['go_presence'] = $row['go_presence'] ? $row['go_presence'] : null;
                            $array[$b]['late_minutes'] = null;
                            $array[$b]['quick_minutes'] = null;
                        } else {
                            $tanggal = Carbon::parse($row['created_at']);
                            $array[$b]['tanggal'] = $tanggal->format('d M Y');
                            $array[$b]['code'] = $row['code'];
                            $array[$b]['come_presence'] = $row['come_presence'] ? $row['come_presence'] : null;
                            $array[$b]['go_presence'] = $row['go_presence'] ? $row['go_presence'] : null;
                            $array[$b]['late_minutes'] = $row['late_minutes'] ? $row['late_minutes'] : null;
                            $array[$b]['quick_minutes'] = $row['quick_minutes'] ? $row['quick_minutes'] : null;
                        }
                    }
                }






                for ($j = 1; $j <= $this->countDays; $j++) {
                    if (!isset($array[$j])) {
                        $b = Carbon::createFromDate($year, $month, $j);
                        $c = Carbon::now();

                        if ($c->gt($b)) {
                            if ($b->isSaturday() || $b->isSunday()) {

                                $array[$j]['tanggal'] = $b->format('d M Y');
                                $array[$j]['code'] = 'LJ';
                                $array[$j]['come_presence'] = null;
                                $array[$j]['go_presence'] = null;
                                $array[$j]['late_minutes'] = null;
                                $array[$j]['quick_minutes'] = null;
                            } else {
                                $array[$j]['tanggal'] = $b->format('d M Y');
                                $array[$j]['code'] = 'TK';
                                $array[$j]['come_presence'] = null;
                                $array[$j]['go_presence'] = null;
                                $array[$j]['late_minutes'] = null;
                                $array[$j]['quick_minutes'] = null;
                            }
                        }
                    }
                }



                for ($j = 1; $j <= $this->countDays; $j++) {
                    if (isset($array[$j])) {
                        $temp[$j] = $array[$j];
                    }
                }
                $this->rekapan = $temp;
            } else {
                $this->rekapan = [];
            }
        }
    }
}
