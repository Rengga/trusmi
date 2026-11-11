<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KpiMarketingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel terlebih dahulu agar tidak terjadi duplikasi data saat seeding ulang
        DB::table('table_kpi_marketing')->delete();

        // Data presisi sesuai soal kandidat programmer
        $data = [
            [
                'id'         => 1,
                'tasklist'   => 'Tasklist 1',
                'kpi'        => 'Sales',
                'karyawan'   => 'Budi',
                'deadline'   => '2022-01-10',
                'aktual'     => '2022-01-09',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'         => 2,
                'tasklist'   => 'Tasklist 2',
                'kpi'        => 'Sales',
                'karyawan'   => 'Budi',
                'deadline'   => '2022-01-10',
                'aktual'     => '2022-01-08',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'         => 3,
                'tasklist'   => 'Tasklist 3',
                'kpi'        => 'Report',
                'karyawan'   => 'Budi',
                'deadline'   => '2022-01-10',
                'aktual'     => '2022-01-07',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'         => 4,
                'tasklist'   => 'Tasklist 4',
                'kpi'        => 'Report',
                'karyawan'   => 'Budi',
                'deadline'   => '2022-01-10',
                'aktual'     => '2022-01-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'         => 5,
                'tasklist'   => 'Tasklist 5',
                'kpi'        => 'Sales',
                'karyawan'   => 'Adi',
                'deadline'   => '2022-01-10',
                'aktual'     => '2022-01-09',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'         => 6,
                'tasklist'   => 'Tasklist 6',
                'kpi'        => 'Sales',
                'karyawan'   => 'Adi',
                'deadline'   => '2022-01-10',
                'aktual'     => '2022-01-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'         => 7,
                'tasklist'   => 'Tasklist 7',
                'kpi'        => 'Report',
                'karyawan'   => 'Adi',
                'deadline'   => '2022-01-10',
                'aktual'     => '2022-01-07',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'         => 8,
                'tasklist'   => 'Tasklist 8',
                'kpi'        => 'Report',
                'karyawan'   => 'Adi',
                'deadline'   => '2022-01-10',
                'aktual'     => '2022-01-07',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'         => 9,
                'tasklist'   => 'Tasklist 9',
                'kpi'        => 'Sales',
                'karyawan'   => 'Rara',
                'deadline'   => '2022-01-10',
                'aktual'     => '2022-01-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'         => 10,
                'tasklist'   => 'Tasklist 10',
                'kpi'        => 'Sales',
                'karyawan'   => 'Rara',
                'deadline'   => '2022-01-10',
                'aktual'     => '2022-01-09',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'         => 11,
                'tasklist'   => 'Tasklist 11',
                'kpi'        => 'Report',
                'karyawan'   => 'Rara',
                'deadline'   => '2022-01-10',
                'aktual'     => '2022-01-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'         => 12,
                'tasklist'   => 'Tasklist 12',
                'kpi'        => 'Report',
                'karyawan'   => 'Doni',
                'deadline'   => '2022-01-10',
                'aktual'     => '2022-01-09', // Disesuaikan dari typo 2022-01-00 agar kalkulasi query berjalan sempurna
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'         => 13,
                'tasklist'   => 'Tasklist 13',
                'kpi'        => 'Sales',
                'karyawan'   => 'Doni',
                'deadline'   => '2022-01-10',
                'aktual'     => '2022-01-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('table_kpi_marketing')->insert($data);
    }
}