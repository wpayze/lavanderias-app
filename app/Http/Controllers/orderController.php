<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\PieceType;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function index() {

        $query = request()->get("search") ? request()->get("search") : "";

        if ($query) {

            //dd($query);

            $ordersQuery =
            Order::with("client", "piecetypes", "servicetypes")
            ->latest();

            if ( isset($query["id"]) )
                $ordersQuery->where("id", "=", $query["id"]);

            if ( $query["state"] != "TODOS" )
                $ordersQuery->where("state", "=", $query["state"]);

            if ( isset($query["client_id"]) )
                $ordersQuery->where("client_id", "=", $query["client_id"]);

            if ( isset($query["bags"]) )
                $ordersQuery->where("bags", "=", $query["bags"]);

            if ( isset($query["entrancemin"]) )
                $ordersQuery->where("entrance_date", ">=", $query["entrancemin"] );

            if ( isset($query["entrancemax"]) )
                $ordersQuery->where("entrance_date", "<=", $query["entrancemax"] );

            if ( isset($query["endingmin"]) )
                $ordersQuery->where("ending_date", ">=", $query["endingmin"] );

            if ( isset($query["endingmax"]) )
                $ordersQuery->where("ending_date", "<=", $query["endingmax"] );

            if ( isset($query["deliverymin"]) )
                $ordersQuery->where("delivery_date", ">=", $query["deliverymin"] );

            if ( isset($query["deliverymax"]) )
                $ordersQuery->where("delivery_date", "<=", $query["deliverymax"] );

            $orders = $ordersQuery->paginate(15)->appends( request()->query() );

        } else {
            $orders = Order::with("client", "piecetypes", "servicetypes")->latest()->paginate(15);
        }

        return view("order.index", compact("orders", "query"));
    }

    public function create() {

        $service_types = ServiceType::all();
        $piece_types = PieceType::all();

        return view("order.create", compact("service_types", "piece_types"));
    }

    public function store (Request $request) {
        $data = $request->validate([
            "client_id" => "required",
            "bags" => "",
            "total" => "",
            "state" => "required",
            "entrance_date" => "required|date",
            "ending_date" => "",
            "delivery_date" => "",
            "observations" => "",
            "piece_types.*.id" => "",
            "piece_types.*.quantity" => "",
            "piece_types.*.weight" => "",
            "piece_types.*.price" => "",
            "service_types.*" => ""
        ]);

        $client = Client::find($data["client_id"]);

        $newOrder = auth()->user()->company->orders()->create($data);
        $client->orders()->save($newOrder);

        if (isset($data["service_types"])) {
            $newOrder->serviceTypes()->attach($data["service_types"]);
        }

        if (isset($data["piece_types"])) {
            foreach( $data["piece_types"] as $piece_type ) {
                $newOrder->pieceTypes()->attach($piece_type["id"],
                [
                    "quantity" => $piece_type["quantity"],
                    "weight" => $piece_type["weight"],
                    "price" => $piece_type["price"]
                ]);
            }
        }

        return redirect( route("ordenes.show", $newOrder->id) );
    }

    public function show (Order $order) {
        return view("order.show", compact("order"));
    }

    public function edit (Order $order) {

        $service_types = ServiceType::all();
        $piece_types = PieceType::all();

        return view("order.edit", compact("order", "service_types", "piece_types"));
    }

    public function update(Request $request, Order $order) {

        $data = $request->validate([
            "client_id" => "required",
            "bags" => "",
            "total" => "",
            "state" => "required",
            "entrance_date" => "required|date",
            "ending_date" => "",
            "delivery_date" => "",
            "observations" => "",
            "piece_types.*.id" => "",
            "piece_types.*.quantity" => "",
            "piece_types.*.weight" => "",
            "piece_types.*.price" => "",
            "service_types.*" => ""
        ]);

        $order->update($data);

        $order->pieceTypes()->detach();
        $order->serviceTypes()->detach();

        if (isset($data["service_types"])) {
            $order->serviceTypes()->attach($data["service_types"]);
        }

        if (isset($data["piece_types"])) {
            foreach( $data["piece_types"] as $piece_type ) {
                $order->pieceTypes()->attach($piece_type["id"],
                [
                    "quantity" => $piece_type["quantity"],
                    "weight" => $piece_type["weight"],
                    "price" => $piece_type["price"]
                ]);
            }
        }

        return redirect( route("ordenes.show", $order->id) );
    }
}
