<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_bill_items', function (Blueprint $table) {
            $table->id();
            $table->smallInteger("service_id")->refrences("id")->on("service");
            $table->double("quantity");
            $table->double("service_rate")->refrences("id")->on("service");
            $table->string("tCode"); 
            $table->integer("status")->default(0);         
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
        Schema::dropIfExists('service_bill_items');
    }
};
