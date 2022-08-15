@if (count($rekapan) > 0)
    <table style="width: 100%; padding: 4px 8px; border: none; padding-left: 20px; padding-right: 20px">
        <tr style="border: none; ">
            <td colspan="6" style="text-align: center; border: none; width: 60%; padding: 0px;">
                <h1 class="text-sm font-medium">Badan Kependudukan Keluarga Berencana Nasional</h1>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <div style="padding-left: 20px; padding-right: 20px">
        <table style="border: none;">
            <tr>
                <td style="border: none;">Periode</td>
                <td style="border: none;">:</td>
                <td class="font-medium" style="font-weight: 500; border: none;">{{ $periode }}</td>
            </tr>
        </table>
    </div>
    <table style="border: 1px solid black"
        class="w-full text-sm text-left text-gray-500 border border-collapse table-auto border-slate-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th style="border: 1px solid black" scope="col" class="px-6 py-3 border border-slate-600">
                    Nama
                </th>
                @for ($i = 1; $i <= $countDays; $i++)
                    <th style="border: 1px solid black" scope="col"
                        class="px-6 py-3 font-bold border border-slate-600">
                        {{ $i }}
                    </th>
                @endfor
                <th style="border: 1px solid black" scope="col" class="px-6 py-3 border border-slate-600">
                    Total
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekapan as $row)
                @php
                    $totalTerlambat = 0;
                    $totalCepat = 0;
                @endphp
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td style="border: 1px solid black" class="px-6 py-4 font-bold border border-slate-600">
                        {{ $row['nama'] }}
                    </td>
                    @if (count($rekapan) > 0)
                        @for ($i = 1; $i <= $countDays; $i++)
                            <td style="border: 1px solid black" class="px-6 py-4 border border-slate-600">
                                {{ $row['pertanggal'][$i]['code'] }}
                                {{ $row['pertanggal'][$i]['come_presence'] ? 'Jam Masuk: ' . \Carbon\Carbon::createFromFormat('H:i:s', $row['pertanggal'][$i]['come_presence'])->format('H:i') : null }}
                                {{ $row['pertanggal'][$i]['go_presence'] ? 'Jam Pulang: ' . \Carbon\Carbon::createFromFormat('H:i:s', $row['pertanggal'][$i]['go_presence'])->format('H:i') : null }}
                                <br>
                                {{ $row['pertanggal'][$i]['late_minutes'] ? 'Terlambat :' . $row['pertanggal'][$i]['late_minutes'] . ' (' . $row['pertanggal'][$i]['come_code'] . ')' : null }}
                                <br>
                                {{ $row['pertanggal'][$i]['quick_minutes'] ? 'Cepat Pulang :' . $row['pertanggal'][$i]['quick_minutes'] . ' (' . $row['pertanggal'][$i]['go_code'] . ')' : null }}
                            </td>
                            @php
                                $totalTerlambat = $row['pertanggal'][$i]['late_minutes'] ? $totalTerlambat + $row['pertanggal'][$i]['late_minutes'] : $totalTerlambat;
                                $totalCepat = $row['pertanggal'][$i]['quick_minutes'] ? $totalCepat + $row['pertanggal'][$i]['quick_minutes'] : $totalCepat;
                            @endphp
                        @endfor
                    @endif
                    <td style="border: 1px solid black" class="px-6 py-4 border border-slate-600">
                        <p> {{ $totalTerlambat }}</p>
                        <p> {{ $totalCepat }}</p>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@else
    <p class="px-4 py-2 mt-2 text-2xl font-bold text-center text-red-500 animate-pulse">
        Data tidak ditemukan!
    </p>
@endif
