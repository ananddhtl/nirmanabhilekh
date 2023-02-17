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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->smallInteger("customer_id");
            $table->String("project_name");
            $table->String("project_address");
            $table->String("project_city");
            $table->date("project_fiscal_year");
            $table->text("project_duration");
            $table->bigInteger("project_costestimation");
            $table->smallInteger("project_leader_id");
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
        Schema::dropIfExists('projects');
    }
};
