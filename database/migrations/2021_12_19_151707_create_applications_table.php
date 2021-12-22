<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('candid');
            $table->string('cmpyid');
            $table->string('jobid');
            $table->longtext('proposal');
            $table->string('date');
            $table->string('shortlist')->nullable();
            $table->string('hired')->nullable();
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
        Schema::dropIfExists('applications');
    }
}
