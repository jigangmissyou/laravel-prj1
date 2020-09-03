<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('nodes')) return;       //add this line to your database file

        //节点表，权限表
        Schema::create('nodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->comment('节点名称');
            $table->string('route_name')->default(0)->comment('上级ID');
            $table->enum('is_menu',['0','1'])->default('0')->comment('是否为菜单0否，1是');
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
        Schema::dropIfExists('nodes');
    }
}
