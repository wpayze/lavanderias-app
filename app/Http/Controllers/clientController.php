<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use Session;

class clientController extends Controller
{
    public function index () {

        $paginacion = request()->get("paginacion") ? request()->get("paginacion") : 15;
        $query = request()->get("search") ? request()->get("search") : "";

        if ($query) {
            $clients = Client::ofcompany()
            ->where("name", "LIKE", "%$query%")
            ->orWhere("identity", "LIKE", "%$query%")
            ->orWhere("email", "LIKE", "%$query%")
            ->orWhere("telephone", "LIKE", "%$query%")
            ->paginate($paginacion)
            ->appends( request()->query() );
        } else {
            $clients = Client::ofcompany()->latest()->paginate($paginacion);
        }

        return view('client.index', compact('clients', "paginacion", "query"));
    }

    public function create () {
        return view('client.create');
    }

    public function store (Request $request) {
        $data = $request->validate([
            "name" => "required",
            "identity" => "",
            "email" => "",
            "telephone" => ""
        ]);

        $client = auth()->user()->company->clients()->create($data);

        Session::flash('message',  $client->name . ' agregado correctamente.');
        return redirect( route("clientes") );
    }

    public function edit (Client $cliente) {
        return view('client.edit', ["client" => $cliente]);
    }

    public function update (Request $request, Client $cliente) {
        $data = $request->validate([
            "name" => "required",
            "identity" => "",
            "email" => "",
            "telephone" => ""
        ]);

        $cliente->update($data);

        Session::flash('message',  $cliente->name . ' actualizado correctamente.');
        return redirect( route("clientes") );
    }
}
