<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->string('sector');
            $table->string('branchlocation');
            $table->string('duration');
            $table->string('deadline');
            $table->bigInteger('stipend');
            $table->string('jobid');
            $table->string('orientation');
            $table->string('cmpyname');
            $table->string('cmpyemail');
            $table->string('cmpyid');
            $table->string('cmpyusername');
            $table->longtext('cmpyabout');
            $table->string('website');
            $table->longtext('aboutjob');
            $table->longtext('skills');
            $table->longtext('jobrequirements');
            $table->longtext('perks');
            $table->string('openings');
            $table->string('extratitle');
            $table->longtext('extradescription');
            $table->longtext('files');
            $table->longtext('extra1');
            $table->longtext('extra2');
            $table->longtext('extra3');
            $table->longtext('extra4');
            $table->longtext('extra5');
            $table->longtext('extra6');
            $table->longtext('extra7');
            $table->longtext('extra8');
            $table->longtext('extra9');
            $table->longtext('extra10');
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
        Schema::dropIfExists('jobs');
    }
}
