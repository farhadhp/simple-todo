<?php

use Farhadhp\SimpleToDo\Models\Task;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $comment = '';
//        $allStatus = Task::ALL_STATUS;
//        array_walk(
//            $allStatus,
//            function ($item, $key) use (&$comment) {
//                $comment .= $key ." => ".$item. " | ";
//            }
//        );

        Schema::create('tasks', function (Blueprint $table) use ($comment) {
            $table->id();
            $table->string('title')->index();
            $table->text('description');
            $table->foreignId('user_id');
            $table->unsignedTinyInteger('status')->default(1)->index();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
