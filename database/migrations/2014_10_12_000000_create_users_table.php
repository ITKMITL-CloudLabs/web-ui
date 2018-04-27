<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('os_user_id')->nullable()->default(null);
            $table->string('username')->unique();
            $table->string('password')->nullable()->default(null);
            $table->rememberToken();
            $table->enum('role', ['instructor', 'student', 'ta'])->default('student');
            $table->string('name');
            $table->boolean('enabled');
            $table->string('description')->nullable();
            $table->string('domain_id')->nullable()->default(null);
            $table->string('os_default_project_id')->nullable()->default(null);
            $table->text('token')->nullable(true)->default(null);
            $table->timestamp('token_expired_at')->nullable(true)->default(null);
            $table->timestamp('logged_in_at')->nullable(true)->default(null);
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
        Schema::dropIfExists('users');
    }
}
