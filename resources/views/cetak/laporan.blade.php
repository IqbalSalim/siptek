<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <style>
        @page {
            margin: 0px 0px 0px 0px !important;
            padding: 0px 0px 0px 0px !important;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 8px 4px;
        }
    </style>

</head>

<body class="px-8">
    <div>
        <table style="width: 100%; padding: 4px 8px; border: none; padding-left: 20px; padding-right: 20px">
            <tr style="border: none; ">
                <td style="padding: 0px; width: 20%; border: none;">
                    <img style="width: 140px; padding: 0px;" src="{{ asset('images/logo.png') }}" alt="">
                </td>
                <td style="text-align: center; border: none; width: 60%; padding: 0px;">
                    <h1 class="text-sm font-medium">Badan Kependudukan Keluarga Berencana Nasional</h1>
                </td>
                <td style="text-align: right; font-weight: 500; border: none; padding: 0px; width: 20%">
                    {{ $periode }}
                </td>
            </tr>
        </table>

        <div style="padding-left: 20px; padding-right: 20px">
            <table style="border: none;">
                <tr>
                    <td style="border: none;">Nama</td>
                    <td style="border: none;">:</td>
                    <td class="font-medium" style="font-weight: 500; border: none;">{{ $nama }}</td>
                </tr>
                <tr>
                    <td style="border: none;">Kode Anggota</td>
                    <td style="border: none;">:</td>
                    <td style="font-weight: 500; border: none;">{{ $kode }}</td>
                </tr>
            </table>
        </div>

        <div style="padding: 0px 12px; padding-left: 20px; padding-right: 20px">
            @if (count($rekapan) > 0)
                <table style="width: 100%; margin-top: 12px; border: 1px solid black; table-layout: ">
                    <thead style="font-size: 12px; color: gray; text-transform: uppercase">
                        <tr>

                            <th scope="col" style="border: 1px solid black;"
                                class="px-6 py-3 border border-slate-600 ">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3 border border-slate-600">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3 border border-slate-600">
                                Waktu Datang
                            </th>
                            <th scope="col" class="px-6 py-3 border border-slate-600">
                                Waktu Pulang
                            </th>
                            <th scope="col" class="px-6 py-3 border border-slate-600">
                                Terlambat (menit)
                            </th>
                            <th scope="col" class="px-6 py-3 border border-slate-600">
                                Pulang Cepat (menit)
                            </th>
                            <th scope="col" class="px-6 py-3 border border-slate-600">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekapan as $key => $row)
                            <tr style="font-size: 12px; text-align: center;"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td style="border: 1px solid black" class="px-6 py-4 border border-slate-600">
                                    {{ $key }}
                                </td>
                                <td class="px-6 py-4 font-bold border border-slate-600">
                                    {{ $row['tanggal'] }}
                                </td>
                                <td class="px-6 py-4 border border-slate-600">
                                    {{ $row['come_presence'] }}
                                </td>
                                <td class="px-6 py-4 border border-slate-600">
                                    {{ $row['go_presence'] }}
                                </td>
                                <td class="px-6 py-4 border border-slate-600">
                                    {{ $row['late_minutes'] }}
                                </td>
                                <td class="px-6 py-4 border border-slate-600">
                                    {{ $row['quick_minutes'] }}
                                </td>
                                <td class="px-6 py-4 border border-slate-600">
                                    {{ $row['code'] }}
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
        </div>
    </div>



</body>

</html>
