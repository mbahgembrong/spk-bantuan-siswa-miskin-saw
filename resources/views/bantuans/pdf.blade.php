<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penilaian Bantuan {{ ucfirst($bantuan->nama) }}</title>
    <style type="text/css">
        table {
            border-spacing: 0;
            margin: 2px;
        }

        th {
            padding: 5px;
        }

        td {
            padding: 5px;
            height: 10px;
            /* border: 1px black solid; */
            padding: 5px;
        }

        table tr td,
        table tr th {
            font-size: 12px;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }


        body {
            margin: 4vh;
            font-size: 12px;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        h1 h2 h3 h4 h5 {
            margin: auto;
            display: inline-block;
            /* line-height: 1.2; */
        }

        label {
            padding: 0;
        }

        .spa {
            letter-spacing: 3px;
        }

        hr.style2 {}


        .rotate {
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            width: 1.5em;
        }

        .rotate div {
            -moz-transform: rotate(90.0deg);
            /* FF3.5+ */
            -o-transform: rotate(90.0deg);
            /* Opera 10.5 */
            -webkit-transform: rotate(90.0deg);
            /* Saf3.1+, Chrome */
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);
            /* IE6,IE7 */
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)";
            /* IE8 */
            margin-left: -10em;
            margin-right: -10em;
            /* text-orientation: upright; */
        }

        table#tableKop,
        table#tableKop>tr>th,
        table#tableKop>tr>td {
            /* background-color: red; */
            border: 0px black solid;
            border-collapse: collapse;
            /* padding: 0; */
            margin-bottom: 0;
            padding-bottom: 0;
            /* margin: 0; */
        }

        table#tableKop {
            border-bottom: 3px double #8c8b8b;
        }

        table#tableBiasa,
        tr,
        th {
            border: 1px black solid;
            border-collapse: collapse;
            margin-top: 0px;
            height: 30px;
        }

        table#tableBiasa tr td {
            border: 1px black solid;
            border-collapse: collapse;
            margin-top: 0px;
        }

        div#judul,
        h2,
        p {
            padding: 0;
            margin: 0;
        }

        div#judul2,
        h4 {
            display: inline-block;
            padding: 0;
            margin: 0;
        }

        .babeng-min-row {
            width: 1%;
            white-space: nowrap;
        }
    </style>
</head>

<body onLoad="window.print()">
    <table width="100%" id="tableKop">
        <tr>
            <td width="13%" align="right" style="padding-bottom:15px"><img src="{{ asset('img/logo.png') }}"
                    width="100" height="100"></td>
            <td width="80%" align="center">
                <p><b>
                        <h1>SD NEGERI NGLETIH 1</h1>
                        <h3>Jl. Waringin, Ngletih, Kec. Pesantren, Kota Kediri, Jawa Timur 64137</h3>
                        </br><br>
                        {{-- <font size="12px">Sekretariat Letjen Sutoyo V. 48 Tlp. (0341) 414636 Malang - Jawa Timur <br> email: ypmt.28mlg@gmail.com / AHU-0004889.AH.01.12.Tahun 2020</font> --}}
                    </b></p>
            </td>
        </tr>
    </table>
    <div style="margin-bottom: 0;text-align:center;margin-top:16px" id="judul">
        <h2>Laporan Penilaian Bantuan {{ ucfirst($bantuan->nama) }}</h2>
        <p for=""></p>
    </div>
    <br>

    <table>
        <tr>
            <td align="left">
                <b>Jumlah Bantuan</b>
            </td>
            <td align="center">
                <b> : </b>
            </td>
            <td align="left">
                <b>Rp. {{ $bantuan->jumlah }}</b>
            </td>
        </tr>
        <tr>
            <td align="left">
                <b>Kuota</b>
            </td>
            <td align="center">
                <b> : </b>
            </td>
            <td align="left">
                <b>{{ $bantuan->kuota }} PAX</b>
            </td>
        </tr>
    </table>
    <br>
    <div id="judul2">
        <h3>Daftar Penerima Beasiswa</h3>
    </div>



    <br>
    <table width="100%" id="tableBiasa">
        <tr>
            <th>
                No
            </th>
            <th>
                Nama siswa
            </th>
            <th>
                NISN
            </th>
            <th>
                Jenis Kelamin
            </th>
            <th>
                Tanggal Lahir
            </th>
            <th>
                Bobot
            </th>
        </tr>
        @forelse ($bantuan->siswaBantuan()->orderBy('bobot','ASC')->get() as $key=>$siswa)
            <tr>
                <td class="babeng-min-row">{{ $key + 1 }}</td>
                <td>{{ $siswa->siswa->nama }}</td>
                <td>{{ $siswa->siswa->nisn ?? '-' }}</td>
                <td>{{ $siswa->siswa->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-Laki' }}</td>
                <td>{{ Carbon::parse($siswa->siswa->tanggal_lahir)->format('d/m/Y') }}</td>
                <td>{{ $siswa->bobot }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" align="center"> Data tidak ditemukan</td>
            </tr>
        @endforelse
    </table>

</body>

</html>
