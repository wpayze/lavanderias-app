<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class select2controller extends Controller
{
    public function clientSearch(Request $request) {
        $clients = [];

        if ($request->has("q")) {

            $search = $request->q;
            $clients = Client::ofcompany()->select("id", "name")
                        ->where("name", "LIKE", "%$search%")
                        ->orWhere("identity", "LIKE", "%$search%")
                        ->orWhere("email", "LIKE", "%$search%")
                        ->orWhere("telephone", "LIKE", "%$search%")
                        ->get();
        }

        return response()->json($clients);
    }
}
