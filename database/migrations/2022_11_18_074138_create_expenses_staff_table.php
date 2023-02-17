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
        Schema::create('expenses_staff', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger("amount");
            $table->string('cancel')->default(0);
            $table->string('narration')->nullable();
            $table->smallInteger("staff_id")->refrences("id")->on("staff");
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
        Schema::dropIfExists('expenses_staff');
    }
};
