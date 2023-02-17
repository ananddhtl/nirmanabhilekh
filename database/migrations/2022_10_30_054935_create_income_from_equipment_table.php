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
        Schema::create('income_from_equipment', function (Blueprint $table) {
            $table->id();
            $table->smallInteger("equipment_id")->refrences("id")->on("equipments");
            $table->bigInteger("amount");
            $table->string('cancel')->default(0);
            $table->string('narration')->nullable();
            $table->smallInteger("customer_id")->refrences("id")->on("customers");
            $table->date('date');
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
        Schema::dropIfExists('income_from_equipment');
    }
};
