<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderRevision;
use App\Models\JenisOrder;
use App\Models\HargaHpp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['jenisOrder', 'revisions']);

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter status pembayaran
        if ($request->filled('status_pembayaran')) {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }

        // Filter jenis order
        if ($request->filled('jenis_order_id')) {
            $query->where('jenis_order_id', $request->jenis_order_id);
        }

        // Filter tanggal PO masuk
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('created_at', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('created_at', '<=', $request->tanggal_sampai);
        }

        // Filter tanggal selesai
        if ($request->filled('tanggal_selesai_dari')) {
            $query->whereDate('tanggal_selesai', '>=', $request->tanggal_selesai_dari);
        }

        if ($request->filled('tanggal_selesai_sampai')) {
            $query->whereDate('tanggal_selesai', '<=', $request->tanggal_selesai_sampai);
        }

        // Filter nama pemesan atau brand
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_pemesan', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%');
            });
        }

        $orders = $query->latest()->paginate(15);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $jenisOrders = JenisOrder::all();
        $hargaHpps = HargaHpp::all();
        
        return view('orders.create', compact('jenisOrders', 'hargaHpps'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|min:3|max:255',
            'telepon' => 'required|numeric|digits_between:10,16',
            'brand' => 'nullable|string|max:255',
            'gambar_design' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'jenis_order_id' => 'required|exists:jenis_orders,id',
            'jumlah' => 'required|integer|min:1|max:999999',
            'harga_jual' => 'required|numeric|min:0|max:9999999999',
            'estimasi_selesai' => 'nullable|date',
            'notes' => 'nullable|string',
            'status_pembayaran' => 'required|in:lunas,dp',
            'jumlah_dp' => 'nullable|required_if:status_pembayaran,dp|numeric|min:0',
            'makloon_items' => 'nullable|array',
            'makloon_items.*' => 'exists:harga_hpps,id'
        ], [
            'nama_pemesan.required' => 'Nama pemesan wajib diisi',
            'nama_pemesan.min' => 'Nama pemesan minimal 3 karakter',
            'telepon.required' => 'Nomor telepon wajib diisi',
            'telepon.numeric' => 'Nomor telepon hanya boleh angka',
            'telepon.digits_between' => 'Nomor telepon harus 10-16 digit',
            'gambar_design.image' => 'File harus berupa gambar',
            'gambar_design.mimes' => 'Format gambar harus jpeg, jpg, atau png',
            'gambar_design.max' => 'Ukuran gambar maksimal 5MB',
            'jenis_order_id.required' => 'Jenis order wajib dipilih',
            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.min' => 'Jumlah minimal 1',
            'jumlah.max' => 'Jumlah maksimal 999999',
            'harga_jual.required' => 'Harga jual wajib diisi',
            'harga_jual.min' => 'Harga jual tidak boleh negatif',
            'status_pembayaran.required' => 'Status pembayaran wajib dipilih',
            'jumlah_dp.required_if' => 'Jumlah DP wajib diisi jika pembayaran DP',
        ]);

        // Convert 0 di awal nomor telepon jadi 62
        if (substr($validated['telepon'], 0, 1) === '0') {
            $validated['telepon'] = '62' . substr($validated['telepon'], 1);
        }

        // Generate nomor PO
        $validated['no_po'] = Order::generateNoPO();

        // Upload gambar design jika ada
        if ($request->hasFile('gambar_design')) {
            $validated['gambar_design'] = $request->file('gambar_design')->store('order-designs', 'public');
        }

        // Hitung total harga
        $total_harga = $validated['jumlah'] * $validated['harga_jual'];

        // Hitung total HPP
        $total_hpp = 0;
        if (!empty($validated['makloon_items'])) {
            $hpps = HargaHpp::whereIn('id', $validated['makloon_items'])->get();
            foreach ($hpps as $hpp) {
                $total_hpp += $hpp->harga * $validated['jumlah'];
            }
        }

        // Hitung laba bersih
        $laba_bersih = $total_harga - $total_hpp;

        $validated['total_harga'] = $total_harga;
        $validated['total_hpp'] = $total_hpp;
        $validated['laba_bersih'] = $laba_bersih;
        $validated['status'] = 0;

        // Hitung sisa pembayaran jika DP
        if ($validated['status_pembayaran'] === 'dp') {
            $validated['sisa_pembayaran'] = $total_harga - ($validated['jumlah_dp'] ?? 0);
        } else {
            $validated['jumlah_dp'] = null;
            $validated['sisa_pembayaran'] = null;
        }

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan dengan No. PO: ' . $validated['no_po']);
    }

    public function show(Order $order)
    {
        $order->load(['jenisOrder', 'revisions.user']);
        
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $jenisOrders = JenisOrder::all();
        $hargaHpps = HargaHpp::all();
        
        return view('orders.edit', compact('order', 'jenisOrders', 'hargaHpps'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|min:3|max:255',
            'telepon' => 'required|numeric|digits_between:10,16',
            'brand' => 'nullable|string|max:255',
            'gambar_design' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'jenis_order_id' => 'required|exists:jenis_orders,id',
            'jumlah' => 'required|integer|min:1|max:999999',
            'harga_jual' => 'required|numeric|min:0|max:9999999999',
            'estimasi_selesai' => 'nullable|date',
            'notes' => 'nullable|string',
            'status_pembayaran' => 'required|in:lunas,dp',
            'jumlah_dp' => 'nullable|required_if:status_pembayaran,dp|numeric|min:0',
            'makloon_items' => 'nullable|array',
            'makloon_items.*' => 'exists:harga_hpps,id'
        ], [
            'nama_pemesan.required' => 'Nama pemesan wajib diisi',
            'nama_pemesan.min' => 'Nama pemesan minimal 3 karakter',
            'telepon.required' => 'Nomor telepon wajib diisi',
            'telepon.numeric' => 'Nomor telepon hanya boleh angka',
            'telepon.digits_between' => 'Nomor telepon harus 10-16 digit',
            'gambar_design.image' => 'File harus berupa gambar',
            'gambar_design.mimes' => 'Format gambar harus jpeg, jpg, atau png',
            'gambar_design.max' => 'Ukuran gambar maksimal 5MB',
            'jenis_order_id.required' => 'Jenis order wajib dipilih',
            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.min' => 'Jumlah minimal 1',
            'jumlah.max' => 'Jumlah maksimal 999999',
            'harga_jual.required' => 'Harga jual wajib diisi',
            'harga_jual.min' => 'Harga jual tidak boleh negatif',
            'status_pembayaran.required' => 'Status pembayaran wajib dipilih',
            'jumlah_dp.required_if' => 'Jumlah DP wajib diisi jika pembayaran DP',
        ]);

        // Convert 0 di awal nomor telepon jadi 62
        if (substr($validated['telepon'], 0, 1) === '0') {
            $validated['telepon'] = '62' . substr($validated['telepon'], 1);
        }

        // Upload gambar design jika ada
        if ($request->hasFile('gambar_design')) {
            // Hapus gambar lama jika ada
            if ($order->gambar_design && Storage::disk('public')->exists($order->gambar_design)) {
                Storage::disk('public')->delete($order->gambar_design);
            }
            $validated['gambar_design'] = $request->file('gambar_design')->store('order-designs', 'public');
        }

        // Hitung total harga
        $total_harga = $validated['jumlah'] * $validated['harga_jual'];

        // Hitung total HPP
        $total_hpp = 0;
        if (!empty($validated['makloon_items'])) {
            $hpps = HargaHpp::whereIn('id', $validated['makloon_items'])->get();
            foreach ($hpps as $hpp) {
                $total_hpp += $hpp->harga * $validated['jumlah'];
            }
        }

        // Hitung laba bersih
        $laba_bersih = $total_harga - $total_hpp;

        $validated['total_harga'] = $total_harga;
        $validated['total_hpp'] = $total_hpp;
        $validated['laba_bersih'] = $laba_bersih;

        // Hitung sisa pembayaran jika DP
        if ($validated['status_pembayaran'] === 'dp') {
            $validated['sisa_pembayaran'] = $total_harga - ($validated['jumlah_dp'] ?? 0);
        } else {
            $validated['jumlah_dp'] = null;
            $validated['sisa_pembayaran'] = null;
        }

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Order berhasil diperbarui');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        
        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus');
    }

    public function finish(Order $order)
    {
        $updateData = [
            'status' => 1,
            'tanggal_selesai' => now()
        ];

        // Jika pembayaran DP, ubah jadi Lunas
        if ($order->status_pembayaran === 'dp') {
            $updateData['status_pembayaran'] = 'lunas';
            $updateData['jumlah_dp'] = null;
            $updateData['sisa_pembayaran'] = null;
        }

        $order->update($updateData);

        return redirect()->route('orders.index')->with('success', 'PO berhasil diselesaikan' . ($order->status_pembayaran === 'dp' ? ' dan pembayaran telah lunas' : ''));
    }

    public function revise(Request $request, Order $order)
    {
        $request->validate([
            'keterangan' => 'required|string'
        ]);

        OrderRevision::create([
            'order_id' => $order->id,
            'keterangan' => $request->keterangan,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('orders.index')->with('success', 'Revisi berhasil ditambahkan');
    }

    public function invoice(Order $order)
    {
        $order->load(['jenisOrder', 'revisions.user']);
        
        return view('orders.invoice', compact('order'));
    }

    public function batchInvoice(Request $request)
    {
        $orderIds = $request->get('order_ids');
        
        if (empty($orderIds)) {
            return redirect()->back()->with('error', 'Pilih minimal 1 order untuk invoice gabungan');
        }
        
        // Pisah string jadi array jika perlu
        if (is_string($orderIds)) {
            $orderIds = explode(',', $orderIds);
        }
        
        $orders = Order::with(['jenisOrder'])
            ->whereIn('id', $orderIds)
            ->orderBy('created_at', 'asc')
            ->get();
        
        if ($orders->isEmpty()) {
            return redirect()->back()->with('error', 'Order tidak ditemukan');
        }
        
        // Hitung total keseluruhan
        $grandTotal = $orders->sum('total_harga');
        $grandTotalHpp = $orders->sum('total_hpp');
        $grandLabaBersih = $orders->sum('laba_bersih');
        
        return view('orders.batch-invoice', compact('orders', 'grandTotal', 'grandTotalHpp', 'grandLabaBersih'));
    }

    public function export(Request $request)
    {
        $query = Order::with(['jenisOrder']);

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('status_pembayaran')) {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }

        if ($request->filled('jenis_order_id')) {
            $query->where('jenis_order_id', $request->jenis_order_id);
        }

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('created_at', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('created_at', '<=', $request->tanggal_sampai);
        }

        if ($request->filled('tanggal_selesai_dari')) {
            $query->whereDate('tanggal_selesai', '>=', $request->tanggal_selesai_dari);
        }

        if ($request->filled('tanggal_selesai_sampai')) {
            $query->whereDate('tanggal_selesai', '<=', $request->tanggal_selesai_sampai);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_pemesan', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%');
            });
        }

        $orders = $query->latest()->get();

        $filename = 'orders_' . date('Y-m-d_His') . '.csv';
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Add BOM for Excel UTF-8
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // Header
        fputcsv($output, [
            'No',
            'No PO',
            'Tanggal PO',
            'Nama Pemesan',
            'Telepon',
            'Brand',
            'Jenis Order',
            'Jumlah',
            'Harga Jual',
            'Total Harga',
            'Status Pembayaran',
            'Jumlah DP',
            'Sisa Pembayaran',
            'Total HPP',
            'Laba Bersih',
            'Makloon',
            'Estimasi Selesai',
            'Status PO',
            'Tanggal Selesai',
            'Notes'
        ]);
        
        // Data
        foreach ($orders as $i => $order) {
            fputcsv($output, [
                $i + 1,
                $order->no_po ?? '-',
                $order->created_at->format('d/m/Y H:i'),
                $order->nama_pemesan,
                $order->telepon,
                $order->brand ?? '-',
                $order->jenisOrder->nama_jenis,
                $order->jumlah,
                $order->harga_jual,
                $order->total_harga,
                $order->status_pembayaran == 'lunas' ? 'Lunas' : 'DP',
                $order->jumlah_dp ?? 0,
                $order->sisa_pembayaran ?? 0,
                $order->total_hpp,
                $order->laba_bersih,
                $order->makloon_names,
                $order->estimasi_selesai ? $order->estimasi_selesai->format('d/m/Y') : '-',
                $order->status == 1 ? 'Selesai' : 'Berjalan',
                $order->tanggal_selesai ? $order->tanggal_selesai->format('d/m/Y H:i') : '-',
                $order->notes ?? '-'
            ]);
        }
        
        fclose($output);
        exit;
    }
}
