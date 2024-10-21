<x-layout-dashboard>
    <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="rounded-2xl mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title mb-4">Laporan Masyarakat</h6>
                                <div class="table-responsive mt-2">
                                    <table id="dataTableExample" class="table dark:table-dark">
                                        <thead>
                                            <tr class="text-xs lg:text-base">
                                                <th>No</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Hp</th>
                                                <th>Lokasi</th>
                                                <th>Foto</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $data)
                                                <tr class="text-center content-center text-sm">
                                                    <td class="text-center content-center text-sm">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="text-center content-center text-sm"
                                                        class="text-center content-center text-sm">
                                                        {{ $data->nik }}</td>
                                                    <td class="text-center content-center text-sm">
                                                        {{ $data->name }}</td>
                                                    <td class="text-center content-center text-sm">
                                                        {{ $data->email }}</td>
                                                    <td class="text-center content-center text-sm">
                                                        {{ $data->phone ? $data->phone : 'Belum di isi' }}
                                                    </td>
                                                    <td class="text-center content-center text-sm">
                                                        {{ $data->lat ? $data->lat : 'Belum di isi' }}
                                                    </td>
                                                    <td class="w-48 h-auto flex justify-center content-center"><img
                                                            src="{{ asset('storage/' . $data->image) }}" alt="">
                                                    </td>
                                                    <td class="text-center content-center text-sm max-w-32">
                                                        <div class="grid lg:flex gap-1 justify-center">
                                                            <a href="#" class="btn btn-info">Info</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
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
</x-layout-dashboard>
