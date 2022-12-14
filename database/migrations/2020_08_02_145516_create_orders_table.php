<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->text('status');

            $table->integer('price');
            $table->text('name');
            $table->text('surname');
            $table->text('email');
            $table->text('phone');

            $table->text('road');
            $table->text('houseno');
            $table->text('flatno')->nullable();
            $table->text('postcode');
            $table->text('city');
            $table->text('country')->nullable();
            $table->text('message')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
