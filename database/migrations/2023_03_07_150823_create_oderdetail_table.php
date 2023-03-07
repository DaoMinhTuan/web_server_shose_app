<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOderdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oderdetail', function (Blueprint $table) {
            $table->id();
            $table->integer('oder_id');
            $table->integer('product_id');
            $table->string('size_id');
            $table->string('color_id');
            $table->integer('paymentAmount');
            $table->integer('status');
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
        Schema::dropIfExists('oderdetail');
    }
}
