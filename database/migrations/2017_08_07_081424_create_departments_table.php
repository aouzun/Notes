<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Notes\Department;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('info')->default('lorem ipsum');
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
        $departments = Department::all();
        foreach ($departments as $dep){
            Storage::disk('local')->deleteDirectory($dep->name);
        }
        Schema::dropIfExists('departments');
    }
}
