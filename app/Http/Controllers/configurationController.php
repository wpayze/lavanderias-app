<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PieceType;
use App\Models\ServiceType;
use Session;

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

        $serviceType = auth()->user()->company->serviceTypes()->create($data);

        Session::flash('message', $serviceType->name . ' agregado/a correctamente.');
        return redirect( route("configuracion") );
    }

    public function storePieceType (Request $request) {
        $data = $request->validate([
            "name" => "required",
            "price" => "",
            "charge_by" => ""
        ]);

        $pieceType = auth()->user()->company->pieceTypes()->create($data);

        Session::flash('message', $pieceType->name . ' agregado/a correctamente.');
        return redirect( route("configuracion") );
    }

    public function editPieceType (PieceType $pieceType) {
        return view("configuration.updatePieceType", compact("pieceType"));
    }

    public function editServiceType (ServiceType $serviceType) {
        return view("configuration.updateServiceType", compact("serviceType"));
    }

    public function updatePieceType (Request $request, PieceType $pieceType) {
        $data = $request->validate([
            "name" => "required",
            "price" => "",
            "charge_by" => ""
        ]);

        $pieceType->update($data);

        Session::flash('message', $pieceType->name . ' actualizado/a correctamente.');
        return redirect( route("configuracion") );
    }

    public function updateServiceType (Request $request, ServiceType $serviceType) {
        $data = $request->validate([
            "name" => "required"
        ]);

        $serviceType->update($data);

        Session::flash('message', $serviceType->name . ' actualizado/a correctamente.');
        return redirect( route("configuracion") );
    }

    public function createAccounts () {
        return view("createAccount");
    }

    public function saveAccount (Request $request) {
        $company = \App\Models\Company::create(["name" => $request->get("company")]);

        \App\Models\User::factory(1)->create([
            "email" => $request->get("email"),
            "company_id" => $company->id,
            "name" =>  $request->get("username")
        ]);

        \App\Models\Client::factory(10)->create([
            'company_id' => $company->id
        ]);

        return redirect("/createAccounts");
    }

    // public function deletePieceType (PieceType $pieceType) {
    //     //$pieceType->delete();
    //     Session::flash('message', 'Tipo de Pieza eliminada correctamente.');
    //     return redirect( route("configuracion") );
    // }
}
