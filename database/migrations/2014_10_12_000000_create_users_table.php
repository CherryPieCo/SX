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
            $table->string('name');
            $table->string('patronymic');
            $table->string('surname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('salon_title');
            $table->string('city');
            $table->string('address');
            $table->string('phone');
            $table->string('phone_extra');
            $table->enum('type', ['client', 'specialist']);
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            
            $table->rememberToken();
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
