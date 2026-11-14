@extends('layouts.admin')

@section('title', 'Detail Order')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Data Order</a></li>
                    <li class="breadcrumb-item active">Detail Order</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Detail Order</h5>
                <div>
                    <a href="{{ route('orders.invoice', $order) }}" class="btn btn-success" target="_blank">
                        <i class="ti ti-printer"></i> Cetak Invoice
                    </a>
                    <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning">
                        <i class="ti ti-edit"></i> Edit
                    </a>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="200"><strong>No PO</strong></td>
                                <td>: <span class="badge bg-dark">{{ $order->no_po }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal PO</strong></td>
                                <td>: {{ $order->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Pemesan</strong></td>
                                <td>: {{ $order->nama_pemesan }}</td>
                            </tr>
                            <tr>
                                <td><strong>Telepon/WA</strong></td>
                                <td>: {{ $order->telepon }}</td>
                            </tr>
                            <tr>
                                <td><strong>Brand</strong></td>
                                <td>: {{ $order->brand ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Makloon</strong></td>
                                <td>: {{ $order->jenisOrder->nama_jenis }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jumlah</strong></td>
                                <td>: {{ number_format($order->jumlah) }} pcs</td>
                            </tr>
                            <tr>
                                <td><strong>Harga Jual (/pcs)</strong></td>
                                <td>: Rp {{ number_format($order->harga_jual, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="200"><strong>Estimasi Selesai</strong></td>
                                <td>: {{ $order->estimasi_selesai ? $order->estimasi_selesai->format('d/m/Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status PO</strong></td>
                                <td>: 
                                    @if($order->status == 1)
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-warning">Berjalan</span>
                                    @endif
                                </td>
                            </tr>
                            @if($order->tanggal_selesai)
                            <tr>
                                <td><strong>Tanggal Selesai</strong></td>
                                <td>: {{ $order->tanggal_selesai->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td><strong>Status Pembayaran</strong></td>
                                <td>: 
                                    @if($order->status_pembayaran == 'lunas')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-warning">DP</span>
                                    @endif
                                </td>
                            </tr>
                            @if($order->status_pembayaran == 'dp' && $order->jumlah_dp)
                            <tr>
                                <td><strong>Jumlah DP</strong></td>
                                <td>: Rp {{ number_format($order->jumlah_dp, 0, ',', '.') }} 
                                    <small class="text-muted">({{ number_format(($order->jumlah_dp / $order->total_harga) * 100, 2) }}%)</small>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Sisa Pembayaran</strong></td>
                                <td>: Rp {{ number_format($order->sisa_pembayaran, 0, ',', '.') }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td><strong>Notifikasi</strong></td>
                                <td>: 
                                    @if($order->isNearDeadline())
                                        <span class="badge bg-danger">
                                            <i class="ti ti-alert-triangle"></i> H-1 Deadline! Segera follow up ke bagian produksi
                                        </span>
                                    @else
                                        <span class="badge bg-light text-dark">Normal</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($order->gambar_design)
                <hr class="my-4">
                <h5 class="mb-3">Gambar Design</h5>
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ Storage::url($order->gambar_design) }}" alt="Design" class="img-fluid rounded border" style="max-height: 300px; object-fit: contain;">
                    </div>
                </div>
                @endif

                @if($order->notes)
                <hr class="my-4">
                <h5 class="mb-3">Catatan</h5>
                <div class="alert alert-light border">
                    {{ $order->notes }}
                </div>
                @endif

                <hr class="my-4">

                <h5 class="mb-3">Detail Makloon</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Item HPP</th>
                                <th class="text-end">Harga (/pcs)</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($order->makloon_items))
                                @php
                                    $hpps = \App\Models\HargaHpp::whereIn('id', $order->makloon_items)->get();
                                @endphp
                                @foreach($hpps as $hpp)
                                <tr>
                                    <td>{{ $hpp->nama_hpp }}</td>
                                    <td class="text-end">Rp {{ number_format($hpp->harga, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ number_format($order->jumlah) }} pcs</td>
                                    <td class="text-end">Rp {{ number_format($hpp->harga * $order->jumlah, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada makloon yang dipilih</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <hr class="my-4">

                <div class="row">
                    <div class="col-md-4">
                        <div class="card border">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Total Harga</h6>
                                <h4 class="mb-0">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</h4>
                                <small class="text-muted">{{ number_format($order->jumlah) }} × Rp {{ number_format($order->harga_jual, 0, ',', '.') }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Total HPP</h6>
                                <h4 class="mb-0">Rp {{ number_format($order->total_hpp, 0, ',', '.') }}</h4>
                                <small class="text-muted">Total biaya makloon</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border border-success">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Laba Bersih</h6>
                                <h4 class="mb-0 text-success">Rp {{ number_format($order->laba_bersih, 0, ',', '.') }}</h4>
                                <small class="text-muted">Total Harga - Total HPP</small>
                            </div>
                        </div>
                    </div>
                </div>

                @if($order->revisions->count() > 0)
                <hr class="my-4">

                <h5 class="mb-3">Riwayat Revisi</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="200">Tanggal</th>
                                <th width="200">Oleh</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->revisions as $revision)
                            <tr>
                                <td>{{ $revision->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $revision->user->nama }}</td>
                                <td>{{ $revision->keterangan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
