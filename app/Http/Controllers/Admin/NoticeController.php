<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Support\Facades\Log;


class NoticeController extends Controller
{
    //
    public function demo(){
        $collection = collect(['taylor','abigail', null])->map(function($name){
            return strtoupper($name);
        });

        $collection = collect([1,2,3,4,5,6,7,8]);
        $chunk = $collection->chunk(6);
        dd($chunk->toArray());
        dump($collection);
        dd($chunk->all());
        die;

        dd($collection->all());

        dd($collection->toArray());

        Log::info('============hello world==============');

//        echo 1111111;
//        die;
//        $table->bigIncrements('id');
//        $table->unsignedInteger('fangowner_id')->comment('房东ID');
//        $table->unsignedInteger('renting_id')->default(1)->comment('租客ID');
//        $table->dateTime('dtime')->nullable()->comment('时间');
//        $table->string('cnt',500)->default('')->comment('内容');
//        $table->enum('status',['0','1'])->default('0')->comment('状态0未看，1已看或过期');
//        $table->timestamps();
//        $table->softDeletes();
        $post = ['fangowner_id'=>1,'renting_id'=>2,'dtime'=>3,'cnt'=>'This is a demo here', 'status'=>1];
        Notice::create($post);


    }
}
