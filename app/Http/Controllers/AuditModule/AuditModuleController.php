<?php

                namespace App\Http\Controllers\"AuditModule"; 
                use App\Helpers\CommonHelpers;
                use App\Http\Controllers\Controller;
                use Illuminate\Http\Request;
                use Illuminate\Http\RedirectResponse;
                use Illuminate\Support\Facades\Auth;
                use Illuminate\Support\Facades\Session;
                use DB;
        
                class AuditModuleController extends Controller{
                    public function getIndex(){
                        return view("audit-module/audit-module-content");
                    }
                }
                ?>