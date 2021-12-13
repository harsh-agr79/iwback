<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('title')->nullable();
            $table->string('email');
            $table->string('google_id')->nullable();
            $table->string('username');
            $table->string('password')->nullable();
            $table->longtext('about')->nullable();
            $table->string('skills')->nullable();
            $table->string('skills level')->nullable();
            $table->string('eduorganization')->nullable();
            $table->string('educourse')->nullable();
            $table->string('edutimefrom')->nullable();
            $table->string('edutimeto')->nullable();
            $table->string('exporganization')->nullable();
            $table->string('exppost')->nullable();
            $table->string('exptimefrom')->nullable();
            $table->string('exptimeto')->nullable();
            $table->string('portfoliowebsite')->nullable();
            $table->string('address')->nullable();
            $table->bigInteger('phonenumber')->nullable();
            $table->string('emailverfication')->nullable();
            $table->string('deactivate')->nullable();
            $table->string('deactivatetime')->nullable();
            $table->string('deactivatecode')->nullable();
            $table->string('fpwcode')->nullable();
            $table->string('fpwtime')->nullable();
            $table->longtext('extra1')->nullable();
            $table->longtext('extra2')->nullable();
            $table->longtext('extra3')->nullable();
            $table->longtext('extra4')->nullable();
            $table->longtext('extra5')->nullable();
            $table->longtext('extra6')->nullable();
            $table->longtext('extra7')->nullable();
            $table->longtext('extra8')->nullable();
            $table->longtext('extra9')->nullable();
            $table->longtext('extra10')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
