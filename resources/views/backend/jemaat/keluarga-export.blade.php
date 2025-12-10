<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Keluarga</title>
    <style>
        @page {
            margin: 30px 20px;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            color: #2c3e50;
            font-size: 18px;
        }

        .header p {
            margin: 3px 0;
            font-size: 13px;
            color: #777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background: #f0f3f5;
            color: #2c3e50;
            font-weight: bold;
            text-align: center;
            padding: 8px;
            border: 1px solid #ddd;
        }

        td {
            border: 1px solid #ddd;
            padding: 6px 8px;
            vertical-align: top;
        }


        .footer {
            text-align: right;
            font-size: 10px;
            color: #777;
            margin-top: 20px;
        }

        .double-line {
                border-bottom: 6px double #000;
                width: 100%;
                margin-bottom: 20px;
            }

    </style>
</head>
<body>
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
        <td style="border:none;" width="180px"></td>

    </tr>
</table>
<div class="double-line"></div>


    <div class="header">
        <h2>Daftar Keanggotaan Jemaat</h2>
        <p>{{$identitas?->nama_website??'Nama Gereja'}}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="2%">No</th>
                <th width="10%">Nama</th>
                <th width="2%">L/P</th>
                <th width="8%">Hubungan Keluarga</th>
                <th width="13%">Tempat/Tanggal Lahir</th>
                <th width="5%">Status Baptis</th>
                <th width="15%">Alamat</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($keluargas as $keluarga)

                <tr class="keluarga-row">
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        1. {{$keluarga->jemaatKeluarga->nama}}<br>
                        @foreach ($keluarga->anggota as $anggota)
                            {{$loop->iteration + 1}}. {{$anggota->jemaat->nama }}<br>
                        @endforeach
                    </td>
                    <td>
                        {{$keluarga->jemaatKeluarga->jenis_kelamin === 'Laki-laki' ? 'L' : 'P'}}<br>
                        @foreach ($keluarga->anggota as $anggota)
                            {{ $anggota->jemaat->jenis_kelamin === 'Laki-laki' ? 'L' : 'P'}}<br>
                        @endforeach
                    </td>
                    <td>
                        Kepala Keluarga<br>
                        @foreach ($keluarga->anggota as $anggota)
                            {{ $anggota->hubungan }}<br>
                        @endforeach
                    </td>
                    <td>
                         {{$keluarga->jemaatKeluarga->tempat_lahir.', '.\Carbon\Carbon::parse($anggota->jemaat->tanggal_lahir)->format('d M Y')}}<br>
                        @foreach ($keluarga->anggota as $anggota)
                            {{ $anggota->jemaat->tempat_lahir.', '.\Carbon\Carbon::parse($anggota->jemaat->tanggal_lahir)->format('d M Y')}}<br>
                        @endforeach
                    </td>
                    <td style="text-align: center">
                        {{$keluarga->jemaatKeluarga->status_baptis}}<br>
                        @foreach ($keluarga->anggota as $anggota)
                            {{ $anggota->jemaat->status_baptis }}<br>
                        @endforeach
                    </td>
                    <td style="text-align: center">{{ $keluarga->jemaatKeluarga->alamat }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y') }}
    </div>
</body>
</html>
