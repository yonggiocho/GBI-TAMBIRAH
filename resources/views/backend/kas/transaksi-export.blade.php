<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan GBI - {{ $namaBulan[$bulan->bulan] }} {{$bulan->kasTahun->tahun}}</title>
    <style>
        body {
            font-family: "DejaVu Sans", Arial, sans-serif;
            font-size: 12px;
            color: #222;

        }

        h2, h3 {
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h2 {
            font-size: 16px;
            font-weight: bold;
        }

        h3 {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .periode {
            text-align: center;
            font-size: 12px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th, td {
            border: 1px solid #444;
            padding: 6px 8px;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        td {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .summary td {
            background-color: #fafafa;
            font-weight: bold;
            border: none;
        }

        .footer {
            margin-top: 15px;
            font-style: italic;
            text-align: center;
            font-weight: bold;
        }

        .no-border td {
            border: none !important;
        }

            .double-line {
                border-bottom: 6px double #000;
                width: 100%;
                margin-bottom: 20px;
            }


    </style>
</head>
<body>
    @php
        $no = 1;
        $no_ = 1;
        $tanggal_awal = $transaksi->min('tanggal');
        $tanggal_akhir = $transaksi->max('tanggal');
    @endphp

    <table  style="border: none; margin-bottom: 10px;">
    <tr>
        <!-- Kolom logo -->
        <td style="vertical-align: middle; text-align: center; border: none;">
            <img src="{{ public_path('assets/frontend/img/logo.png') }}" alt="Logo GBI" style="width: 100px; height: auto;">
        </td>

        <!-- Kolom teks -->
        <td style="vertical-align: middle; text-align: center; border: none;">
            <h1 style="margin: 0; font-size: 22px; font-weight: bold;">GEREJA BETHEL INDONESIA</h1>
            <h2 style="margin: 0; font-size: 18px; font-weight: bold;">JEMAAT TUMBANG TAMBIRAH</h2>

            <p style="margin: 5px 0 0 0; font-size: 9px; line-height: 1;">
                Badan Hukum Gereja: SK Dirjen Bimas Kristen / Protestan Departemen Agama R.I.<br>
                No. 41 tahun 1972 dan SK. Dirjen Bimas (Kristen) Protestan Departemen Agama R.I.<br>
                No. 211 tahun 1989 tgl. 25 November 1989
            </p>


        </td>
        <td style="border:none;" width="100px"></td>

    </tr>
</table>
<div class="double-line">
</div>




    <h2>LAPORAN KEUANGAN</h2>
    <div class="periode">{{\Carbon\Carbon::parse($tanggal_awal)->format('d')}} {{ $namaBulan[$bulan->bulan] }} s.d {{\Carbon\Carbon::parse($tanggal_akhir)->format('d')}} {{ $namaBulan[$bulan->bulan] }} {{$bulan->kasTahun->tahun}}</div>

    <table>
        <thead>
            <tr>
                <th >No</th>
                <th >Tanggal</th>
                <th>Keterangan</th>
                <th>Pemasukan</th>
                <th >Pengeluaran</th>
            </tr>
        </thead>
        <tbody>



                <tr>
                    <td class="text-center" >1</td>
                    <td>
                        @foreach($transaksi as $t)
                                @if($t->jenis === 'pemasukan')
                                    {{$no++}}. {{\Carbon\Carbon::parse($t->tanggal)->format('d-m-Y')}}<br>
                                @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($transaksi as $t)
                            @if($t->jenis === 'pemasukan')
                                {{$t->keterangan}}<br>
                            @endif
                        @endforeach
                    </td>
                    <td class="text-right">
                        @foreach($transaksi as $t)
                            @if($t->jenis === 'pemasukan')
                            Rp. {{ number_format($t->jumlah, 0, ',', '.') }}<br>
                            @endif
                        @endforeach
                    </td>
                    <td></td>
                </tr>



            <tr>
                <td class="bold text-right" colspan="3">Jumlah Pemasukan</td>
                <td class="text-right bold">Rp. {{ number_format($pemasukan, 0, ',', '.') }}</td>
                <td></td>
            </tr>



                    <tr>
                        <td class="text-center">2</td>
                        <td>
                            @foreach($transaksi as $t)
                                @if($t->jenis === 'pengeluaran')
                                    {{$no_++}}. {{\Carbon\Carbon::parse($t->tanggal)->format('d-m-Y')}}
                                 @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($transaksi as $t)
                                @if($t->jenis === 'pengeluaran')
                                    {{$t->keterangan}}</td>
                                @endif
                            @endforeach
                        <td></td>
                        <td class="text-right">
                            @foreach($transaksi as $t)
                                @if($t->jenis === 'pengeluaran')
                                 Rp. {{ number_format($t->jumlah, 0, ',', '.') }}
                                @endif
                            @endforeach
                        </td>
                    </tr>




            <tr>

                <td class="bold text-right" colspan="3">Jumlah Pengeluaran</td>
                <td></td>
                <td class="text-right bold">Rp. {{ number_format($pengeluaran, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <table class="summary">
        <tr>
            <td>Pemasukan Bulan {{ $namaBulan[$bulan->bulan] }} {{$bulan->kasTahun->tahun}}</td>
            <td class="text-right">Rp. {{ number_format($pemasukan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Pengeluaran Bulan {{$namaBulan[$bulan->bulan]}} {{$bulan->kasTahun->tahun}}</td>
            <td class="text-right">Rp. {{ number_format($pengeluaran, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Saldo Bulan Sebelumnya pada tahun {{$bulan->kasTahun->tahun}}</td>
            <td class="text-right">Rp. {{ number_format($saldo_awal, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Saldo Awal + Pemasukan – Pengeluaran {{$namaBulan[$bulan->bulan]}} {{$bulan->kasTahun->tahun}}</td>
            <td class="text-right">Rp. {{ number_format($saldo_awal, 0, ',', '.') }} + {{ number_format($pemasukan, 0, ',', '.') }} - {{ number_format($pengeluaran, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Saldo Bulan {{ $namaBulan[$bulan->bulan] }} {{$bulan->kasTahun->tahun}}</td>
            <td class="text-right bold">Rp. {{ number_format($saldo, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="footer">
        Total Saldo Kas per {{$namaBulan[$bulan->bulan]}} {{$bulan->kasTahun->tahun}} adalah <u>Rp. {{ number_format($saldo, 0, ',', '.') }}</u>
    </div>
</body>
</html>