<?php
namespace App\Observers;

use App\Models\Notice;
use App\Jobs\NoticeJob;
use Illuminate\Support\Facades\Log;

class NoticeObserver{
    public function created(Notice $notice){
        //
        Log::info('============hello sdfdfdfdfdfd==============');
        dispatch(new NoticeJob());
    }

    public function updated(){

    }
}
