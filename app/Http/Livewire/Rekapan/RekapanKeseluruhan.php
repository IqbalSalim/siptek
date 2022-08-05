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
                                // dd($row['come_presence']);
                                if ($b->isSaturday() || $b->isSunday()) {
                                    $array[$i]['pertanggal'][$j]['code'] = 'LJ';
                                    $array[$i]['pertanggal'][$j]['come_presence'] = null;
                                    $array[$i]['pertanggal'][$j]['go_presence'] = null;
                                    $array[$i]['pertanggal'][$j]['percent'] = null;
                                } elseif ($b->format('Y-m-d') == $a) {
                                    $array[$i]['pertanggal'][$j]['code'] = $row['code'] ? $row['code'] : null;
                                    $array[$i]['pertanggal'][$j]['come_presence'] = $row['come_presence'] ? $row['come_presence'] : null;
                                    $array[$i]['pertanggal'][$j]['go_presence'] = $row['go_presence'] ? $row['go_presence'] : null;
                                    $array[$i]['pertanggal'][$j]['percent'] = $row['percent'] ? $row['percent'] : null;
                                } else {
                                    $array[$i]['pertanggal'][$j]['code'] = 'TK';
                                    $array[$i]['pertanggal'][$j]['come_presence'] = null;
                                    $array[$i]['pertanggal'][$j]['go_presence'] = null;
                                    $array[$i]['pertanggal'][$j]['percent'] = 3;
                                }
                            }
                        }
                    }
                }

                // dd($array[0]['pertanggal'][3]['come_presence']);
                $this->rekapan = $array;
                // dd($array);
            } else {
                $this->rekapan = [];
            }
        }
    }
}
