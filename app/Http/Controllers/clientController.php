<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

class clientController extends Controller
{
    public function index () {
        $clients = Client::ofcompany()->latest()->paginate(15);
        return view('client.index', compact('clients'));
    }

    public function create () {
        return view('client.create');
    }

    public function store (Request $request) {
        $data = $request->validate([
            "name" => "required",
            "identity" => "required",
            "email" => "",
            "telephone" => ""
        ]);

        auth()->user()->company->clients()->create($data);
        return redirect( route("clientes") );
    }
}
