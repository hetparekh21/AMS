<?php

namespace App\Http\Controllers\apis;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\dynamic_mapper;
use Illuminate\Http\Request;

class dynamic_qr extends Controller
{
    
    public function dynamic_qr(Request $request,$class_code)
    {
        date_default_timezone_set('Asia/Kolkata');

        // insert
        $dynamic_mapper = new dynamic_mapper;
        $dynamic_mapper->class_code = $class_code;
        $dynamic_mapper->dynamic_code = get_unique_code($class_code);
        $dynamic_mapper->Timestamp = now();
        $dynamic_mapper->save();

        // return code
        // return response()->json(['code' => $dynamic_mapper->dynamic_code]);

        // return QrCode::size(300)->generate(route('student.mark.attendance',$class_code) . "/" . $dynamic_mapper->dynamic_code) ;

        // return '<img class="img-thumbnail" src="' . QrCode::size(300)->generate(route('student.mark.attendance',$class_code) . "/" . $dynamic_mapper->dynamic_code) . '" />';

        return QrCode::size(300)->generate(route('student.mark.attendance',[$class_code,$dynamic_mapper->dynamic_code]));

    }

}

function get_unique_code($class_code): string
{

    $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

    $result = dynamic_mapper::where('class_code', $class_code)->where('dynamic_code',$code)->get('class_code');

    if (!$result->isEmpty()) {

        $code =  get_unique_code($class_code);
    } else {

        return $code;
    }

    return $code;
}