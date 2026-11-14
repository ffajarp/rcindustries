@extends('layouts.admin')

@section('title', 'Edit Order')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Data Order</a></li>
                    <li class="breadcrumb-item active">Edit Order</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Order</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.update', $order) }}" method="POST" id="orderForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Pemesan <span class="text-danger">*</span></label>
                                <input type="text" name="nama_pemesan" class="form-control @error('nama_pemesan') is-invalid @enderror" value="{{ old('nama_pemesan', $order->nama_pemesan) }}" required maxlength="255" minlength="3">
                                @error('nama_pemesan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">No. Telepon/WA <span class="text-danger">*</span></label>
                                <input type="tel" name="telepon" class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon', $order->telepon) }}" required placeholder="08xxxxxxxxxx" pattern="[0-9]{10,16}" title="Nomor telepon harus 10-16 digit angka">
                                @error('telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: 08xxxxxxxxxx (hanya angka, 10-16 digit)</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Brand</label>
                                <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand', $order->brand) }}" maxlength="255">
                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Upload Gambar Design</label>
                                <input type="file" name="gambar_design" class="form-control @error('gambar_design') is-invalid @enderror" accept="image/jpeg,image/jpg,image/png">
                                @error('gambar_design')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: JPG, JPEG, PNG. Max: 5MB</small>
                                @if($order->gambar_design)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($order->gambar_design) }}" alt="Design" style="max-width: 100px; max-height: 100px;" class="img-thumbnail">
                                        <small class="d-block text-muted">Gambar saat ini</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Makloon <span class="text-danger">*</span></label>
                                <select name="jenis_order_id" class="form-select @error('jenis_order_id') is-invalid @enderror" required>
                                    <option value="">Pilih Jenis Makloon</option>
                                    @foreach($jenisOrders as $jenis)
                                        <option value="{{ $jenis->id }}" {{ old('jenis_order_id', $order->jenis_order_id) == $jenis->id ? 'selected' : '' }}>
                                            {{ $jenis->nama_jenis }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_order_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Estimasi Selesai</label>
                                <input type="date" name="estimasi_selesai" class="form-control @error('estimasi_selesai') is-invalid @enderror" value="{{ old('estimasi_selesai', $order->estimasi_selesai?->format('Y-m-d')) }}">
                                @error('estimasi_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Opsional, bisa dikosongkan</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jumlah (pcs) <span class="text-danger">*</span></label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah', $order->jumlah) }}" min="1" max="999999" required>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Harga Jual (/pcs) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga_jual" id="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual', $order->harga_jual) }}" min="0" max="9999999999" step="1" required>
                                </div>
                                @error('harga_jual')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3" placeholder="Catatan tambahan tentang order ini (opsional)">{{ old('notes', $order->notes) }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">Makloon apa saja?</h5>
                    <p class="text-muted mb-3">Centang item HPP yang akan dihitung</p>

                    <div class="row">
                        @foreach($hargaHpps as $hpp)
                            <div class="col-md-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input makloon-checkbox" type="checkbox" name="makloon_items[]" value="{{ $hpp->id }}" id="hpp_{{ $hpp->id }}" data-harga="{{ $hpp->harga }}" {{ in_array($hpp->id, old('makloon_items', $order->makloon_items ?? [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="hpp_{{ $hpp->id }}">
                                        {{ $hpp->nama_hpp }} <span class="text-muted">(Rp {{ number_format($hpp->harga, 0, ',', '.') }}/pcs)</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr class="my-4">

                    <!-- Status Pembayaran -->
                    <h5 class="mb-3">Status Pembayaran</h5>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_pembayaran" id="pembayaran_lunas" value="lunas" {{ old('status_pembayaran', $order->status_pembayaran) == 'lunas' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="pembayaran_lunas">
                                        <strong>Lunas</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_pembayaran" id="pembayaran_dp" value="dp" {{ old('status_pembayaran', $order->status_pembayaran) == 'dp' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="pembayaran_dp">
                                        <strong>DP (Down Payment)</strong>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('status_pembayaran')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input DP -->
                    <div id="dp_section" style="display: none;">
                        <div class="card border-warning mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Jumlah DP <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" name="jumlah_dp" id="jumlah_dp" class="form-control @error('jumlah_dp') is-invalid @enderror" value="{{ old('jumlah_dp', $order->jumlah_dp) }}" min="0" step="1">
                                            </div>
                                            @error('jumlah_dp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Persentase DP</label>
                                            <input type="text" id="persentase_dp" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-info mb-0">
                                    <small>
                                        <strong>Sisa Pembayaran:</strong> <span id="sisa_pembayaran">Rp 0</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border">
                                <div class="card-body">
                                    <h6 class="text-muted mb-2">Total Harga</h6>
                                    <h4 class="mb-0" id="displayTotalHarga">Rp 0</h4>
                                    <small class="text-muted">Jumlah × Harga Jual</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border">
                                <div class="card-body">
                                    <h6 class="text-muted mb-2">Total HPP</h6>
                                    <h4 class="mb-0" id="displayTotalHpp">Rp 0</h4>
                                    <small class="text-muted">Total Makloon yang dipilih</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border border-success">
                                <div class="card-body">
                                    <h6 class="text-muted mb-2">Laba Bersih</h6>
                                    <h4 class="mb-0 text-success" id="displayLabaBersih">Rp 0</h4>
                                    <small class="text-muted">Total Harga - Total HPP</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy"></i> Update
                        </button>
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function formatRupiah(angka) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
    }

    function hitungTotal() {
        const jumlahInput = document.getElementById('jumlah');
        const hargaJualInput = document.getElementById('harga_jual');
        
        if (!jumlahInput || !hargaJualInput) {
            return;
        }
        
        const jumlah = parseFloat(jumlahInput.value) || 0;
        const hargaJual = parseFloat(hargaJualInput.value) || 0;
        
        // Hitung total harga
        const totalHarga = jumlah * hargaJual;
        document.getElementById('displayTotalHarga').textContent = formatRupiah(totalHarga);
        
        // Hitung total HPP
        let totalHpp = 0;
        const checkedBoxes = document.querySelectorAll('.makloon-checkbox:checked');
        
        checkedBoxes.forEach(checkbox => {
            const hargaHpp = parseFloat(checkbox.dataset.harga) || 0;
            totalHpp += (hargaHpp * jumlah);
        });
        document.getElementById('displayTotalHpp').textContent = formatRupiah(totalHpp);
        
        // Hitung laba bersih
        const labaBersih = totalHarga - totalHpp;
        document.getElementById('displayLabaBersih').textContent = formatRupiah(labaBersih);

        // Hitung DP
        hitungDP();
    }

    function hitungDP() {
        const jumlahInput = document.getElementById('jumlah');
        const hargaJualInput = document.getElementById('harga_jual');
        const jumlahDpInput = document.getElementById('jumlah_dp');
        const dpSection = document.getElementById('dp_section');

        if (dpSection.style.display === 'none') return;

        const jumlah = parseFloat(jumlahInput.value) || 0;
        const hargaJual = parseFloat(hargaJualInput.value) || 0;
        const totalHarga = jumlah * hargaJual;
        const jumlahDp = parseFloat(jumlahDpInput.value) || 0;

        // Hitung persentase
        const persentase = totalHarga > 0 ? (jumlahDp / totalHarga * 100).toFixed(2) : 0;
        document.getElementById('persentase_dp').value = persentase + '%';

        // Hitung sisa
        const sisa = totalHarga - jumlahDp;
        document.getElementById('sisa_pembayaran').textContent = formatRupiah(sisa);
    }

    // Event listeners
    const jumlahInput = document.getElementById('jumlah');
    const hargaJualInput = document.getElementById('harga_jual');
    const jumlahDpInput = document.getElementById('jumlah_dp');
    
    if (jumlahInput && hargaJualInput) {
        jumlahInput.addEventListener('input', hitungTotal);
        hargaJualInput.addEventListener('input', hitungTotal);
        
        if (jumlahDpInput) {
            jumlahDpInput.addEventListener('input', hitungDP);
        }
        
        document.querySelectorAll('.makloon-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', hitungTotal);
        });
        
        // Initial calculation
        hitungTotal();
    }

    // Handle show/hide DP section
    const radioLunas = document.getElementById('pembayaran_lunas');
    const radioDp = document.getElementById('pembayaran_dp');
    const dpSection = document.getElementById('dp_section');

    function toggleDPSection() {
        if (radioDp.checked) {
            dpSection.style.display = 'block';
            jumlahDpInput.required = true;
        } else {
            dpSection.style.display = 'none';
            jumlahDpInput.required = false;
        }
        hitungDP();
    }

    radioLunas.addEventListener('change', toggleDPSection);
    radioDp.addEventListener('change', toggleDPSection);

    // Check on load
    toggleDPSection();
});
</script>
@endpush
@endsection
