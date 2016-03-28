<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class mohamed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mohamed', function ( $table) {
            $table->increments('id');
            $table->string('nameed',255);//lenth 255
            $table->string('email')->unique();
            $table->integer('department');//int
            $table->timestamp('date');
            $table->text('info');
            $table->longtext('content');
            $table->enum('type',['master','slave']);
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
        //
        Schema::drop('mohamed');
    }
}
