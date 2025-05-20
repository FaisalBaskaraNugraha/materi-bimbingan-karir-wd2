<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg" <section>
                <header class="flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Daftar Obat') }}
                    </h2>

                    <div class="flex-col items-center justify-center text-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#createObatModal">Tambah Obat</button>

                        @if (session('status') === 'obat-created')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600">{{ __('Created.') }}</p>
                        @endif
                    </div>

                    {{-- Modal --}}
                    <div class="modal fade bd-example-modal-lg" id="createObatModal" tabindex="-1" role="dialog"
                        aria-labelledby="detailModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-bold" id="riwayatModalLabel">
                                        Tambah Obat
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <form id="formObat" action="{{ route('dokter.obat.store') }}" method="POST">
                                        @csrf

                                        <div class="mb-3 form-group">
                                            <label for="namaObat">Nama Obat</label>
                                            <input type="text" class="rounded form-control" id="namaObat"
                                                name="nama_obat">
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label for="kemasan">Kemasan</label>
                                            <input type="text" class="rounded form-control" id="kemasan"
                                                name="kemasan">
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label for="harga">Harga</label>
                                            <input type="text" class="rounded form-control" id="harga"
                                                name="harga">
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Tutup
                                    </button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="document.getElementById('formObat').submit();" data-dismiss="modal">
                                        Simpans
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <table class="table mt-6 overflow-hidden rounded table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Obat</th>
                            <th scope="col">Kemasan</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obats as $obat)
                            <tr>
                                <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                <td class="align-middle text-start">{{ $obat->nama_obat }}</td>
                                <td class="align-middle text-start">{{ $obat->kemasan }}</td>
                                <td class="align-middle text-start">
                                    {{ 'Rp' . number_format($obat->harga, 0, ',', '.') }}
                                </td>
                                <td class="flex gap-3 align-middle text-start">
                                    {{-- Button Edit --}}
                                    <button type="submit" class="btn btn-secondary btn-sm" data-toggle="modal"
                                        data-target="#editObatModal{{ $obat->id }}">Edit</button>

                                    {{-- Modal Edit --}}
                                    <div class="modal fade bd-example-modal-lg" id="editObatModal{{ $obat->id }}"
                                        tabindex="-1" role="dialog"
                                        aria-labelledby="editModalTitle{{ $obat->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-bold"
                                                        id="editModalLabel{{ $obat->id }}">
                                                        Edit Data Obat
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <form id="formEdit{{ $obat->id }}"
                                                        action="{{ route('dokter.obat.update', $obat->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')

                                                        <div class="mb-3 form-group">
                                                            <label
                                                                for="editNamaObatInput{{ $obat->id }}">Nama</label>
                                                            <input type="text" class="rounded form-control"
                                                                id="editNamaObatInput{{ $obat->id }}"
                                                                value="{{ $obat->nama_obat }}" name="nama_obat">
                                                        </div>

                                                        <div class="mb-3 form-group">
                                                            <label
                                                                for="editKemasanInput{{ $obat->id }}">Kemasan</label>
                                                            <input type="text" class="rounded form-control"
                                                                id="editKemasanInput{{ $obat->id }}"
                                                                value="{{ $obat->kemasan }}" name="kemasan">
                                                        </div>

                                                        <div class="mb-3 form-group">
                                                            <label
                                                                for="editHargaInput{{ $obat->id }}">Harga</label>
                                                            <input type="text" class="rounded form-control"
                                                                id="editHargaInput{{ $obat->id }}"
                                                                value="{{ $obat->harga }}" name="harga">
                                                        </div>
                                                    </form>
                                                </div>

                                                <!-- Modal Footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">
                                                        Tutup
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="document.getElementById('formEdit{{ $obat->id }}').submit();">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Button Delete --}}
                                    <form action="{{ route('dokter.obat.destroy', $obat->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </section>
            </div>
        </div>
</x-app-layout>
