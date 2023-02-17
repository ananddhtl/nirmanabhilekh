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
        Schema::create('service_billing_amounts', function (Blueprint $table) {
            $table->id();
            $table->String("tCode")->refrences("id")->on("servicebillitems");
            $table->double("totalamount");
            $table->double("discount")->nullable()->default(0);
            $table->double("alltotalamount");
            $table->String("cancel")->default(0);
            $table->date("billDate");
            $table->integer("status")->default(0); //cash=0 credit=1
            $table->smallInteger("customer_id")->refrences("id")->on("customer");
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
        Schema::dropIfExists('service_billing_amounts');
    }
};
