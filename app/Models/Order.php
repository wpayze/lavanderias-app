<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        // "company_id",
        "client_id",
        "entrance_date",
        "ending_date",
        "delivery_date",
        "observations",
        "total",
        "bags",
        "state"
    ];

    public function company () {
        return $this->belongsTo(Company::class);
    }

    public function client () {
        return $this->belongsTo(Client::class);
    }

    public function pieceTypes () {
        return $this->belongsToMany(PieceType::class, "order_piecetype")->withTimeStamps()
                ->withPivot("quantity")->withPivot("weight")->withPivot("price");
    }

    public function serviceTypes () {
        return $this->belongsToMany(ServiceType::class, "order_servicetype")->withTimeStamps();
    }
}
