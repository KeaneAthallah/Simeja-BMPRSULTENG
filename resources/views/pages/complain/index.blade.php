<x-layout-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="mx-auto min-h-[120vh] px-4 py-6 sm:px-6 lg:px-8">
        <div class="rounded-2xl">
            <!--Container-->
            <div class="container w-full max-w-full mx-auto px-2">
                <!--Title-->
                <h1
                    class="flex items-center font-sans font-bold break-normal text-nord0 dark:text-nord6 px-2 py-2 text-xl md:text-2xl">
                    Aspirasi
                </h1>
                <!--Card-->
                <div id='recipients'
                    class="p-8 mt-6 lg:mt-0 rounded shadow bg-nord4 dark:bg-nord3 text-nord0 dark:text-nord6">

                    <table id="filter-table">
                        <thead>
                            <tr>
                                <th>
                                    <span class="flex items-center">
                                        NIK
                                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                        </svg>
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        <span class="dashicons dashicons-nametag">Nama</span>
                                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                        </svg>
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        Alamat
                                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                        </svg>
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        Status
                                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                        </svg>
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        Action
                                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                        </svg>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data->nik }}
                                    </td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->address }}</td>
                                    <td>
                                        <div class="flex justify-center">
                                            @if ($data->status == 'Pending')
                                                <span
                                                    class="bg-nord16 font-bold rounded-md px-4 py-2 text-nord0 w-44 text-center">Baru</span>
                                            @endif
                                            @if ($data->status == 'On Progress')
                                                <span
                                                    class="bg-nord20 font-bold rounded-md px-4 py-2 text-nord0 w-44 text-center">Dikerjakan</span>
                                            @endif
                                            @if ($data->status == 'Completed')
                                                <span
                                                    class="bg-nord7 font-bold rounded-md px-4 py-2 text-nord0 w-44 text-center">Selesai</span>
                                            @endif
                                        </div>
                                    </td>
                                    <>
                                        <td>
                                            <form action="{{ route('aspirasi.update', $data->id) }}" method="POST">
                                                @csrf
                                                @method('PUT') <!-- Assuming you're using PUT method for update -->

                                                <select name="status"
                                                    class="form-select bg-white text-gray-900 rounded-md border-gray-300">
                                                    <option value="Pending"
                                                        {{ $data->status == 'Pending' ? 'selected' : '' }}>Baru
                                                    </option>
                                                    <option value="On Progress"
                                                        {{ $data->status == 'On Progress' ? 'selected' : '' }}>
                                                        Dikerjakan
                                                    </option>
                                                    <option value="Completed"
                                                        {{ $data->status == 'Completed' ? 'selected' : '' }}>Selesai
                                                    </option>
                                                </select>

                                                <button type="submit"
                                                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                    Update
                                                </button>
                                            </form>
                                        </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/container-->
        </div>
    </div>
    <script>
        if (document.getElementById("filter-table") && typeof simpleDatatables.DataTable !== 'undefined') {
            const dataTable = new simpleDatatables.DataTable("#filter-table", {
                tableRender: (_data, table, type) => {
                    if (type === "print") {
                        return table
                    }
                    const tHead = table.childNodes[0]
                    const filterHeaders = {
                        nodeName: "TR",
                        attributes: {
                            class: "search-filtering-row"
                        },
                        childNodes: tHead.childNodes[0].childNodes.map(
                            (_th, index) => ({
                                nodeName: "TH",
                                childNodes: [{
                                    nodeName: "INPUT",
                                    attributes: {
                                        class: "datatable-input",
                                        type: "search",
                                        "data-columns": "[" + index + "]"
                                    }
                                }]
                            })
                        )
                    }
                    tHead.childNodes.push(filterHeaders)
                    return table
                }
            });
        }
    </script>
</x-layout-dashboard>
