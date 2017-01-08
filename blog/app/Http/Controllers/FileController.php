<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;

class FileController extends Controller
{
    public function changeparameter(Request $request){
        $parameter = Input::get('parameter');
        
        $folder = 'about-' . $parameter;
        $path = base_path('changeparameter/' . $folder . '/');
        File::makeDirectory($path, 0777, true, true);    
        
       
        $newpath = $path . 'newparameter.java';
        
        //$change->setValue('android',$parameter);
        //$change->saveAs($newpath);
        
        $str = File::copy(base_path('changeparameter/AboutPreferences.java'),$newpath);
        
        $content = file_get_contents($newpath);
        
        $content = preg_replace('/android/', $parameter, $content);
        
        file_put_contents($newpath, $content);
        
        return redirect('/done');
    }
}
