<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('sid');
            $table->string('sty');
            $table->string('rid');
            $table->string('rty');
            $table->longtext('msg');
            $table->longtext('extra1');
            $table->longtext('extra2');
            $table->longtext('extra3');
            $table->longtext('extra4');
            $table->longtext('extra5');
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
        Schema::dropIfExists('chats');
    }
}
