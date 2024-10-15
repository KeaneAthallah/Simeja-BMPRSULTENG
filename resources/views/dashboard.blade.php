<!DOCTYPE html>
<html lang="en" class="h-full bg-nord6 text-nord0">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('components/datatables.net-bs5/dataTables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('components/css/bootstrap.min.css') }}">
</head>

<body class="h-full">
    <div class="min-h-full">
        <x-navbar></x-navbar>
        <x-header></x-header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div class="rounded-2xl mt-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-4">Laporan Masyarakat</h6>
                                        <div class="table-responsive mt-2">
                                            <table id="dataTableExample" class="table ">
                                                <thead>
                                                    <tr class="text-xs lg:text-base">
                                                        <th>No</th>
                                                        <th>Paket</th>
                                                        <th>Lokasi</th>
                                                        <th>OPD</th>
                                                        <th>Konsultan Perencanaan</th>
                                                        <th>Konsultan Pengawasan</th>
                                                        <th>Pelaksanaan</th>
                                                        <th>Nama Pimpinan</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @foreach ($datas as $data)
                                                        <tr class="text-center content-center text-sm">
                                                            <td class="text-center content-center text-sm">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td class="text-center content-center text-sm"
                                                                class="text-center content-center text-sm">
                                                                {{ substr($data->namaPaket, 0, 30) . '...' }}</td>
                                                            <td class="text-center content-center text-sm">
                                                                {{ $data->lokasi }}</td>
                                                            <td class="text-center content-center text-sm">
                                                                {{ $data->OPD }}</td>
                                                            <td class="text-center content-center text-sm">
                                                                {{ $data->consultantPlanning ? $data->consultantPlanning->namaPerusahaan : 'Belum di isi' }}
                                                            </td>
                                                            <td class="text-center content-center text-sm">
                                                                {{ $data->consultantMonitor ? $data->consultantMonitor->namaPerusahaan : 'Belum di isi' }}
                                                            </td>
                                                            <td class="text-center content-center text-sm">
                                                                {{ $data->physicalImplementation ? $data->physicalImplementation->namaPerusahaan : 'Belum di isi' }}
                                                            </td>
                                                            <td class="text-center content-center text-sm">
                                                                {{ $data->physicalImplementation ? $data->physicalImplementation->namaPimpinan : 'Belum di isi' }}
                                                            </td>
                                                            <td class="text-center content-center text-sm max-w-32">
                                                                <div class="grid lg:flex gap-1 justify-center">
                                                                    <a href="{{ route('show.pdf', $data->id) }}"
                                                                        class="btn btn-info">Info</a>
                                                                    <a href="{{ route('download.pdf', $data->id) }}"
                                                                        class="btn btn-success">Unduh</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <x-footer></x-footer>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('components/datatables.net/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('components/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
        <script src="{{ asset('components/js/data-table.js') }}"></script>
    </div>



</body>

</html>
