<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaOrdenPieza extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_piecetype', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("order_id");
            $table->foreign("order_id")->references("id")->on("orders");

            $table->unsignedBigInteger("piece_type_id");
            $table->foreign("piece_type_id")->references("id")->on("piece_types");

            $table->float("quantity")->nullable();
            $table->float("weight")->nullable();

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
        Schema::dropIfExists('order_piecetype');
    }
}
