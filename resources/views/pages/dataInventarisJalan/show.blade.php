<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Detail Jalan Aspal</title>
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
        <h4 style="text-align: center;margin-top: 80px">FORMULIR SURVEI INVENTARISASI JARINGAN JALAN - SAAT INI</h4>
    </header>
    <main>
        <div
            style="position: absolute; top: 110px; left: 10px ;height: 100px; width: 300px;border: 1.5px solid black;text-transform: uppercase">
            <div
                style="height: 95%; width: 41%;border-right: 1.5px solid black;font-size: 13px;padding: 3px;font-weight: 600">
                <span style="display: block; margin-bottom: 5px;">PROPINSI</span>
                <span style="display: block; margin-bottom: 5px;">KABUPATEN/KOTA</span>
                <span style="display: block; margin-bottom: 10px;">NO. PROV/KAB.</span>
                <div style="position: absolute; top: 62px; left: 0px;border: 0.75px solid black;width: 100%">
                </div>
                <span style="display: block; margin-bottom: 10px;">REFERENSI LOKASI</span>
            </div>
            <div
                style="position: absolute; top: 0px; left:135px;height: 95%; width: 54%;font-size: 13px;padding: 3px;font-weight: 600">
                <span style="display: block; margin-bottom: 5px;">{{ $data->namaProvinsi }}</span>
                <span style="display: block; margin-bottom: 5px;">{{ $data->kabupaten }}</span>
                @php $noProvinsi = str_split($data->noProvinsi ?? ''); @endphp @foreach ($noProvinsi as $digit)
                    <span
                        style="display: inline-block; margin-right: -4px; border: 1px solid black; width: 20px; padding-left: 5px; text-align: center;">{{ $digit }}</span>
                @endforeach
                <span style="display: block; margin-bottom: 10px; margin-top: 2px">
                    <div style="font-size: 11.5px;text-align: center">
                        <span style="margin-right: 27px;">drp</span>
                        <span style="margin-right: 25px">lrp</span>
                        <span>chn</span>
                    </div>
                    <div style="font-size: 11.5px;text-transform: normal;margin-top: 4px;text-align: center">
                        <span
                            style="display: inline-block; min-width: 25px; margin-right: 20px; border: 1px solid black; padding: 1.5px;">
                            {!! $data->DRP ?? '&nbsp;' !!} </span> <span
                            style="display: inline-block; min-width: 25px; margin-right: 20px; border: 1px solid black; padding: 1.5px;">
                            {!! $data->LRP ?? '&nbsp;' !!} </span> <span
                            style="display: inline-block; min-width: 25px; border: 1px solid black; padding: 1.5px;">
                            {!! $data->CHN ?? '&nbsp;' !!} </span>
                    </div>
                </span>
            </div>
        </div>
        <div
            style="position: absolute; top: 110px; left: 330px ;height: 100px; width: 370px;border: 1.5px solid black;text-transform: uppercase">
            <div>
                <div
                    style="height: 35%; width: 11%;border-right: 1.5px solid black;font-size: 13px;padding: 3px;font-weight: 600;text-align: center">
                    Ruas
                </div>
                <div style="position: absolute; top: 40px; left: 0px;border: 0.75px solid black;width: 100%">
                </div>
                <div
                    style="position: absolute; top: 0px; left:50px;height: 95%; width: 100%;font-size: 13px;padding: 3px;font-weight: 600;margin-top: -3px">
                    <table class="titikkoma" align="left" cellpadding='1' width=200">
                        <tr>
                            <td>Nomor Ruas</td>
                            <td>:
                                <span style="height: 10px;width: 20px;border: 1px solid black;padding: 2px">
                                    {{ $data->noRuas }}
                                </span>
                            </td>
                        </tr>
                        <div
                            style="position: absolute; top: 26px; left: -1.5px;border: 0.25px solid black;width: 85.5%">
                        </div>
                        <tr>
                            <td>Nama Ruas</td>
                            <td>:
                                <span>
                                    {{ $data->namaRuas }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div style="font-size: 13px;padding: 3px;font-weight: 600;margin-top: -3px;text-align: center">
                <table class="titikkoma" align="left" cellpadding='1' width=280>
                    <tr>
                        <td>dari patok km</td>
                        <td>:
                        </td>
                        <td>
                            @php
                                $dariPatokKmSegments = str_split($data->dariPatokKm);
                                $totalSegments = 9; // Adjust total segments to include 3 additional boxes after '.'
                            @endphp
                            @for ($index = 0; $index < $totalSegments; $index++)
                                @if (isset($dariPatokKmSegments[$index]))
                                    <span
                                        style="height: 20px; width: 15px; border: 1px solid black; display: inline-block; text-align: center; margin-top: 3px; vertical-align: middle; margin-right: -5px;">
                                        {{ $dariPatokKmSegments[$index] }}
                                    </span>
                                @else
                                    <span
                                        style="height: 20px; width: 15px; border: 1px solid black; display: inline-block; text-align: center; margin-top: 3px; vertical-align: middle; margin-right: -5px;">
                                        &nbsp; <!-- Empty box if no data -->
                                    </span>
                                @endif

                                @if (($index + 1) % 3 == 0)
                                    @if ($index == 2)
                                        <span style="margin: 0 5px;">+</span>
                                    @elseif ($index == 5)
                                        <span style="margin: 0 5px;">.</span>
                                    @endif
                                @endif
                            @endfor
                        </td>
                    </tr>
                    <tr>
                        <td>ke patok km</td>
                        <td>:
                        </td>
                        <td>
                            @php
                                $dariPatokKmSegments = str_split($data->kePatokKm);
                                $totalSegments = 9; // Adjust total segments to include 3 additional boxes after '.'
                            @endphp
                            @for ($index = 0; $index < $totalSegments; $index++)
                                @if (isset($dariPatokKmSegments[$index]))
                                    <span
                                        style="height: 20px; width: 15px; border: 1px solid black; display: inline-block; text-align: center; margin-top: 3px; vertical-align: middle; margin-right: -5px;">
                                        {{ $dariPatokKmSegments[$index] }}
                                    </span>
                                @else
                                    <span
                                        style="height: 20px; width: 15px; border: 1px solid black; display: inline-block; text-align: center; margin-top: 3px; vertical-align: middle; margin-right: -5px;">
                                        &nbsp; <!-- Empty box if no data -->
                                    </span>
                                @endif

                                @if (($index + 1) % 3 == 0)
                                    @if ($index == 2)
                                        <span style="margin: 0 5px;">+</span>
                                    @elseif ($index == 5)
                                        <span style="margin: 0 5px;">.</span>
                                    @endif
                                @endif
                            @endfor
                        </td>
                    </tr>
                </table>

            </div>
        </div>
        <div
            style="position: absolute; top: 110px; left: 718px ;height: 100px; width: 300px;border: 1.5px solid black;text-transform: uppercase">
            <div style="font-size: 13px;padding: 3px;font-weight: 600;margin-left: 3px">dikerjakan oleh:</div>
            <div style="font-size: 13px;padding: 3px;font-weight: 600;">
                <table class="titikkoma" align="left" cellpadding='1' width=200">
                    <tr>
                        <td>Nama</td>
                        <td>:

                        </td>
                        <td style="border-bottom: 1px solid black; width: 200px">
                            <span style="">
                                {{ $users[0]->name }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:

                        </td>
                        <td style="border-bottom: 1px solid black; width: 200px">
                            <span>
                                {{ $users[0]->jabatan }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="height: 9px;"></td> <!-- Adds vertical space between rows -->
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td style="width: 200px;">
                            @php
                                $formattedDate = \Carbon\Carbon::parse($data->date)->format('d/m/Y');
                                $dateParts = str_split($formattedDate);
                            @endphp
                            <span>
                                @foreach ($dateParts as $part)
                                    @if ($part == '/')
                                        <span style="margin: 0 5px;">{{ $part }}</span>
                                    @else
                                        <span
                                            style="display: inline-block; border: 1px solid black; padding-top: 2px; padding-bottom: 2px;padding-left: 6px; padding-right: 6px; margin: -2px;">{{ $part }}</span>
                                    @endif
                                @endforeach
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div style="height: 400px;position: absolute; top: 225px; left: 10px;right: 10px;border: 1.5px solid black">
            <div
                style="position: absolute;top:0px;left:100px;font-size: 13px;padding: 3px;font-weight: 600;height: 14px;width: 905px; text-align: center;text-transform: uppercase;border-bottom: 1.5px solid black;">
                inventaris
                saat ini</div>
            <div
                style="position: absolute;height:60px;width:101px;top:0px;left:0px;text-align: center;font-size:12px;font-weight: 600;margin-top: 16px">
                Lokasi <br> STA To
                STA</div>

            <div style="position: absolute;top:50px;left:183px;width:646px;border-bottom: 1.5px solid black"></div>
            <div style="position: absolute;top:60px;left:0px;width:101px;border-bottom: 1.5px solid black"></div>
            <div style="position: absolute;top:50px;left:183px;width:646px;border-bottom: 1.5px solid black"></div>
            <div style="position: absolute;top:35px;left:308px;width:431px;border-bottom: 1.5px solid black"></div>
            <div style="position: absolute;top:35px;left:828px;width:182px;border-bottom: 1.5px solid black"></div>

            <div
                style="position: absolute;height:20px;width:50.5px;top:48px;left:0px;text-align: center;font-size:12px;font-weight: 600;margin-top: 16px">
                DARI</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:48px;left:50.5px;text-align: center;font-size:12px;font-weight: 600;margin-top: 16px">
                KE</div>
            <div
                style="position: absolute;height:40px;width:50.5px;top:20px;left:97px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                TIPE JALAN</div>
            <div
                style="position: absolute;height:40px;width:50.5px;top:20px;left:137px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                MEDIAN</div>
            <div
                style="position: absolute;height:20px;width:151.5px;top:7px;left:173px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                LAPIS <br> PERMUKAAN</div>
            <div
                style="position: absolute;height:20px;width:151.5px;top:7px;left:323px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                BAHU</div>
            <div
                style="position: absolute;height:20px;width:202px;top:7px;left:513px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                SALURAN SAMPING</div>
            <div
                style="position: absolute;height:20px;width:101px;top:22px;left:303px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                KIRI</div>
            <div
                style="position: absolute;height:20px;width:101px;top:22px;left:388px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                KANAN</div>
            <div
                style="position: absolute;height:20px;width:101px;top:22px;left:498px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                KIRI</div>
            <div
                style="position: absolute;height:20px;width:101px;top:22px;left:628px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                KANAN</div>
            <div
                style="position: absolute;height:20px;width:101px;top:7px;left:733px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                TERRAIN <br> NAIK(T)/TURUN(L)</div>
            <div
                style="position: absolute;height:20px;width:101px;top:7px;left:823px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                ALINYEMEN</div>
            <div
                style="position: absolute;height:20px;width:101px;top:7px;left:914.5px;text-align: center;font-size:8.5px;font-weight: 600;margin-top: 16px">
                TATA GUNA LAHAN</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:178px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                TAHUN</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:220px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                JENIS</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:263px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                LEBAR <br> (M)</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:305px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                JENIS</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:350px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                LEBAR <br> (M)</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:393px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                JENIS</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:436px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                LEBAR <br> (M)</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:480px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                JENIS</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:523px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                LEBAR <br> CM</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:565px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                DALAM <br> CM</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:609px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                JENIS</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:654px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                LEBAR <br> CM</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:694px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                DALAM <br> CM</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:736px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                KIRI</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:782px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                KANAN</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:22px;left:825.5px;text-align: center;font-size:6.5px;font-weight: 600;margin-top: 16px">
                VERTIKAL <br> <br> (GRADE) <br><br> NAIK/TURUN</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:22px;left:871.5px;text-align: center;font-size:6.5px;font-weight: 600;margin-top: 16px">
                HORIZONTAL <br> <br> (BELOKAN)</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:915px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                KIRI</div>
            <div
                style="position: absolute;height:20px;width:50.5px;top:40px;left:961px;text-align: center;font-size:9px;font-weight: 600;margin-top: 16px">
                KANAN</div>
            <div style="position: absolute;top:60px;left:50px;border-right: 1.5px solid black;height: 340px;"></div>
            <div style="position: absolute;top:0px;left:100px;border-right: 1.5px solid black;height: 400px;"></div>
            <div style="position: absolute;top:20px;left:140px;border-right: 1.5px solid black;height: 380px;"></div>
            <div style="position: absolute;top:20px;left:183px;border-right: 1.5px solid black;height: 380px;"></div>
            <div style="position: absolute;top:50px;left:223px;border-right: 1.5px solid black;height: 350px;"></div>
            <div style="position: absolute;top:50px;left:268px;border-right: 1.5px solid black;height: 350px;"></div>
            <div style="position: absolute;top:20px;left:308px;border-right: 1.5px solid black;height: 380px;"></div>
            <div style="position: absolute;top:50px;left:353px;border-right: 1.5px solid black;height: 350px;"></div>
            <div style="position: absolute;top:35px;left:398px;border-right: 1.5px solid black;height: 365px;"></div>
            <div style="position: absolute;top:50px;left:438px;border-right: 1.5px solid black;height: 350px;"></div>
            <div style="position: absolute;top:20px;left:483px;border-right: 1.5px solid black;height: 380px;"></div>
            <div style="position: absolute;top:50px;left:528px;border-right: 1.5px solid black;height: 350px;"></div>
            <div style="position: absolute;top:50px;left:568px;border-right: 1.5px solid black;height: 350px;"></div>
            <div style="position: absolute;top:35px;left:613px;border-right: 1.5px solid black;height: 365px;"></div>
            <div style="position: absolute;top:50px;left:658px;border-right: 1.5px solid black;height: 350px;"></div>
            <div style="position: absolute;top:50px;left:698px;border-right: 1.5px solid black;height: 350px;"></div>
            <div style="position: absolute;top:20px;left:738px;border-right: 1.5px solid black;height: 380px;"></div>
            <div style="position: absolute;top:50px;left:783px;border-right: 1.5px solid black;height: 350px;"></div>
            <div style="position: absolute;top:20px;left:828px;border-right: 1.5px solid black;height: 380px;"></div>
            <div style="position: absolute;top:35px;left:873px;border-right: 1.5px solid black;height: 365px;"></div>
            <div style="position: absolute;top:20px;left:919px;border-right: 1.5px solid black;height: 380px;"></div>
            <div style="position: absolute;top:35px;left:962px;border-right: 1.5px solid black;height: 365px;"></div>
            <div style="height: 80px; border-bottom: 1.5px solid black"></div>
            <div
                style="height: 21px; border-bottom: 1.5px solid black; padding-top: 5px; padding-bottom: 2px; width: 100%; font-size: 11px;text-align: center;font-style: italic">
                <div style="display: inline-block; margin-bottom: -5px; width:4%">1</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">2</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">3</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">4</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">5</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">6</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">7</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">8</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">9</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">10</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">11</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">12</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">13</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">14</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">15</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">16</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">17</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">18</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">19</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">20</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">21</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">22</div>
                <div style="display: inline-block; margin-bottom: -5px; width:4%">23</div>
            </div>
            @for ($i = 0; $i < 10; $i++)
                @php
                    $street = isset($streets[$i]) ? $streets[$i] : null;
                @endphp
                @if ($street)
                    <div
                        style="height: 21px; border-bottom: 1px solid black; padding-top: 5px; padding-bottom: 2px; width: 100%; font-size: 11px;text-align: center">
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ str_pad($street['dari_patok'] ?? '000', 3, '0', STR_PAD_LEFT) }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ str_pad($street['ke_patok'] ?? '000', 3, '0', STR_PAD_LEFT) }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['tipe_jalan'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['median'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['lapis_permukaan_tahun'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['lapis_permukaan_jenis'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['lapis_permukaan_lebar'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['bahu_kiri_jenis'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['bahu_kiri_lebar'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['bahu_kanan_jenis'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['bahu_kanan_lebar'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['saluran_kiri_jenis'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['saluran_kiri_lebar'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['saluran_kiri_dalam'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['saluran_kanan_jenis'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['saluran_kanan_lebar'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['saluran_kanan_dalam'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['terrain_kiri'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['terrain_kanan'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['alinyemen_vertical'] ?? '-' }}
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%">
                            {{ $street['alinyemen_horizontal'] ?? '-' }}
                        </div>
                        <div
                            style="display: inline-block; margin-bottom: -5px; width:4%;font-size: 7px;margin-left: 12px">
                            @if ($street['tata_kiri'] == '1')
                                Sawah
                            @endif
                            @if ($street['tata_kiri'] == '2')
                                Kebun
                            @endif
                            @if ($street['tata_kiri'] == '3')
                                Hutan
                            @endif
                            @if ($street['tata_kiri'] == '4')
                                Perumahan
                            @endif
                            @if ($street['tata_kiri'] == '5')
                                Perindustrian
                            @endif
                            @if ($street['tata_kiri'] == '6')
                                Pertokoan
                            @endif
                            @if ($street['tata_kiri'] == '7')
                                Perkantoran
                            @endif
                            @if ($street['tata_kiri'] == '8')
                                Pasar
                            @endif
                        </div>
                        <div style="display: inline-block; margin-bottom: -5px; width:4%;font-size: 7px">
                            @if ($street['tata_kanan'] == '1')
                                Sawah
                            @endif
                            @if ($street['tata_kanan'] == '2')
                                Kebun
                            @endif
                            @if ($street['tata_kanan'] == '3')
                                Hutan
                            @endif
                            @if ($street['tata_kanan'] == '4')
                                Perumahan
                            @endif
                            @if ($street['tata_kanan'] == '5')
                                Perindustrian
                            @endif
                            @if ($street['tata_kanan'] == '6')
                                Pertokoan
                            @endif
                            @if ($street['tata_kanan'] == '7')
                                Perkantoran
                            @endif
                            @if ($street['tata_kanan'] == '8')
                                Pasar
                            @endif
                        </div>
                    </div>
                @endif
            @endfor
        </div>
        <div style="text-transform: uppercase">
            <div style="position: absolute;left:10px;top: 630px;width: 100%;font-weight: 600;font-size: 10px">KODE
                JENIS
                PERMUKAAN/PELAPISAN ULANG
            </div>
            <div style="position: absolute;left:10px;top: 645px;width: 150px;font-size: 8px;height: 50px">
                <div>0. Tidak diketahui</div>
                <div>1. tanah</div>
                <div>2. JAPAT (AWCAS) / KERIKIL</div>
                <div>3. TELFORD / MACADAM TERBUKA</div>
                <div>4. BURTU</div>
            </div>
            <div style="position: absolute;left:160px;top: 645px;width: 150px;font-size: 8px;height: 50px">
                <div>5. BURDA</div>
                <div>6. PENETRASI MACADAM 1 LAPIS</div>
                <div>7. PENETRASI MACADAM 2 LAPIS</div>
                <div>8. LASBUTAG (BUTAS)</div>
                <div>9. ASPAL BETON (A.C.)</div>
            </div>
            <div style="position: absolute;left:310px;top: 645px;width: 100px;font-size: 8px;height: 50px">
                <div>10. LATASBUM (NACAS)</div>
                <div>11. LATASTON (HRS)</div>
                <div>12. HRSSA</div>
                <div>13. SLURRY SEAL</div>
                <div>14. MACRO SEAL</div>
            </div>
            <div style="position: absolute;left:420px;top: 645px;width: 100px;font-size: 8px;height: 50px">
                <div>15. MICRO ASBUTON</div>
                <div>16. DGEM</div>
                <div>17. SMA</div>
                <div>18. BMA</div>
                <div>19. HSWC</div>
            </div>
            <div style="position: absolute;left:510px;top: 645px;width: 150px;font-size: 8px;height: 50px">
                <div>20. SPAV</div>
                <div>21. RIGID</div>
            </div>
        </div>
        <div style="position: absolute;left:560px;top: 630px;width: 100%;font-weight: 600;font-size: 10px">KODE JENIS
            BAHU
        </div>
        <div style="position: absolute;left:560px;top: 645px;width: 150px;font-size: 8px;height: 50px">
            <div>0. TIDAK ADA BAHU</div>
            <div>1. BAHU LUNAK</div>
            <div>2. BAHU YANG DIPERKERAS</div>
        </div>
        <div style="position: absolute;left:680px;top: 630px;width: 100%;font-weight: 600;font-size: 10px">KODE JENIS
            SALURAN SAMPING
        </div>
        <div style="position: absolute;left:680px;top: 645px;width: 150px;font-size: 8px;height: 50px">
            <div>1. TANAH TERBUKA</div>
            <div>2. BETON/PAS. BATU TERBUKA</div>
            <div>3. SALURAN IRIGASI</div>
            <div>4. BETON/PAS. BATU TERTUTUP</div>
            <div>5. TIDAK ADA</div>
        </div>
        <div style="position: absolute;left:860px;top: 630px;width: 100%;font-weight: 600;font-size: 10px">KODE TATA
            GUNA LAHAN
        </div>
        <div style="position: absolute;left:860px;top: 645px;width: 150px;font-size: 8px;height: 50px">
            <div>1. SAWAH / KEBUN / HUTAN ( RURAL )</div>
            <div>2. PERUMAHAN ( URBAN 1 )</div>
            <div>3. PERINDUSTRIAN ( URBAN 2 )</div>
            <div>4. PERTOKOAN / PERKANTORAN / PASAR ( URBAN 3 )</div>
        </div>
        <div style="position: absolute;left:10px;top: 695px;width: 100%;font-weight: 600;font-size: 10px">KODE TIPE
            JALAN
        </div>
        <div style="position: absolute;left:10px;top: 710px;width: 100px;font-size: 8px;height: 50px">
            <div>1. 2 / 1 UD</div>
            <div>2. 2 / 2 UD</div>
            <div>3. 4 / 2 UD</div>
        </div>
        <div style="position: absolute;left:60px;top: 710px;width: 100px;font-size: 8px;height: 50px">
            <div>4. 4 / 2 D</div>
            <div>5. 6 / 2 D</div>
        </div>
        <div style="position: absolute;left:160px;top: 695px;width: 100%;font-weight: 600;font-size: 10px">KODE MEDIAN
        </div>
        <div style="position: absolute;left:160px;top: 710px;width: 100px;font-size: 8px;height: 50px">
            <div>{{ '0. TIDAK ADA' }}</div>
            <div>{{ '1. 1 < M ' }}</div>
            <div>{{ '2. 1 - 3 M' }}</div>
        </div>
        <div style="position: absolute;left:220px;top: 710px;width: 100px;font-size: 8px;height: 50px">
            <div>{{ '3. 3 < M' }}</div>
        </div>
        <div style="position: absolute;left:310px;top: 695px;width: 100%;font-weight: 600;font-size: 10px">KODE TERRAIN
        </div>
        <div style="position: absolute;left:310px;top: 710px;width: 150px;font-size: 8px;height: 50px">
            <div>{{ '1. DATAR (F) < 1,0 M' }}</div>
            <div>{{ '2. 1,0 M < BUKIT (R) < 3,0 M ' }}</div>
            <div>{{ '3. GUNUNG (H) > 3,0 M' }}</div>
        </div>
        <div style="position: absolute;left:420px;top: 695px;width: 100%;font-weight: 600;font-size: 10px">KODE GRADE (
            ALIN. VER.)
        </div>
        <div style="position: absolute;left:420px;top: 710px;width: 150px;font-size: 8px;height: 50px">
            <div>{{ '1. DATAR (F) ( < 5,0 M / KM )' }}</div>
            <div>{{ '2. BUKIT (R) ( 5 - 45 M / KM )' }}</div>
            <div>{{ '3. GUNUNG (H) ( > 45 M / KM )' }}</div>
        </div>
        <div style="position: absolute;left:560px;top: 695px;width: 100%;font-weight: 600;font-size: 10px">KODE BELOKAN
            ( ALIN. HOR.)
        </div>
        <div style="position: absolute;left:560px;top: 710px;width: 200px;font-size: 8px;height: 50px">
            <div>{{ '1. LURUS ( < 0,25 RAD / KM )' }}</div>
            <div>{{ '2. SEDIKIT BELOKAN ( 0,25 - 3,50 RAD / KM )' }}</div>
            <div>{{ '3. BANYAK BELOKAN ( > 3,50 RAD / KM )' }}</div>
        </div>
        <div style="position: absolute;left:740px;top: 695px;width: 100%;font-weight: 600;font-size: 10px"> TERRAIN
        </div>
        <div style="position: absolute;left:740px;top: 710px;width: 200px;font-size: 8px;height: 50px">
            <div>{{ 'T = TEBING' }}</div>
            <div>{{ 'L =  LEMBAH' }}</div>
        </div>
    </main>
</body>

</html>
