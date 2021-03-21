<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

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

        auth()->user()->company->clients()->create($data);
        return redirect( route("clientes") );
    }
}
