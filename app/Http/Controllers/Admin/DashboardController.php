<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan data penjualan
     */
    public function index(Request $request)
    {
        // Filter periode (default: bulan)
        $filter = $request->get('filter', 'bulan');
        
        // Hitung data statistik
        $data = [
            'po_masuk' => Order::count(),           // Total PO yang masuk
            'po_selesai' => Order::where('status', 1)->count(),         // Total PO yang sudah selesai
            'total_pemasukan' => Order::sum('total_harga'),  // Total pemasukan
            'total_hpp' => Order::sum('total_hpp'),         // Total HPP
            'laba_bersih' => Order::sum('laba_bersih'),       // Laba bersih
        ];
        
        // Hitung persentase PO selesai
        $data['persentase'] = $data['po_masuk'] > 0 
            ? round(($data['po_selesai'] / $data['po_masuk']) * 100, 2) 
            : 0;
        
        // Data grafik berdasarkan filter
        $chartData = $this->getChartData($filter);
        
        return view('admin.dashboard', compact('data', 'chartData', 'filter'));
    }
    
    /**
     * Generate data grafik berdasarkan filter
     */
    private function getChartData($filter)
    {
        switch ($filter) {
            case 'hari':
                // Data 7 hari terakhir
                $startDate = Carbon::now()->subDays(6)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                
                $orders = Order::whereBetween('created_at', [$startDate, $endDate])
                    ->select(
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('SUM(total_harga) as total')
                    )
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get()
                    ->keyBy('date');
                
                $labels = [];
                $data = [];
                
                for ($i = 6; $i >= 0; $i--) {
                    $date = Carbon::now()->subDays($i);
                    $labels[] = $date->format('D'); // Mon, Tue, Wed
                    $dateKey = $date->format('Y-m-d');
                    $data[] = isset($orders[$dateKey]) ? (float)$orders[$dateKey]->total : 0;
                }
                
                return [
                    'labels' => $labels,
                    'data' => $data,
                ];
            
            case 'minggu':
                // Data 4 minggu terakhir
                $labels = [];
                $data = [];
                
                for ($i = 3; $i >= 0; $i--) {
                    $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
                    $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
                    
                    $labels[] = 'Minggu ' . (4 - $i);
                    
                    $total = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                        ->sum('total_harga');
                    
                    $data[] = (float)$total;
                }
                
                return [
                    'labels' => $labels,
                    'data' => $data,
                ];
            
            case 'bulan':
            default:
                // Data 12 bulan terakhir
                $startDate = Carbon::now()->subMonths(11)->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                
                $orders = Order::whereBetween('created_at', [$startDate, $endDate])
                    ->select(
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('MONTH(created_at) as month'),
                        DB::raw('SUM(total_harga) as total')
                    )
                    ->groupBy('year', 'month')
                    ->orderBy('year')
                    ->orderBy('month')
                    ->get()
                    ->mapWithKeys(function($item) {
                        return [$item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT) => $item->total];
                    });
                
                $labels = [];
                $data = [];
                
                for ($i = 11; $i >= 0; $i--) {
                    $date = Carbon::now()->subMonths($i);
                    $labels[] = $date->format('M'); // Jan, Feb, Mar
                    $monthKey = $date->format('Y-m');
                    $data[] = isset($orders[$monthKey]) ? (float)$orders[$monthKey] : 0;
                }
                
                return [
                    'labels' => $labels,
                    'data' => $data,
                ];
        }
    }
}
