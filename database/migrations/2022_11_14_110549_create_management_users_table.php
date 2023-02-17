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
        Schema::create('management_users', function (Blueprint $table) {
            $table->integer('UserId')->nullable();
            $table->text('options')->nullable();
            $table->smallInteger('fullOrPartial')->default(0); //0 full 1=partial
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
        Schema::dropIfExists('management_users');
    }
};
