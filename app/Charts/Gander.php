<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Gander
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function pie(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $male   = Employee::where('gender','MALE')->count();
        $female = Employee::where('gender','FEMALE')->count();
        $data   = [$male,$female];
        $thn    = 'Total Gender Season '.date('Y');
        return $this->chart->pieChart()
                ->setTitle('Gender.')
                ->setSubtitle($thn)
                ->addData($data)
                ->setLabels(['Male', 'Female']);
    }
    public function bar(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $date = date('Y-m');
        $data  = DB::table('attechments')
                    ->select(DB::raw("count(attechments.id) as total, to_char(attechments.created_at,'YYYY-MM') as month"))
                    ->leftJoin('employees','employees.id','attechments.employee_id')
                    ->where('employees.branch_id',Auth::user()->branch_id)
                    ->groupBy(DB::raw("to_char(attechments.created_at,'YYYY-MM'),$date"))
                    ->get();
        $archiveTotal = [];
        $month =[];
        foreach($data as $d){
            if (substr($d->month,5,2) == '01'){
                array_push($archiveTotal,$d->total);
            }
            if (substr($d->month,5,2) == '02'){
                array_push($archiveTotal,$d->total);
            }
            if (substr($d->month,5,2) == '03'){
                array_push($archiveTotal,$d->total);
            }
            if (substr($d->month,5,2) == '04'){
                array_push($archiveTotal,$d->total);
            }
            if (substr($d->month,5,2) == '05'){
                array_push($archiveTotal,$d->total);
            }
            if (substr($d->month,5,2) == '06'){
                array_push($archiveTotal,$d->total);
            }
            if (substr($d->month,5,2) == '07'){
                array_push($archiveTotal,$d->total);
            }
            if (substr($d->month,5,2) == '08'){
                array_push($archiveTotal,$d->total);
            }
            if (substr($d->month,5,2) == '09'){
                array_push($archiveTotal,$d->total);
            }
            if (substr($d->month,5,2) == '10'){
                array_push($archiveTotal,$d->total);
            }
            if (substr($d->month,5,2) == '11'){
                array_push($archiveTotal,$d->total);
            }
            if (substr($d->month,5,2) == '12'){
                array_push($archiveTotal,$d->total);
            }
        }
        $date = date('Y');
        return $this->chart->barChart()
                ->setTitle('Archive Report')
                ->setSubtitle('Wins during season '.$date)
                ->addData('Archive',$archiveTotal)
                ->setXAxis(['jan', 'feb', 'march', 'april', 'may', 'june','july','agust','sept','okt','nov','des']);
    }
}
