<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('users')) return;       //add this line to your database file


        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            //角色
            $table->unsignedInteger('role_id')->default(0)->comment('角色ID');
            $table->string('username', 20)->comment('user name');
            $table->string('truename', 50)->deault('anonymous')->comment('real name');
            $table->string('password', 255)->comment('password');
            $table->string('email', 50)->nullable()->comment('email');
            $table->string('phone', 15)->default('')->comment('mobile');
            $table->enum('sex', ['Mr', 'Mrs'])->default('Mr')->comment('sex');
            $table->char('last_ip', 15)->default('')->comment('ip');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
