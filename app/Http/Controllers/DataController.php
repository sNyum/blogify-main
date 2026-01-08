<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DataController extends Controller
{
    /**
     * Download Population Data as CSV
     */
    public function downloadPopulationData()
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=jumlah_penduduk_batanghari_2022_2024.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['Tahun', 'Kecamatan', 'Jumlah Penduduk (Jiwa)', 'Laki-laki', 'Perempuan'];

        $data = [
            ['2022', 'Mersam', '33.450', '17.120', '16.330'],
            ['2022', 'Muaratembesi', '35.120', '18.050', '17.070'],
            ['2022', 'Muara Bulian', '68.900', '35.400', '33.500'],
            ['2022', 'Bajubang', '41.200', '21.500', '19.700'],
            ['2022', 'Maro Sebo Ulu', '40.100', '20.600', '19.500'],
            ['2022', 'Maro Sebo Ilir', '15.800', '8.100', '7.700'],
            ['2022', 'Pemayung', '36.500', '18.800', '17.700'],
            ['2022', 'Batin XXIV', '31.200', '16.000', '15.200'],
            
            ['2023', 'Mersam', '34.100', '17.400', '16.700'],
            ['2023', 'Muaratembesi', '35.800', '18.400', '17.400'],
            ['2023', 'Muara Bulian', '70.200', '36.100', '34.100'],
            ['2023', 'Bajubang', '42.000', '21.900', '20.100'],
            ['2023', 'Maro Sebo Ulu', '40.900', '21.000', '19.900'],
            ['2023', 'Maro Sebo Ilir', '16.100', '8.250', '7.850'],
            ['2023', 'Pemayung', '37.100', '19.100', '18.000'],
            ['2023', 'Batin XXIV', '31.800', '16.300', '15.500'],

            ['2024', 'Mersam', '34.800', '17.800', '17.000'],
            ['2024', 'Muaratembesi', '36.500', '18.800', '17.700'],
            ['2024', 'Muara Bulian', '71.500', '36.800', '34.700'],
            ['2024', 'Bajubang', '42.800', '22.300', '20.500'],
            ['2024', 'Maro Sebo Ulu', '41.700', '21.400', '20.300'],
            ['2024', 'Maro Sebo Ilir', '16.400', '8.400', '8.000'],
            ['2024', 'Pemayung', '37.800', '19.400', '18.400'],
            ['2024', 'Batin XXIV', '32.400', '16.600', '15.800'],
        ];

        $callback = function() use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
