<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Detail Jalan Tanah/Kerikil</title>
</head>

<body>
    <header>
        <div style="position: absolute; top: 10px; left: 10px"><img src="{{ asset('assets/images/logo.png') }}"
                style="width:35px" alt=""></div>
        <div style="position: absolute; top: 10px; left: 50px"><img src="{{ asset('assets/images/pupr.png') }}"
                style="width:43px"></div>
        <div style="font-size: 13px;position: absolute; top: 10px; left: 98px;font-weight: bold">
            <span>PEMERINTAH DAERAH PROVINSI SULAWESI TENGAH</span>
            <br>
            <span>DINAS BINA MARGA DAN PENATAAN RUANG</span>
            <br>
            <span>BIDANG BINA TEKNIK</span>
        </div>
        <div style="position: absolute; top: 30px; right: 120px; font-size: 10px;font-weight: bold">Lembar:
            <span style="height: 10px;width: 20px;border: 1px solid black;fzont-size: 10px;padding: 2px 10px">
            </span>
        </div>
        <div style="position: absolute; top: 30px; right: 10px; font-size: 10px;font-weight: bold">Dari:
            <span style="height: 10px;width: 20px;border: 1px solid black;fzont-size: 10px;padding: 2px 10px">
            </span>
        </div>
        <h3 style="text-align: center;margin-top: 80px">FORMULIR SURVEI KONDISI JALAN TANAH/KERIKIL PER-100 METER</h3>
    </header>
    <main>
        <div style="position: absolute; top: 120px; left: 10px;font-weight: bold;">
            <div style="font-size: 13px">
                <table class="titikkoma" align="left" cellpadding='1' width=50">
                    <tr>
                        <td>Nomor Provinsi</td>
                        <td>:
                            <span>
                                {{ $data->noProvinsi }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Nama Provinsi</td>
                        <td>:
                            <span>
                                {{ $data->namaProvinsi }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Kabupaten/Kota</td>
                        <td>:
                            <span>
                                {{ $data->kabupaten }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Dari Patok Km</td>
                        <td>:
                            <span>
                                {{ $data->dariPatok }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Ke Patok Km</td>
                        <td>:
                            <span>
                                {{ $data->kePatok }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="position: absolute; top: 120px; left: 350px;font-weight: bold;">
            <div style="font-size: 13px">
                <table class="titikkoma" align="left" cellpadding='1' width=50">
                    <tr>
                        <td>Nomor Ruas</td>
                        <td>:
                            <span>
                                {{ $data->noRuas }}
                            </span>
                        </td>

                    </tr>
                    <tr>
                        <td>Nama Ruas</td>
                        <td>:
                            <span>
                                {{ $data->namaRuas }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Status/Fungsi</td>
                        <td>:
                            <span>
                                {{ $data->fungsi }}
                            </span>
                        </td>

                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:
                            <span>
                                {{ \Carbon\Carbon::parse($data->date)->format('d/m/Y') }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Surveyor</td>
                        <td>:
                            <ul
                                style="list-style: none; position: absolute; top: 68px; left: 54px;font-weight: bold;width: 50px">
                                @php
                                    $selectedSurveyors = explode(',', $data->surveyor);
                                @endphp

                                @foreach ($users as $user)
                                    @if (in_array($user->id, $selectedSurveyors))
                                        <li>{{ $loop->iteration }}. {{ $user->name }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="position: absolute; top: 240px; left: 0px; width: 170px; border: 1.5px solid black; height: 420px">
            <div style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                <h4 style="font-size: 10px">Permukaan Perkerasan</h4>
                <div
                    style="position: absolute; top: 30px; left: 5px; width: 157px; border: 1.5px solid black; height: 120px">
                    <div
                        style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                        <h4 style="font-size: 10px">Kemiringan Melintang</h4>
                    </div>
                    <div style="margin-left: 15px;font-size: 10px">
                        <table class="titikkoma" align="left" cellpadding='1' width=50">
                            <tr>
                                <td>
                                    @if ($data->kemiringan == 1)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 1. > 5%
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->kemiringan == 2)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 2. 3 - 5%
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->kemiringan == 3)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 3. Rata
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->kemiringan == 4)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 4. Cekung
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div
                    style="position: absolute; top: 160px; left: 5px; width: 157px; border: 1.5px solid black; height: 120px">
                    <div
                        style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                        <h4 style="font-size: 10px">% Penurunan</h4>
                    </div>
                    <div style="margin-left: 15px;font-size: 10px">
                        <table class="titikkoma" align="left" cellpadding='1' width=50">
                            <tr>
                                <td>
                                    @if ($data->penurunan == 1)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 1. Tidak ada
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->penurunan == 2)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 2. < 10% luas </td>
                            <tr>
                                <td>
                                    @if ($data->penurunan == 3)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 3. 10-30% luas
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->penurunan == 4)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 4. > 30% luas
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div
                    style="position: absolute; top: 290px; left: 5px; width: 157px; border: 1.5px solid black; height: 120px">
                    <div
                        style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                        <h4 style="font-size: 10px">Erosi Permukaan</h4>
                    </div>
                    <div style="margin-left: 15px;font-size: 10px">
                        <table class="titikkoma" align="left" cellpadding='1' width=50">
                            <tr>
                                <td>
                                    @if ($data->erosi == 1)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 1. Tidak ada
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->erosi == 2)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 2. < 10% luas </td>
                            <tr>
                                <td>
                                    @if ($data->erosi == 3)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 3. 10-30% luas
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->erosi == 4)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 4. > 30% luas
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div
            style="position: absolute; top: 240px; left: 180px; width: 170px; border: 1.5px solid black; height: 480px">
            <div style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                <h4 style="font-size: 10px">Kerikil / Batu</h4>
            </div>
            <div
                style="position: absolute; top: 30px; left: 5px; width: 157px; border: 1.5px solid black; height: 150px">
                <div
                    style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                    <h4 style="font-size: 10px">Ukuran Terbanyak</h4>
                </div>
                <div style="margin-left: 15px;font-size: 10px">
                    <table class="titikkoma" align="left" cellpadding='1' width=50">
                        <tr>
                            <td>
                                @if ($data->ukuranTerbanyak == 1)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 1. Tidak ada
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->ukuranTerbanyak == 2)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 2. < 1 cm </td>
                        <tr>
                            <td>
                                @if ($data->ukuranTerbanyak == 3)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 3. 1 - 5 cm
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->ukuranTerbanyak == 4)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 4. > 5 cm
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->ukuranTerbanyak == 5)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 5. Tidak tentu
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div
                style="position: absolute; top: 190px; left: 5px; width: 157px; border: 1.5px solid black; height: 150px">
                <div
                    style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                    <h4 style="font-size: 10px">Tebal Lapisan</h4>
                </div>
                <div style="margin-left: 15px;font-size: 10px">
                    <table class="titikkoma" align="left" cellpadding='1' width=50">
                        <tr>
                            <td>
                                @if ($data->tebalLapisan == 1)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 1. Tidak ada
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->tebalLapisan == 2)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 2. < 5 cm</td>
                        <tr>
                            <td>
                                @if ($data->tebalLapisan == 3)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 3. 5 - 10 cm
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->tebalLapisan == 4)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 4. 10 - 20 cm
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->tebalLapisan == 5)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 5. > 20 cm
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div
                style="position: absolute; top: 350px; left: 5px; width: 157px; border: 1.5px solid black; height: 120px">
                <div
                    style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                    <h4 style="font-size: 10px">Distribusi</h4>
                </div>
                <div style="margin-left: 15px;font-size: 10px">
                    <table class="titikkoma" align="left" cellpadding='1' width=50">
                        <tr>
                            <td>
                                @if ($data->distribusi == 1)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 1. Tidak ada
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->distribusi == 2)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 2. Rata </td>
                        <tr>
                            <td>
                                @if ($data->distribusi == 3)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 3. Tidak rata
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->distribusi == 4)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 4. Gundukan memanjang
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div
            style="position: absolute; top: 240px; left: 360px; width: 170px; border: 1.5px solid black; height: 585px">
            <div style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                <h4 style="font-size: 10px">Kerusakan Lain</h4>
            </div>
            <div
                style="position: absolute; top: 30px; left: 5px; width: 157px; border: 1.5px solid black; height: 130px">
                <div
                    style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                    <h4 style="font-size: 10px">Jumlah Lubang</h4>
                </div>
                <div style="margin-left: 15px;font-size: 10px">
                    <table class="titikkoma" align="left" cellpadding='1' width=50">
                        <tr>
                            <td>
                                @if ($data->jumlahLubang == 1)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 1. Tidak ada
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->jumlahLubang == 2)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 2. 1 / 100M
                            </td>
                        <tr>
                            <td>
                                @if ($data->jumlahLubang == 3)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 3. 2 - 10 / 100M
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->jumlahLubang == 4)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 4. > 10 / 100M
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div
                style="position: absolute; top: 170px; left: 5px; width: 157px; border: 1.5px solid black; height: 145px">
                <div
                    style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                    <h4 style="font-size: 10px">Ukuran Lubang</h4>
                </div>
                <div style="margin-left: 15px;font-size: 10px">
                    <table class="titikkoma" align="left" cellpadding='1' width=50">
                        <tr>
                            <td>
                                @if ($data->ukuranLubang == 1)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 1. Tidak ada
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->ukuranLubang == 2)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 2. Kecil dan dangkal</td>
                        <tr>
                            <td>
                                @if ($data->ukuranLubang == 3)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 3. Kecil dan dalam
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->ukuranLubang == 4)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 4. Besar dan dangkal
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->ukuranLubang == 5)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 5. Besar dan dalam
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div
                style="position: absolute; top: 325px; left: 5px; width: 157px; border: 1.5px solid black; height: 120px">
                <div
                    style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                    <h4 style="font-size: 10px">Bekas Roda</h4>
                </div>
                <div style="margin-left: 15px;font-size: 10px">
                    <table class="titikkoma" align="left" cellpadding='1' width=50">
                        <tr>
                            <td>
                                @if ($data->bekasRoda == 1)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 1. Tidak ada
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->bekasRoda == 2)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 2. < 10 cm dalam </td>
                        <tr>
                            <td>
                                @if ($data->bekasRoda == 3)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 3. 5-15 cm dalam
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->bekasRoda == 4)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 4. > 15 cm dalam
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div
                style="position: absolute; top: 455px; left: 5px; width: 157px; border: 1.5px solid black; height: 120px">
                <div
                    style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                    <h4 style="font-size: 10px">Bergelombang</h4>
                </div>
                <div style="margin-left: 15px;font-size: 10px">
                    <table class="titikkoma" align="left" cellpadding='1' width=50">
                        <tr>
                            <td>
                                @if ($data->bergelombang == 1)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 1. Tidak ada
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->bergelombang == 2)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 2. < 10% luas </td>
                        <tr>
                            <td>
                                @if ($data->bergelombang == 3)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 3. 10-30% luas
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ($data->bergelombang == 4)
                                    <img src="{{ asset('assets/images/check.png') }}" alt=""
                                        style="width: 20px">
                                @else
                                    <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                        style="width: 20px">
                                @endif
                            </td>
                            <td> 4. > 30% luas
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div
            style="position: absolute; top: 240px; left: 540px; width: 170px; border: 1.5px solid black; height: 660px">
            <div style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                <h4 style="font-size: 10px">Bahu, Saluran samping, dan lain-lain</h4>
                <div
                    style="position: absolute; top: 30px; left: 5px; width: 157px; border: 1.5px solid black; height: 125px">
                    <div
                        style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                        <h4 style="font-size: 10px">KR | Kondisi Bahu | KN</h4>
                    </div>
                    <div style="margin-left: 5px;font-size: 10px">
                        <table class="titikkoma" align="left" cellpadding='1' width=50">
                            <tr>
                                <td>
                                    @if ($data->kondisiBahuKiri == 1)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 1. Tidak ada
                                </td>
                                <td>
                                    @if ($data->kondisiBahuKanan == 1)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->kondisiBahuKiri == 2)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 2. Baik/Rata
                                </td>
                                <td>
                                    @if ($data->kondisiBahuKanan == 2)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->kondisiBahuKiri == 3)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 3. Bekas rd./Erosi ringan
                                </td>
                                <td>
                                    @if ($data->kondisiBahuKanan == 3)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->kondisiBahuKiri == 4)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 4. Bekas rd./Erosi berat
                                </td>
                                <td>
                                    @if ($data->kondisiBahuKanan == 4)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div
                    style="position: absolute; top: 165px; left: 5px; width: 157px; border: 1.5px solid black; height: 160px">
                    <div
                        style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                        <h4 style="font-size: 10px">KR | Permukaan Bahu | KN</h4>
                    </div>
                    <div style="margin-left: 5px;font-size: 10px">
                        <table class="titikkoma" align="left" cellpadding='1' width=50">
                            <tr>
                                <td>
                                    @if ($data->permukaanBahuKiri == 1)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 1. Tidak ada
                                </td>
                                <td>
                                    @if ($data->permukaanBahuKanan == 1)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->permukaanBahuKiri == 2)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 2. Diatas permukaan jalan
                                </td>
                                <td>
                                    @if ($data->permukaanBahuKanan == 2)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->permukaanBahuKiri == 3)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 3. Rata dengan permukaan jalan
                                </td>
                                <td>
                                    @if ($data->permukaanBahuKanan == 3)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->permukaanBahuKiri == 4)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 4. Dibawah permukaan jalan
                                </td>
                                <td>
                                    @if ($data->permukaanBahuKanan == 4)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->permukaanBahuKiri == 5)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 5. > 10 cm dibawah permukaan jalan
                                </td>
                                <td>
                                    @if ($data->permukaanBahuKanan == 5)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div
                    style="position: absolute; top: 335px; left: 5px; width: 157px; border: 1.5px solid black; height: 120px">
                    <div
                        style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                        <h4 style="font-size: 10px">KR | Kondisi Saluran Samping | KN</h4>
                    </div>
                    <div style="margin-left: 5px;font-size: 10px">
                        <table class="titikkoma" align="left" cellpadding='1' width=50">
                            <tr>
                                <td>
                                    @if ($data->kondisiSaluranKiri == 1)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 1. Tidak ada
                                </td>
                                <td>
                                    @if ($data->kondisiSaluranKanan == 1)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->kondisiSaluranKiri == 2)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 2. Bersih
                                </td>
                                <td>
                                    @if ($data->kondisiSaluranKanan == 2)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->kondisiSaluranKiri == 3)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 3. Tertutup/Tersumbat
                                </td>
                                <td>
                                    @if ($data->kondisiSaluranKanan == 3)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->kondisiSaluranKiri == 4)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 4. Erosi
                                </td>
                                <td>
                                    @if ($data->kondisiSaluranKanan == 4)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div
                    style="position: absolute; top: 465px; left: 5px; width: 157px; border: 1.5px solid black; height: 80px">
                    <div
                        style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                        <h4 style="font-size: 10px">KR | Kerusakan Lereng | KN</h4>
                    </div>
                    <div style="margin-left: 10px;font-size: 10px">
                        <table class="titikkoma" align="left" cellpadding='1' width=50">
                            <tr>
                                <td>
                                    @if ($data->kerusakanLerengKiri == 1)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 1. Tidak ada
                                </td>
                                <td>
                                    @if ($data->kerusakanLerengKanan == 1)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->kerusakanLerengKiri == 2)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 2. Longsor/Runtuh
                                </td>
                                <td>
                                    @if ($data->kerusakanLerengKanan == 2)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div
                    style="position: absolute; top: 555px; left: 5px; width: 157px; border: 1.5px solid black; height: 95px">
                    <div
                        style="width: 100%;text-align: center;border-bottom: 1.5px solid black;height: 15px;margin-top: -7px">
                        <h4 style="font-size: 10px">KR | Trotoar | KN</h4>
                    </div>
                    <div style="margin-left: 25px;font-size: 10px">
                        <table class="titikkoma" align="left" cellpadding='1' width=50">
                            <tr>
                                <td>
                                    @if ($data->trotoarKiri == 1)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 1. Tidak ada
                                </td>
                                <td>
                                    @if ($data->trotoarKanan == 1)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->trotoarKiri == 2)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 2. Baik/Aman
                                </td>
                                <td>
                                    @if ($data->trotoarKanan == 2)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($data->trotoarKiri == 3)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                                <td> 3. Berbahaya
                                </td>
                                <td>
                                    @if ($data->trotoarKanan == 3)
                                        <img src="{{ asset('assets/images/check.png') }}" alt=""
                                            style="width: 20px">
                                    @else
                                        <img src="{{ asset('assets/images/uncheck.png') }}" alt=""
                                            style="width: 20px">
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div style="position: absolute; top: 920px; left: 10px ; font-size: 10px;font-weight: bold">Keterangan:
            <br>
            <div style="font-weight: normal">Ukuran lubang Kecil diameter < 0,5m, <br> Besar: diameter> 0.5m, <br>
                    Dangkal
                    (kedalaman < 5 cm), <br> Dalam (kedalaman)> 5 cm
            </div>
            <div>Status Ruas Jalan : N = Nasional; P = Propinsi; M = Kotamadya; K = Kabupaten </div>
        </div>
    </main>
</body>

</html>
