@extends('layouts.admin')

@section('title', 'Data Order')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Order</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Data Order</h5>
                <div>
                    <a href="{{ route('orders.export') }}?{{ http_build_query(request()->except('page')) }}" class="btn btn-success">
                        <i class="ti ti-file-spreadsheet"></i> Export Excel
                    </a>
                    <a href="{{ route('orders.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Tambah Order
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Filter Form -->
                <div class="card mb-3 border">
                    <div class="card-body">
                        <form method="GET" action="{{ route('orders.index') }}" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Status PO</label>
                                <select name="status" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Berjalan</option>
                                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Status Pembayaran</label>
                                <select name="status_pembayaran" class="form-select">
                                    <option value="">Semua Pembayaran</option>
                                    <option value="lunas" {{ request('status_pembayaran') === 'lunas' ? 'selected' : '' }}>Lunas</option>
                                    <option value="dp" {{ request('status_pembayaran') === 'dp' ? 'selected' : '' }}>DP</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Jenis Order</label>
                                <select name="jenis_order_id" class="form-select">
                                    <option value="">Semua Jenis</option>
                                    @foreach(\App\Models\JenisOrder::all() as $jenis)
                                        <option value="{{ $jenis->id }}" {{ request('jenis_order_id') == $jenis->id ? 'selected' : '' }}>
                                            {{ $jenis->nama_jenis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Cari (Nama / Brand)</label>
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Cari nama pemesan atau brand...">
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Filter Tanggal PO Masuk</label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Dari Tanggal</label>
                                <input type="date" name="tanggal_dari" class="form-control" value="{{ request('tanggal_dari') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" name="tanggal_sampai" class="form-control" value="{{ request('tanggal_sampai') }}">
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Filter Tanggal PO Selesai</label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Dari Tanggal</label>
                                <input type="date" name="tanggal_selesai_dari" class="form-control" value="{{ request('tanggal_selesai_dari') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" name="tanggal_selesai_sampai" class="form-control" value="{{ request('tanggal_selesai_sampai') }}">
                            </div>
                            
                            <div class="col-md-12 d-flex align-items-end gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-filter"></i> Filter
                                </button>
                                <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                                    <i class="ti ti-refresh"></i> Reset
                                </a>
                                <button type="button" class="btn btn-info ms-auto" onclick="batchInvoice()" id="batchInvoiceBtn" style="display:none;">
                                    <i class="ti ti-files"></i> Invoice Gabungan (<span id="selectedCount">0</span>)
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll"></th>
                                <th>No PO</th>
                                <th>Tanggal</th>
                                <th>Customer</th>
                                <th>Jenis Order</th>
                                <th>Total Harga</th>
                                <th>Status Bayar</th>
                                <th>Status PO</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td><input type="checkbox" class="order-checkbox" value="{{ $order->id }}" data-customer="{{ $order->nama_pemesan }}"></td>
                                    <td><strong>{{ $order->no_po ?? 'N/A' }}</strong></td>
                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div><strong>{{ $order->nama_pemesan }}</strong></div>
                                        <small class="text-muted">{{ $order->telepon }}</small>
                                    </td>
                                    <td>{{ $order->jenisOrder->nama_jenis }}</td>
                                    <td>
                                        <strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong>
                                        <br><small class="text-muted">{{ number_format($order->jumlah) }} pcs</small>
                                    </td>
                                    <td>
                                        @if($order->status_pembayaran == 'lunas')
                                            <span class="badge bg-success">Lunas</span>
                                        @else
                                            <span class="badge bg-warning">DP</span>
                                            <br><small class="text-muted">Rp {{ number_format($order->jumlah_dp ?? 0, 0, ',', '.') }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->status == 1)
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-warning">Berjalan</span>
                                            @if($order->isNearDeadline())
                                                <br><span class="badge bg-danger mt-1"><i class="ti ti-alert-triangle"></i> H-1</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column gap-1">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('orders.show', $order) }}" class="btn btn-info" title="Detail">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning" title="Edit">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="{{ route('orders.invoice', $order) }}" class="btn btn-success" title="Cetak Invoice" target="_blank">
                                                    <i class="ti ti-printer"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="https://wa.me/{{ $order->telepon }}?text={{ urlencode(\App\Helpers\CompanyHelper::getWhatsAppMessage($order)) }}" class="btn btn-success" title="Kirim WA" target="_blank">
                                                    <i class="ti ti-brand-whatsapp"></i>
                                                </a>
                                                @if($order->status == 0)
                                                    <button type="button" class="btn btn-primary" title="Selesaikan PO" onclick="finishOrder({{ $order->id }})">
                                                        <i class="ti ti-check"></i>
                                                    </button>
                                                @endif
                                                <button type="button" class="btn btn-secondary" title="Revisi" onclick="reviseOrder({{ $order->id }})">
                                                    <i class="ti ti-file-text"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data order</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Finish Order -->
<div class="modal fade" id="finishModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="finishForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title">Selesaikan PO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menyelesaikan PO ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ya, Selesaikan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Revisi -->
<div class="modal fade" id="revisiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="revisiForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Revisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Keterangan Revisi <span class="text-danger">*</span></label>
                        <textarea name="keterangan" class="form-control" rows="4" required placeholder="Jelaskan detail revisi yang diperlukan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Revisi</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function finishOrder(orderId) {
    const form = document.getElementById('finishForm');
    form.action = `/admin/orders/${orderId}/finish`;
    new bootstrap.Modal(document.getElementById('finishModal')).show();
}

function reviseOrder(orderId) {
    const form = document.getElementById('revisiForm');
    form.action = `/admin/orders/${orderId}/revise`;
    new bootstrap.Modal(document.getElementById('revisiModal')).show();
}

// Batch Invoice
let selectedOrders = [];

document.addEventListener('DOMContentLoaded', function() {
    // Select All
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.order-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = this.checked;
        });
        updateBatchButton();
    });
    
    // Individual checkbox
    document.querySelectorAll('.order-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateBatchButton);
    });
});

function updateBatchButton() {
    const checkboxes = document.querySelectorAll('.order-checkbox:checked');
    selectedOrders = Array.from(checkboxes).map(cb => cb.value);
    
    const btn = document.getElementById('batchInvoiceBtn');
    const countSpan = document.getElementById('selectedCount');
    
    if (selectedOrders.length > 0) {
        countSpan.textContent = selectedOrders.length;
        btn.style.display = 'inline-block';
    } else {
        btn.style.display = 'none';
    }
}

function batchInvoice() {
    if (selectedOrders.length === 0) {
        alert('Pilih minimal 1 order');
        return;
    }
    
    const url = '{{ route("orders.batch-invoice") }}?order_ids=' + selectedOrders.join(',');
    window.open(url, '_blank');
}
</script>
@endpush

@push('styles')
<style>
/* Custom scrollbar untuk kolom makloon */
.table td > div[style*="overflow-y"] {
    scrollbar-width: thin;
    scrollbar-color: #888 #f1f1f1;
}

.table td > div[style*="overflow-y"]::-webkit-scrollbar {
    width: 6px;
}

.table td > div[style*="overflow-y"]::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.table td > div[style*="overflow-y"]::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.table td > div[style*="overflow-y"]::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
@endpush
@endsection
