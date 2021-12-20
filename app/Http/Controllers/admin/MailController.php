<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MailController extends Controller
{
    public function editor(){
        return view('admin.emails.editors');
    }
}
