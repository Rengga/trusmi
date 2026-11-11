<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $kpiResult = DB::select("
            SELECT 
                karyawan,
                SUM(CASE WHEN kpi = 'Sales' THEN 1 ELSE 0 END) as total_sales,
                SUM(CASE WHEN kpi = 'Sales' AND (aktual IS NULL OR aktual > deadline) THEN 1 ELSE 0 END) as sales_late,
                SUM(CASE WHEN kpi = 'Report' THEN 1 ELSE 0 END) as total_report,
                SUM(CASE WHEN kpi = 'Report' AND (aktual IS NULL OR aktual > deadline) THEN 1 ELSE 0 END) as report_late,
                -- Perhitungan Bobot Sales (50% dikurangi 7% per late)
                CASE 
                    WHEN SUM(CASE WHEN kpi = 'Sales' THEN 1 ELSE 0 END) > 0 
                    THEN GREATEST(0, 50 - (SUM(CASE WHEN kpi = 'Sales' AND (aktual IS NULL OR aktual > deadline) THEN 1 ELSE 0 END) * 7))
                    ELSE 0 
                END as skor_sales,
                -- Perhitungan Bobot Report (50% dikurangi 7% per late)
                CASE 
                    WHEN SUM(CASE WHEN kpi = 'Report' THEN 1 ELSE 0 END) > 0 
                    THEN GREATEST(0, 50 - (SUM(CASE WHEN kpi = 'Report' AND (aktual IS NULL OR aktual > deadline) THEN 1 ELSE 0 END) * 7))
                    ELSE 0 
                END as skor_report
            FROM table_kpi_marketing
            GROUP BY karyawan
        ");

        
        $chartKpiLabels = array_column($kpiResult, 'karyawan');
        $chartKpiSales  = array_column($kpiResult, 'skor_sales');
        $chartKpiReport = array_column($kpiResult, 'skor_report');

    
        $taskStatusSummary = DB::select("
            SELECT 
                COUNT(*) as total_task,
                SUM(CASE WHEN aktual <= deadline THEN 1 ELSE 0 END) as total_ontime,
                SUM(CASE WHEN aktual > deadline OR aktual IS NULL THEN 1 ELSE 0 END) as total_late,
                ROUND((SUM(CASE WHEN aktual <= deadline THEN 1 ELSE 0 END) / COUNT(*)) * 100, 2) as persentase_ontime,
                ROUND((SUM(CASE WHEN aktual > deadline OR aktual IS NULL THEN 1 ELSE 0 END) / COUNT(*)) * 100, 2) as persentase_late
            FROM table_kpi_marketing
        ")[0];

        return view('dashboard', compact(
            'kpiResult', 
            'taskStatusSummary',
            'chartKpiLabels',
            'chartKpiSales',
            'chartKpiReport'
        ));
    }
}