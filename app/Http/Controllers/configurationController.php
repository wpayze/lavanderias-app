<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PieceType;
use App\Models\ServiceType;

class configurationController extends Controller
{
    public function index() {
        $piece_types = PieceType::all();
        $service_types = ServiceType::all();

        return view("configuration.configuracion", compact("service_types", "piece_types"));
    }

    public function storeServiceType (Request $request) {
        $data = $request->validate([
            "name" => "required"
        ]);

        auth()->user()->company->serviceTypes()->create($data);

        return redirect( route("configuracion") );
    }

    public function storePieceType (Request $request) {
        $data = $request->validate([
            "name" => "required",
            "price" => "",
            "charge_by" => ""
        ]);

        auth()->user()->company->pieceTypes()->create($data);

        return redirect( route("configuracion") );
    }

    public function editPieceType (PieceType $pieceType) {
        return view("configuration.updatePieceType", compact("pieceType"));
    }

    public function updatePieceType (Request $request, PieceType $pieceType) {
        $data = $request->validate([
            "name" => "required",
            "price" => "",
            "charge_by" => ""
        ]);

        $pieceType->update($data);

        return redirect( route("configuracion") );
    }
}
