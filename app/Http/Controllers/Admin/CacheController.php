<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CacheController extends Controller
{
    public function flushcache()
    {
        try{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.abraa.com/cacheflush');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 1);
            curl_exec($ch);

            $message = 'Cache Has Been Flushed successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
        catch(\Exception $e){
            $message = 'Oops Problem Flushing the cache';
            session()->flash('error', 'true');
            session()->flash('feedback_title', 'Error');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
        
    }
}
