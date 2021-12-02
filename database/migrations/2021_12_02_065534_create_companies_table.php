<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('cmpyname');
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->bigInteger('phonenumber');
            $table->bigInteger('pannumber');
            $table->string('pancertificate');
            $table->string('website')->nullable();
            $table->longText('about')->nullable();
            $table->longText('overview')->nullable();
            $table->string('mainlocation')->nullable();
            $table->string('brachlocations')->nullable();
            $table->string('cmpysize')->nullable();
            $table->string('cmpyestd')->nullable();
            $table->string('cmpydp')->nullable();
            $table->string('cmpycp')->nullable();
            $table->string('emailverfication')->nullable();
            $table->string('adminverification')->nullable();
            $table->string('block')->nullable();
            $table->string('extra1')->nullable();
            $table->string('extra2')->nullable();
            $table->string('extra3')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
