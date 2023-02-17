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
        Schema::create('project_estimations', function (Blueprint $table) {
            $table->id();
            $table->smallInteger("project_id")->refrences("id")->on("project");
            $table->smallInteger("activities_id")->refrences("id")->on("activities");
            $table->integer("suppliers_id")->refrences("id")->on("suppliers");
            $table->double("quantity_in");
  
            $table->double("quantity_out");
            $table->string("cancel");
            $table->date("fiscal_year");
            $table->integer("status")->default(0);
            $table->string("tCode");
            $table->double("amount");
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
        Schema::dropIfExists('project_estimations');
    }
};
