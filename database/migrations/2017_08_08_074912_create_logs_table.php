<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('data_id');
            // Add Delete Update
            $table->text('operation');
            // Course Or Department
            $table->text('changed_data');
            $table->text('old_name')->nullable()->default(null);
            $table->text('old_text')->nullable()->default(null);
            $table->text('new_name')->nullable()->default(null);
            $table->text('new_text')->nullable()->default(null);
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
        Schema::dropIfExists('logs');
    }
}
