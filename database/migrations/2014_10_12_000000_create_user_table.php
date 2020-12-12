<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable()->unique();
            $table->string('password');
            $table->string('temp_password')->nullable();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('type')->default('Administrator');
            $table->boolean('active');
            $table->timestamps();
        });
        $data[] = [
                    'username' => 'admin',
                    'password' => md5('123456'),
                    'temp_password' => null,
                    'name' => 'Administrator',
                    'email' => 'admin@admin.com',
                    'phone' => '08123',
                    'type' => 'Administrator',
                    'active' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ];
        DB::table('user')->insert($data);
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
