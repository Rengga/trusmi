<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Detail KPI Marketing - Trumi Group</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .chart-container { position: relative; height: 320px; width: 100%; }
        .icon-box { width: 40px; height: 40px; }
    </style>
</head>
<body class="bg-light text-dark">

    <div class="min-vh-100 d-flex flex-column">
        <header class="bg-white border-bottom sticky-top shadow-sm py-3">
            <div class="container-fluid max-w-7xl px-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box bg-primary text-white rounded-3 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-chart-pie fs-5"></i>
                    </div>
                    <div>
                        <h1 class="h5 fw-bold text-dark mb-0">Dashboard Detail KPI & Tasklist</h1>
                        <small class="text-muted">Trumi Group - Evaluasi Kinerja Marketing Per Orang</small>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-grow-1 container-fluid w-75 px-4 py-4">
            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                        <div class="mb-3">
                            <span class="badge bg-primary-subtle text-primary fw-bold rounded-pill px-3 py-2">Soal 3 (Detail Per Orang)</span>
                            <h2 class="h5 fw-bold text-dark mt-2 mb-1">Komparasi Skor KPI Karyawan</h2>
                            <p class="small text-muted mb-0">Rincian pencapaian skor Sales, Report, dan Total per individu</p>
                        </div>
                        <div class="chart-container">
                            <canvas id="kpiDetailChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                        <div class="mb-3">
                            <span class="badge bg-success-subtle text-success fw-bold rounded-pill px-3 py-2">Soal 4 (Detail Per Orang)</span>
                            <h2 class="h5 fw-bold text-dark mt-2 mb-1">Rasio Tasklist Ontime vs Late</h2>
                            <p class="small text-muted mb-0">Distribusi ketepatan waktu deadline tasklist masing-masing karyawan</p>
                        </div>
                        <div class="chart-container">
                            <canvas id="taskDetailChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-bottom p-4">
                    <h3 class="h5 fw-bold text-dark mb-1">Tabel Rekapitulasi Data KPI Marketing</h3>
                    <p class="small text-muted mb-0">Sumber data yang dipetakan ke dalam grafik interaktif di atas</p>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase small text-muted">
                            <tr>
                                <th class="px-4 py-3">Nama Karyawan</th>
                                <th class="text-center px-4 py-3">Total Sales Task</th>
                                <th class="text-center px-4 py-3">Sales Late</th>
                                <th class="text-center px-4 py-3">Skor Sales</th>
                                <th class="text-center px-4 py-3">Total Report Task</th>
                                <th class="text-center px-4 py-3">Report Late</th>
                                <th class="text-center px-4 py-3">Skor Report</th>
                                <th class="text-center px-4 py-3">Total Skor KPI</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @foreach($kpiResult as $row)
                            <tr>
                                <td class="px-4 py-3 fw-bold text-dark">{{ $row->karyawan }}</td>
                                <td class="text-center px-4 py-3">{{ $row->total_sales }}</td>
                                <td class="text-center px-4 py-3 text-danger fw-semibold">{{ $row->sales_late }}</td>
                                <td class="text-center px-4 py-3 text-primary fw-semibold">{{ $row->skor_sales }}%</td>
                                <td class="text-center px-4 py-3">{{ $row->total_report }}</td>
                                <td class="text-center px-4 py-3 text-danger fw-semibold">{{ $row->report_late }}</td>
                                <td class="text-center px-4 py-3 text-primary fw-semibold">{{ $row->skor_report }}%</td>
                                <td class="text-center px-4 py-3 text-success fw-bold bg-light">
                                    {{ $row->skor_sales + $row->skor_report }}%
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            const rawData = @json($kpiResult);

            const labels = $.map(rawData, item => item.karyawan);
            const skorSales = $.map(rawData, item => Number(item.skor_sales));
            const skorReport = $.map(rawData, item => Number(item.skor_report));
            const totalKpi = $.map(rawData, item => Number(item.skor_sales) + Number(item.skor_report));

            const salesLate = $.map(rawData, item => Number(item.sales_late));
            const reportLate = $.map(rawData, item => Number(item.report_late));
            const totalLatePerOrang = $.map(rawData, (item, i) => salesLate[i] + reportLate[i]);
            const totalOntimePerOrang = $.map(rawData, item => {
                let totalTask = Number(item.total_sales) + Number(item.total_report);
                let totalLate = Number(item.sales_late) + Number(item.report_late);
                return Math.max(0, totalTask - totalLate);
            });

            const ctxKpiDetail = $('#kpiDetailChart')[0].getContext('2d');
            new Chart(ctxKpiDetail, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Skor Sales (%)',
                            data: skorSales,
                            backgroundColor: '#0d6efd',
                            borderRadius: 4
                        },
                        {
                            label: 'Skor Report (%)',
                            data: skorReport,
                            backgroundColor: '#0dcaf0',
                            borderRadius: 4
                        },
                        {
                            label: 'Total KPI (%)',
                            data: totalKpi,
                            backgroundColor: '#198754',
                            borderRadius: 4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: { callback: value => value + '%' }
                        }
                    }
                }
            });

            const ctxTaskDetail = $('#taskDetailChart')[0].getContext('2d');
            new Chart(ctxTaskDetail, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Tasklist Ontime',
                            data: totalOntimePerOrang,
                            backgroundColor: '#198754',
                            borderRadius: 4
                        },
                        {
                            label: 'Tasklist Late',
                            data: totalLatePerOrang,
                            backgroundColor: '#dc3545',
                            borderRadius: 4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>