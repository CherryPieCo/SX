<?php

use App\User;
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
            $table->string('name')->nullable();
            $table->string('patronymic')->nullable();
            $table->string('surname')->nullable();
            $table->string('email', 40)->unique();
            $table->string('password')->nullable();
            $table->string('salon_title')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('phone', 22)->unique();
            $table->string('phone_extra')->nullable();

            $table->string('password_reset_token', 16)->unique()->nullable();

            $table->string('certificate_image')->nullable();
            $table->string('diploma_image')->nullable();
            
            
            $table->enum('type', [User::TYPE_CLIENT, User::TYPE_SPECIALIST]);
            $table->enum('status', [User::STATUS_ACTIVE, User::STATUS_INACTIVE])->default(User::STATUS_INACTIVE);
            
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
