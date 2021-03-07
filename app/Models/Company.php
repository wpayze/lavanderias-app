<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    
    protected $fillable = ["name", "rtn"];

    public function users () {
        return $this->hasMany(User::class);
    }

    public function clients () {
        return $this->hasMany(Client::class);
    }

    public function pieceTypes () {
        return $this->hasMany(PieceType::class);
    }

    public function offices () {
        return $this->hasMany(Office::class);
    }

    public function orders () {
        return $this->hasMany(Order::class);
    }

    public function serviceTypes () {
        return $this->hasMany(ServiceType::class);
    }
}
