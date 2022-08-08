<?php

namespace App\Http\Livewire\Rekapan;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class RekapanKeseluruhan extends Component
{
    public $perMonth, $rekapan = [], $countDays;

    public function render()
    {
        return view('livewire.rekapan.rekapan-keseluruhan');
    }

    public function filter()
    {
        if ($this->perMonth) {
            $year = Carbon::createFromFormat('Y-m', $this->perMonth)->format('Y');
            $month = Carbon::createFromFormat('Y-m', $this->perMonth)->format('m');

            $presensi = User::with(['presences' => function ($query) use ($year, $month) {
                $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
            }])->whereRelation('roles', 'name', 'not like', 'admin')->get()->toArray();

            if (count($presensi) > 0) {
                $array = [];
                $this->countDays = Carbon::parse($this->perMonth)->daysInMonth;

                for ($i = 0; $i < count($presensi); $i++) {
                    if (count($presensi[$i]['presences'])) {
                        $array[$i]['nama'] = $presensi[$i]['name'];
                        for ($j = 1; $j <= $this->countDays; $j++) {
                            foreach ($presensi[$i]['presences'] as $row) {
                                $a = Carbon::parse($row['created_at'])->format('Y-m-d');
                                // $temp = date_create($this->perMonth . '-' . $j);
                                // $b = Carbon::parse($temp)->format('Y-m-d');
                                $b = Carbon::createFromDate($year, $month, $j);
                                if ($b->isSaturday() || $b->isSunday()) {
                                    $array[$i]['pertanggal'][$j]['code'] = 'LJ';
                                    $array[$i]['pertanggal'][$j]['come_presence'] = null;
                                    $array[$i]['pertanggal'][$j]['go_presence'] = null;
                                    $array[$i]['pertanggal'][$j]['late_minutes'] = null;
                                    $array[$i]['pertanggal'][$j]['quick_minutes'] = null;
                                } elseif ($b->format('Y-m-d') == $a) {
                                    if ($row['type'] == 'DL') {
                                        $array[$i]['pertanggal'][$j]['code'] = $row['type'];
                                        $array[$i]['pertanggal'][$j]['come_presence'] = $row['come_presence'] ? $row['come_presence'] : null;
                                        $array[$i]['pertanggal'][$j]['go_presence'] = $row['go_presence'] ? $row['go_presence'] : null;
                                    } else {



                                        $array[$i]['pertanggal'][$j]['code'] = null;
                                        $array[$i]['pertanggal'][$j]['come_presence'] = $row['come_presence'] ? $row['come_presence'] : null;
                                        $array[$i]['pertanggal'][$j]['go_presence'] = $row['go_presence'] ? $row['go_presence'] : null;
                                        $array[$i]['pertanggal'][$j]['late_minutes'] = $row['late_minutes'] ? $row['late_minutes'] : null;
                                        $array[$i]['pertanggal'][$j]['quick_minutes'] = $row['quick_minutes'] ? $row['quick_minutes'] : null;

                                        $code = $row['code']  ? explode(",", $row['code']) : null;
                                        if ($code) {
                                            foreach ($code as $r) {
                                                if (substr($r, 0, 1) == 'T') {
                                                    $array[$i]['pertanggal'][$j]['come_code'] = $r;
                                                } else {
                                                    $array[$i]['pertanggal'][$j]['go_code'] = $r;
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    $array[$i]['pertanggal'][$j]['code'] = 'TK';
                                    $array[$i]['pertanggal'][$j]['come_presence'] = null;
                                    $array[$i]['pertanggal'][$j]['go_presence'] = null;
                                    $array[$i]['pertanggal'][$j]['late_minutes'] = null;
                                    $array[$i]['pertanggal'][$j]['quick_minutes'] = null;
                                }
                            }
                        }
                    }
                }


                $this->rekapan = $array;
            } else {
                $this->rekapan = [];
            }
        }
    }
}
