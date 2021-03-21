<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\Order;

class ReportRepository {

    public function getDashboardReport ($initialDate, $finalDate) {

        $clients =  Client::ofcompany()->count();

        $orders  =  Order::where("entrance_date", ">=", $initialDate)
                        ->where("entrance_date", "<=", $finalDate)->count();

        $new_clients =  Client::where("created_at", ">=", $initialDate)
                            ->where("created_at", "<=", $finalDate)->count();

        $revenue =  Order::where("entrance_date", ">=", $initialDate)
                        ->where("entrance_date", "<=", $finalDate)
                        ->sum("total");

        return [
            "clients" => $clients,
            "orders" => $orders,
            "newClients" => $new_clients,
            "revenue" => $revenue
        ];

    }

    public function revenueByMonth () {

        $data =  Order::where("entrance_date", ">=", date("Y-01-01"))
                    ->where("entrance_date", "<=", date("Y-12-31"))
                    ->selectRaw("year(entrance_date) year, month(entrance_date) month, sum(total) data")
                    ->groupBy("year", "month")
                    ->orderBy("month", "asc")
                    ->get();

        return $data;
    }

}
