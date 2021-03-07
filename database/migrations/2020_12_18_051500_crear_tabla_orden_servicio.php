<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaOrdenServicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_servicetype', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("order_id");
            $table->foreign("order_id")->references("id")->on("orders");

            $table->unsignedBigInteger("service_type_id");
            $table->foreign("service_type_id")->references("id")->on("service_types");

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
        Schema::dropIfExists('order_servicetype');
    }
}
