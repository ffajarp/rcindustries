<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->nama_pemesan }}</title>
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
            height: 297mm;
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
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .meta-info {
            font-size: 11px;
            line-height: 1.8;
        }

        .meta-info strong {
            font-weight: 600;
        }

        /* Customer Section */
        .customer-section {
            margin-bottom: 30px;
        }

        .section-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #666666;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .customer-name {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .customer-details {
            font-size: 12px;
            color: #333333;
            line-height: 1.6;
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
            padding: 12px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .invoice-table thead th:last-child {
            text-align: right;
        }

        .invoice-table tbody td {
            padding: 15px 12px;
            font-size: 12px;
            border-bottom: 1px solid #e0e0e0;
        }

        .invoice-table tbody td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .invoice-table tbody tr:last-child td {
            border-bottom: 2px solid #000000;
        }

        /* Summary */
        .invoice-summary {
            margin-left: auto;
            width: 300px;
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
                height: 297mm;
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
                <div class="meta-info">
                    <div><strong>NO:</strong> #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                    <div><strong>TANGGAL:</strong> {{ $order->created_at->format('d/m/Y') }}</div>
                </div>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="customer-section">
            <div class="section-label">Kepada</div>
            <div class="customer-name">{{ $order->nama_pemesan }}</div>
            <div class="customer-details">
                <div>{{ $order->telepon }}</div>
                @if($order->brand)
                    <div>Brand: {{ $order->brand }}</div>
                @endif
            </div>
        </div>

        <!-- Table -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th style="width: 15%; text-align: center;">Jumlah</th>
                    <th style="width: 20%; text-align: right;">Harga</th>
                    <th style="width: 20%; text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $order->jenisOrder->nama ?? '-' }}</strong>
                        @if($order->estimasi_selesai)
                            <br><small style="color: #666;">Target Selesai: {{ \Carbon\Carbon::parse($order->estimasi_selesai)->format('d/m/Y') }}</small>
                        @endif
                    </td>
                    <td style="text-align: center;">{{ number_format($order->jumlah, 0, ',', '.') }} pcs</td>
                    <td style="text-align: right;">Rp {{ number_format($order->harga_jual, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Summary -->
        <div class="invoice-summary">
            <div class="summary-row">
                <span>Subtotal</span>
                <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row total">
                <span>TOTAL</span>
                <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
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
