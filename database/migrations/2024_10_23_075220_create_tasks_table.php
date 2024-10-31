<?php

use App\Models\Task;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            global $status;
            $table->id();
            $table->int('parent_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('startedAt')->nullable();
            $table->date('completedAt')->nullable();
            $table->date('deadline')->nullable();
            $table->enum('status', Task::statusOptionKeys())->default(Task::TO_DO);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
}


