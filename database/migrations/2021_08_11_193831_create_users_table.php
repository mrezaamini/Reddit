<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->rememberToken();
			$table->char('activation_code',60);
			$table->uuid('api')->unique()->nullable();
			$table->char('mobile',11)->unique();
			$table->string('name',35)->nullable();
			$table->string('surname',35)->nullable();
			$table->char('national_code',11)->unique()->nullable();
			$table->string('title',100)->nullable();
			$table->string('site_address',175)->nullable();
			$table->char('phone',12)->nullable();
			$table->text('about')->nullable();
			$table->string('birth_certificate_number',11)->nullable();
			$table->date('birthday')->nullable();
			$table->enum('gender',['0','1'])->nullable();
			$table->string('address')->nullable();
			$table->string('avatar')->nullable();
			$table->boolean('available')->default(false);
			$table->timestamp('approved_at')->nullable();
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
