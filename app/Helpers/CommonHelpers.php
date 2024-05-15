<?php

namespace app\Helpers;

use Cache;
use DB;
use Image;
use Request;
use Route;
use Schema;
use Session;
use Storage;
use Validator;

class CommonHelpers {

    public static function isSuperadmin(){
        return Session::get('admin_is_superadmin');
    }

    public static function myPrivilegeId()
    {
        return Session::get('admin_privileges');
    }
}