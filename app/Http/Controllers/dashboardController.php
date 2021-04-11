<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReportRepository;

class dashboardController extends Controller
{
    protected $reportRepository;
    public function __construct( ReportRepository $reportRepository )
    {
        $this->reportRepository = $reportRepository;
    }

    public function dashboard () {
        $currentMonth = request()->get("month") ? request()->get("month") : "m";

        $initialDate = date('Y-'.$currentMonth.'-01');
        $finalDate = date('Y-'.$currentMonth.'-t');

        $monthsText = ["Todos los Meses", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

        $months = $this->reportRepository->getMonthsWithOrders();
        $report = $this->reportRepository->getDashboardReport($initialDate,$finalDate);

        return view('dashboard', compact("report", "months", "monthsText", "currentMonth") );
    }
}
