<?php

namespace App\Charts;

use App\Models\Alumni;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AlumniDataChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $alumni = Alumni::get();
        $data = [
            $alumni->where('status','verified')->count(),
            $alumni->where('status','not verified')->count(),
        ];
        
        $label = [
            'Verified',
            'Not Verified',
        ];



        return $this->chart->pieChart()
            ->setTitle('Status alumni')
            ->addData($data)
            ->setLabels($label);
    }
}
