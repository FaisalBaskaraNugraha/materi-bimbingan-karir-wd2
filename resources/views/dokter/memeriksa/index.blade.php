<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Memeriksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg" <section>
                <header class="flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Daftar Periksa Pasien') }}
                    </h2>
                </header>

                <table class="table mt-6 overflow-hidden rounded table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No Urut</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($janjiPeriksas as $janjiPeriksa)
                            <tr>
                                <th scope="row" class="align-middle text-start">{{ $janjiPeriksa->no_antrian }}</th>
                                <td class="align-middle text-start">{{ $janjiPeriksa->pasien->nama }}</td>
                                <td class="align-middle text-start">{{ $janjiPeriksa->keluhan }}</td>
                                <td class="align-middle text-start">
                                    @if (is_null($janjiPeriksa->periksa))
                                        <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#periksaPasienModal{{ $janjiPeriksa->id }}">Periksa</button>

                                        {{-- Modal --}}
                                        <div class="modal fade bd-example-modal-lg"
                                            id="periksaPasienModal{{ $janjiPeriksa->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="detailModalTitle{{ $janjiPeriksa->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold"
                                                            id="riwayatModalLabel{{ $janjiPeriksa->id }}">
                                                            Periksa Pasien
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <!-- Modal Body -->
                                                    <div class="modal-body">
                                                        <form id="formPeriksa{{ $janjiPeriksa->id }}"
                                                            action="{{ route('dokter.memeriksa.store', $janjiPeriksa->id) }}"
                                                            method="POST">
                                                            @csrf

                                                            <div class="mb-3 form-group">
                                                                <label
                                                                    for="namaInput{{ $janjiPeriksa->id }}">Nama</label>
                                                                <input type="text" class="rounded form-control"
                                                                    id="namaInput{{ $janjiPeriksa->id }}"
                                                                    value="{{ $janjiPeriksa->pasien->nama }}" readonly>
                                                            </div>

                                                            <div class="mb-3 form-group">
                                                                <label for="tgl_periksa{{ $janjiPeriksa->id }}">Tanggal
                                                                    Periksa</label>
                                                                <input type="datetime-local"
                                                                    class="rounded form-control"
                                                                    id="tgl_periksa{{ $janjiPeriksa->id }}"
                                                                    name="tgl_periksa" required>
                                                            </div>

                                                            <div class="mb-3 form-group">
                                                                <label
                                                                    for="catatan{{ $janjiPeriksa->id }}">Catatan</label>
                                                                <textarea class="rounded form-control" id="catatan{{ $janjiPeriksa->id }}" name="catatan" rows="3"
                                                                    placeholder="Catatan pemeriksaan"></textarea>
                                                            </div>

                                                            <div class="mb-3 form-group">
                                                                <label for="obat{{ $janjiPeriksa->id }}">Pilih
                                                                    Obat</label>
                                                                <select class="rounded form-control"
                                                                    id="obat{{ $janjiPeriksa->id }}" name="obat[]"
                                                                    multiple
                                                                    onchange="hitungBiaya{{ $janjiPeriksa->id }}()">
                                                                    @foreach ($obats as $obat)
                                                                        <option value="{{ $obat->id }}"
                                                                            data-harga="{{ $obat->harga }}">
                                                                            {{ $obat->nama_obat }} -
                                                                            {{ $obat->kemasan }} (Rp
                                                                            {{ number_format($obat->harga, 0, ',', '.') }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <small class="form-text text-muted">Tekan Ctrl (Windows)
                                                                    atau Command (Mac) untuk memilih lebih dari
                                                                    satu.</small>
                                                            </div>

                                                            <div class="mb-3 form-group">
                                                                <label for="biaya_periksa{{ $janjiPeriksa->id }}">Biaya
                                                                    Pemeriksaan
                                                                    (Rp)</label>
                                                                <input type="text" class="rounded form-control"
                                                                    id="biaya_periksa{{ $janjiPeriksa->id }}"
                                                                    name="biaya_periksa" value="150000" readonly>
                                                            </div>
                                                        </form>

                                                        <script>
                                                            function hitungBiaya{{ $janjiPeriksa->id }}() {
                                                                const baseBiaya = 150000;
                                                                let totalBiaya = baseBiaya;
                                                                const select = document.getElementById('obat{{ $janjiPeriksa->id }}');
                                                                const selectedOptions = Array.from(select.selectedOptions);

                                                                selectedOptions.forEach(option => {
                                                                    const harga = parseInt(option.getAttribute('data-harga')) || 0;
                                                                    totalBiaya += harga;
                                                                });

                                                                document.getElementById('biaya_periksa{{ $janjiPeriksa->id }}').value = totalBiaya;
                                                            }
                                                        </script>
                                                    </div>

                                                    <!-- Modal Footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                            Tutup
                                                        </button>
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="document.getElementById('formPeriksa{{ $janjiPeriksa->id }}').submit();">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <button type="submit" class="btn btn-secondary btn-sm" data-toggle="modal"
                                            data-target="#editPasienModal{{ $janjiPeriksa->id }}">Edit</button>

                                        {{-- Modal Edit --}}
                                        <div class="modal fade bd-example-modal-lg"
                                            id="editPasienModal{{ $janjiPeriksa->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="editModalTitle{{ $janjiPeriksa->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold"
                                                            id="editModalLabel{{ $janjiPeriksa->id }}">
                                                            Edit Pemeriksaan Pasien
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <!-- Modal Body -->
                                                    <div class="modal-body">
                                                        <form id="formEdit{{ $janjiPeriksa->id }}"
                                                            action="{{ route('dokter.memeriksa.update', $janjiPeriksa->periksa->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')

                                                            <div class="mb-3 form-group">
                                                                <label
                                                                    for="editNamaInput{{ $janjiPeriksa->id }}">Nama</label>
                                                                <input type="text" class="rounded form-control"
                                                                    id="editNamaInput{{ $janjiPeriksa->id }}"
                                                                    value="{{ $janjiPeriksa->pasien->nama }}"
                                                                    readonly>
                                                            </div>

                                                            <div class="mb-3 form-group">
                                                                <label
                                                                    for="edit_tgl_periksa{{ $janjiPeriksa->id }}">Tanggal
                                                                    Periksa</label>
                                                                <input type="datetime-local"
                                                                    class="rounded form-control"
                                                                    id="edit_tgl_periksa{{ $janjiPeriksa->id }}"
                                                                    name="tgl_periksa"
                                                                    value="{{ date('Y-m-d\TH:i', strtotime($janjiPeriksa->periksa->tgl_periksa)) }}"
                                                                    required>
                                                            </div>

                                                            <div class="mb-3 form-group">
                                                                <label
                                                                    for="edit_catatan{{ $janjiPeriksa->id }}">Catatan</label>
                                                                <textarea class="rounded form-control" id="edit_catatan{{ $janjiPeriksa->id }}" name="catatan" rows="3">{{ $janjiPeriksa->periksa->catatan }}</textarea>
                                                            </div>

                                                            <div class="mb-3 form-group">
                                                                <label for="edit_obat{{ $janjiPeriksa->id }}">Pilih
                                                                    Obat</label>
                                                                <select class="rounded form-control"
                                                                    id="edit_obat{{ $janjiPeriksa->id }}"
                                                                    name="obat[]" multiple
                                                                    onchange="hitungEditBiaya{{ $janjiPeriksa->id }}()">
                                                                    @foreach ($obats as $obat)
                                                                        <option value="{{ $obat->id }}"
                                                                            data-harga="{{ $obat->harga }}"
                                                                            {{ in_array($obat->id, $janjiPeriksa->periksa->detailPeriksas->pluck('id_obat')->toArray()) ? 'selected' : '' }}>
                                                                            {{ $obat->nama_obat }} -
                                                                            {{ $obat->kemasan }} (Rp
                                                                            {{ number_format($obat->harga, 0, ',', '.') }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <small class="form-text text-muted">Tekan Ctrl
                                                                    (Windows)
                                                                    atau Command (Mac) untuk memilih lebih dari
                                                                    satu.</small>
                                                            </div>

                                                            <div class="mb-3 form-group">
                                                                <label
                                                                    for="edit_biaya_periksa{{ $janjiPeriksa->id }}">Biaya
                                                                    Pemeriksaan (Rp)</label>
                                                                <input type="text" class="rounded form-control"
                                                                    id="edit_biaya_periksa{{ $janjiPeriksa->id }}"
                                                                    name="biaya_periksa"
                                                                    value="{{ $janjiPeriksa->periksa->biaya_periksa }}"
                                                                    readonly>
                                                            </div>
                                                        </form>

                                                        <script>
                                                            function hitungEditBiaya{{ $janjiPeriksa->id }}() {
                                                                const baseBiaya = 150000;
                                                                let totalBiaya = baseBiaya;
                                                                const select = document.getElementById('edit_obat{{ $janjiPeriksa->id }}');
                                                                const selectedOptions = Array.from(select.selectedOptions);

                                                                selectedOptions.forEach(option => {
                                                                    const harga = parseInt(option.getAttribute('data-harga')) || 0;
                                                                    totalBiaya += harga;
                                                                });

                                                                document.getElementById('edit_biaya_periksa{{ $janjiPeriksa->id }}').value = totalBiaya;
                                                            }

                                                            // Panggil fungsi perhitungan biaya saat halaman dimuat
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                // Panggil hanya jika modal edit ditampilkan
                                                                const editModal{{ $janjiPeriksa->id }} = document.getElementById(
                                                                    'editPasienModal{{ $janjiPeriksa->id }}');
                                                                if (editModal{{ $janjiPeriksa->id }}) {
                                                                    editModal{{ $janjiPeriksa->id }}.addEventListener('shown.bs.modal', function() {
                                                                        hitungEditBiaya{{ $janjiPeriksa->id }}();
                                                                    });
                                                                }
                                                            });
                                                        </script>
                                                    </div>

                                                    <!-- Modal Footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                            Tutup
                                                        </button>
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="document.getElementById('formEdit{{ $janjiPeriksa->id }}').submit();">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </section>
            </div>
        </div>
</x-app-layout>
