<?php

namespace App\Http\Controllers\Admin; 
use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
use App\Models\AdLogs;

class LogsController extends Controller{
    private $table_name;
    private $primary_key;
    public function __construct() {
        $this->table_name  =  'ad_logs';
        $this->primary_key = 'id';
    }

    public function getIndex(Request $request){
        $data = [];
        $datA['page_title'] = 'Logs';
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(CommonHelpers::adminPath(), 'Denied Access');
        }

        $data['logs'] = AdLogs::getData();
        return view('admin/logs/logs',$data);
    }


}

?>