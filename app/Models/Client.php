<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ["name","telephone","email","identity"];

    public function company () {
        return $this->belongsTo(Company::class);
    }

    public function orders () {
        return $this->hasMany(Order::class);
    }

    public function scopeOfcompany($query) {
        return $query->where('company_id', '=', auth()->user()->company_id);
    }

    // protected static function booted()
    // {
    //     static::addGlobalScope('company', function (Builder $builder) {
    //         $builder->where('company_id', '=', auth()->user()->company_id);
    //     });
    // }
}
