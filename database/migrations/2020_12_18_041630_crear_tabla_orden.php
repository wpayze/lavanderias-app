<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaOrden extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("company_id");
            $table->foreign("company_id")->references("id")->on("companies");

            $table->unsignedBigInteger("client_id");
            $table->foreign("client_id")->references("id")->on("clients");

            $table->date("entrance_date");
            $table->date("delivery_date")->nullable();
            $table->string("observations")->nullable();
            $table->float("total")->nullable();
            $table->float("bags")->nullable();
            $table->string("state")->default("EN PROCESO");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
