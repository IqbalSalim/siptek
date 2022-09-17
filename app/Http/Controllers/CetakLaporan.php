<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CetakLaporan extends Controller
{
    public function generatePDF(Request $request)
    {
        $tanggal = $request->tanggal;
        $rekapan = [];


        if ($tanggal) {
            $year = Carbon::createFromFormat('Y-m', $tanggal)->format('Y');
            $month = Carbon::createFromFormat('Y-m', $tanggal)->format('m');
            $presensi = Presence::where('user_id', Auth::user()->id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get()->toArray();
            if (count($presensi) > 0) {
                $array = [];
                $this->countDays = Carbon::parse($tanggal)->daysInMonth;


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
                $rekapan = $temp;
            } else {
                $rekapan = [];
            }
        }

        $periode = Carbon::parse($tanggal)->format('M Y');
        $user = User::find(Auth::user()->id);


        $data = [
            'rekapan' => $rekapan,
            'periode' => $periode,
            'kode' => $user->employee->member_id,
            'nama' => $user->name,
        ];

        $pdf = Pdf::loadView('cetak.laporan', $data)->setPaper('A4', 'potrait');
        return $pdf->stream('laporanpresensi.pdf');
    }
}
