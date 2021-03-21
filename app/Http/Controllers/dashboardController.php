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

        $initialDate = date('Y-m-01');
        $finalDate = date('Y-m-t');

        $report = $this->reportRepository->revenueByMonth();
        $report = $this->reportRepository->getDashboardReport($initialDate,$finalDate);

        return view('dashboard', compact("report") );
    }
}
