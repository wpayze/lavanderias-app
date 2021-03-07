<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ServiceType extends Model
{
    use HasFactory;
    protected $table = "service_types";
    protected $fillable = ["company_id", "name"];

    public function company () {
        return $this->belongsTo(Company::class);
    }

    public function orders () {
        return $this->belongsToMany(Order::class, "order_servicetype")->withTimeStamps()->withPivot("quantity");
    }

    protected static function booted()
    {
        static::addGlobalScope('company', function (Builder $builder) {
            $builder->where('company_id', '=', auth()->user()->company_id);
        });
    }

}
