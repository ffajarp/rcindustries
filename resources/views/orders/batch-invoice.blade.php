<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Gabungan - {{ count($orders) }} Order</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            background: #ffffff;
            padding: 0;
            line-height: 1.6;
            color: #000000;
        }

        .invoice-container {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: white;
            padding: 15mm;
            box-sizing: border-box;
        }

        /* Header */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #000000;
        }

        .company-info {
            flex: 1;
        }

        .company-logo {
            width: 60px;
            height: 60px;
            margin-bottom: 20px;
        }

        .company-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .company-name {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .company-details {
            font-size: 11px;
            line-height: 1.8;
            color: #333333;
        }

        .invoice-meta {
            text-align: right;
        }

        .invoice-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .invoice-subtitle {
            font-size: 12px;
            color: #666666;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .meta-info {
            font-size: 11px;
            line-height: 1.8;
        }

        .meta-info strong {
            font-weight: 600;
        }

        /* Info Badge */
        .info-badge {
            background: #f5f5f5;
            border-left: 3px solid #000000;
            padding: 15px 20px;
            margin-bottom: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Section */
        .section-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #666666;
            margin-bottom: 15px;
            font-weight: 600;
        }

        /* Table */
        .invoice-table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        .invoice-table thead th {
            background: #000000;
            color: #ffffff;
            padding: 12px 10px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .invoice-table thead th:nth-child(3),
        .invoice-table thead th:nth-child(4),
        .invoice-table thead th:nth-child(5) {
            text-align: right;
        }

        .invoice-table tbody td {
            padding: 12px 10px;
            font-size: 11px;
            border-bottom: 1px solid #e0e0e0;
            vertical-align: top;
        }

        .invoice-table tbody td:nth-child(3),
        .invoice-table tbody td:nth-child(4),
        .invoice-table tbody td:nth-child(5) {
            text-align: right;
        }

        .invoice-table tbody tr:last-child td {
            border-bottom: 2px solid #000000;
        }

        .customer-name {
            font-weight: 700;
        }

        .order-type {
            color: #666666;
            font-size: 10px;
            display: block;
            margin-top: 3px;
        }

        /* Summary */
        .invoice-summary {
            margin-left: auto;
            width: 350px;
            margin-bottom: 30px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 13px;
        }

        .summary-row.total {
            background: #000000;
            color: #ffffff;
            padding: 15px 20px;
            margin-top: 10px;
            font-weight: 700;
            font-size: 16px;
        }

        /* Bank Info */
        .bank-section {
            margin-bottom: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .bank-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }

        .bank-item {
            font-size: 11px;
            line-height: 1.8;
        }

        .bank-name {
            font-weight: 700;
            margin-bottom: 3px;
        }

        .bank-number {
            color: #333333;
        }

        /* Footer */
        .invoice-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            font-size: 11px;
            color: #666666;
        }

        /* Print Button */
        .print-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #000000;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            z-index: 1000;
        }

        .print-button:hover {
            background: #333333;
        }

        @media print {
            body {
                padding: 0;
                margin: 0;
            }

            .invoice-container {
                width: 210mm;
                min-height: 297mm;
                padding: 15mm;
                margin: 0;
            }

            .print-button {
                display: none;
            }

            @page {
                size: A4;
                margin: 0;
            }

            .invoice-table {
                page-break-inside: auto;
            }

            .invoice-table tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="company-info">
                <div class="company-logo">
                    <img src="{{ App\Helpers\CompanyHelper::getLogo() }}" alt="Logo">
                </div>
                <div class="company-name">{{ App\Helpers\CompanyHelper::getName() }}</div>
                <div class="company-details">
                    @php
                        $settings = App\Helpers\CompanyHelper::getSettings();
                    @endphp
                    @if($settings && $settings->alamat)
                        <div>{{ $settings->alamat }}</div>
                    @endif
                    @if($settings && $settings->telepon)
                        @php
                            $teleponArray = is_array($settings->telepon) 
                                ? $settings->telepon 
                                : json_decode($settings->telepon, true) ?? [];
                        @endphp
                        @if(count($teleponArray) > 0)
                            <div>{{ implode(' / ', $teleponArray) }}</div>
                        @endif
                    @endif
                </div>
            </div>
            
            <div class="invoice-meta">
                <div class="invoice-title">INVOICE</div>
                <div class="invoice-subtitle">Gabungan</div>
                <div class="meta-info">
                    <div><strong>TANGGAL:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
                    <div><strong>JUMLAH:</strong> {{ count($orders) }} Order</div>
                </div>
            </div>
        </div>

        <!-- Info Badge -->
        <div class="info-badge">
            Invoice ini berisi {{ count($orders) }} order yang digabungkan
        </div>

        <!-- Section Label -->
        <div class="section-label">Detail Order</div>

        <!-- Table -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th style="width: 15%">No PO</th>
                    <th style="width: 22%">Pemesan / Jenis</th>
                    <th style="width: 13%">Telepon</th>
                    <th style="width: 10%">Jumlah</th>
                    <th style="width: 18%">Harga</th>
                    <th style="width: 18%">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td><strong>{{ $order->no_po }}</strong></td>
                        <td>
                            <span class="customer-name">{{ $order->nama_pemesan }}</span>
                            <span class="order-type">{{ $order->jenisOrder->nama ?? '-' }}</span>
                            @if($order->brand)
                                <span class="order-type">Brand: {{ $order->brand }}</span>
                            @endif
                            @if($order->status_pembayaran == 'dp')
                                <span class="order-type" style="color: #ff9800;">DP: Rp {{ number_format($order->jumlah_dp, 0, ',', '.') }}</span>
                            @endif
                        </td>
                        <td>{{ $order->telepon }}</td>
                        <td>{{ number_format($order->jumlah, 0, ',', '.') }} pcs</td>
                        <td>Rp {{ number_format($order->harga_jual, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Summary -->
        <div class="invoice-summary">
            @php
                $totalItems = $orders->sum('jumlah');
                $subtotal = $orders->sum('total_harga');
            @endphp
            <div class="summary-row">
                <span>Total Item</span>
                <span>{{ number_format($totalItems, 0, ',', '.') }} pcs</span>
            </div>
            <div class="summary-row">
                <span>Subtotal</span>
                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row total">
                <span>TOTAL</span>
                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Bank Info -->
        @if($settings && $settings->rekening_bank)
            @php
                $rekeningArray = is_array($settings->rekening_bank) 
                    ? $settings->rekening_bank 
                    : json_decode($settings->rekening_bank, true) ?? [];
            @endphp
            @if(count($rekeningArray) > 0)
                <div class="bank-section">
                    <div class="section-label">Informasi Pembayaran</div>
                    <div class="bank-list">
                        @foreach($rekeningArray as $rekening)
                            <div class="bank-item">
                                <div class="bank-name">{{ $rekening }}</div>
                                <div class="bank-number">a.n. {{ App\Helpers\CompanyHelper::getName() }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif

        <!-- Footer -->
        <div class="invoice-footer">
            Terima kasih atas kepercayaan Anda
        </div>
    </div>

    <!-- Print Button -->
    <button onclick="window.print()" class="print-button">
        Print
    </button>
</body>
</html>
