<?php

namespace App\Http\Controllers;

use App\Repositories\ReportRepository;
use Illuminate\Http\Request;

class reportController extends Controller
{
    protected $reportRepository;
    public function __construct( ReportRepository $reportRepository )
    {
        $this->reportRepository = $reportRepository;
    }

    public function revenueByMonth () {
        return response()->json( $this->reportRepository->revenueByMonth() );
    }
}
