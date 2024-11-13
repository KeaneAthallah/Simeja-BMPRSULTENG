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
                <table class="titikkoma" align="left" cellpadding='1' width=200>
                    <tr>
                        <td>dari patok km</td>
                        <td>:
                        </td>
                        <td>
                            @foreach (str_split($data->dariPatokKm, 3) as $segment)
                                <span
                                    style="height: 20px; width: 30px; border: 1px solid black; display: inline-block; text-align: center; margin-top: 3px; vertical-align: middle;">
                                    {{ $segment }}
                                </span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>ke patok km</td>
                        <td>:
                        </td>
                        <td>
                            @foreach (str_split($data->kePatokKm, 3) as $segment)
                                <span
                                    style="height: 20px; width: 30px; border: 1px solid black; display: inline-block; text-align: center; margin-top: 3px; vertical-align: middle;">
                                    {{ $segment }}
                                </span>
                            @endforeach
                        </td>
                    </tr>
                </table>

            </div>
        </div>
        <div
            style="position: absolute; top: 110px; left: 718px ;height: 100px; width: 300px;border: 1.5px solid black;text-transform: uppercase">
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
        <div style="height: 400px;position: absolute; top: 225px; left: 10px;right: 10px;border: 1px solid black">

        </div>
    </main>
</body>

</html>
