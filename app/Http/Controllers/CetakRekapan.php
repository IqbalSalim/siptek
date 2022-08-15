<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class CetakRekapan implements FromView
{
    protected $perMonth;

    function __construct($perMonth)
    {
        $this->perMonth = $perMonth;
    }


    public function view(): View
    {

        $rekapan = [];
        $countDays = null;
        if ($this->perMonth) {
            $year = Carbon::createFromFormat('Y-m', $this->perMonth)->format('Y');
            $month = Carbon::createFromFormat('Y-m', $this->perMonth)->format('m');

            $presensi = User::with(['presences' => function ($query) use ($year, $month) {
                $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
            }])->whereRelation('roles', 'name', 'not like', 'admin')->get()->toArray();

            if (count($presensi) > 0) {
                $array = [];
                $countDays = Carbon::parse($this->perMonth)->daysInMonth;

                for ($i = 0; $i < count($presensi); $i++) {
                    $array[$i]['nama'] = $presensi[$i]['name'];
                    if (count($presensi[$i]['presences'])) {
                        foreach ($presensi[$i]['presences'] as $row) {
                            $a = Carbon::parse($row['created_at'])->format('Y-m-d');
                            $b = (int) Carbon::parse($row['created_at'])->format('d');

                            if ($row['type'] == 'DL') {
                                $array[$i]['pertanggal'][$b]['code'] = 'DL';
                                $array[$i]['pertanggal'][$b]['come_presence'] = $row['come_presence'] ? $row['come_presence'] : null;
                                $array[$i]['pertanggal'][$b]['go_presence'] = $row['go_presence'] ? $row['go_presence'] : null;
                                $array[$i]['pertanggal'][$b]['late_minutes'] = null;
                                $array[$i]['pertanggal'][$b]['quick_minutes'] = null;
                                // dd('oke');
                            } else {
                                $array[$i]['pertanggal'][$b]['code'] = null;
                                $array[$i]['pertanggal'][$b]['come_presence'] = $row['come_presence'] ? $row['come_presence'] : null;
                                $array[$i]['pertanggal'][$b]['go_presence'] = $row['go_presence'] ? $row['go_presence'] : null;
                                $array[$i]['pertanggal'][$b]['late_minutes'] = $row['late_minutes'] ? $row['late_minutes'] : null;
                                $array[$i]['pertanggal'][$b]['quick_minutes'] = $row['quick_minutes'] ? $row['quick_minutes'] : null;

                                $code = $row['code']  ? explode(",", $row['code']) : null;
                                if ($code) {
                                    foreach ($code as $r) {
                                        if (substr($r, 0, 1) == 'T') {
                                            $array[$i]['pertanggal'][$b]['come_code'] = $r;
                                        } else {
                                            $array[$i]['pertanggal'][$b]['go_code'] = $r;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                for ($i = 0; $i < count($presensi); $i++) {
                    for ($j = 1; $j <= $countDays; $j++) {
                        if (!isset($array[$i]['pertanggal'][$j])) {
                            $b = Carbon::createFromDate($year, $month, $j);
                            if ($b->isSaturday() || $b->isSunday()) {
                                $array[$i]['pertanggal'][$j]['code'] = 'LJ';
                                $array[$i]['pertanggal'][$j]['come_presence'] = null;
                                $array[$i]['pertanggal'][$j]['go_presence'] = null;
                                $array[$i]['pertanggal'][$j]['late_minutes'] = null;
                                $array[$i]['pertanggal'][$j]['quick_minutes'] = null;
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

                for ($i = 0; $i < count($presensi); $i++) {
                    for ($j = 1; $j <= $countDays; $j++) {
                        $temp[$j] = $array[$i]['pertanggal'][$j];
                    }
                    $array[$i]['pertanggal'] = $temp;
                }
                $rekapan = $array;
            } else {
                $rekapan = [];
            }
        }

        $periode = Carbon::parse($this->perMonth)->format('M Y');

        return view('cetak.rekapan', [
            'rekapan' => $rekapan,
            'countDays' => $countDays,
            'periode' => $periode,
        ]);
    }
}
