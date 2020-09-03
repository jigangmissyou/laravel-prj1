<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoleNode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(Schema::hasTable('role_node')) return;       //add this line to your database file

        Schema::create('role_node', function (Blueprint $table) {
            //角色ID
            $table->unsignedInteger('role_id')->default(0)->comment('角色ID');
            //节点ID
            $table->unsignedInteger('node_id')->default(0)->comment('节点ID');
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
