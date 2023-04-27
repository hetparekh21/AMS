<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sub_tech;

class subject extends Controller
{
    
    public static function update_teacher($subject_id , $teacher_id ){

        $sub_tech = sub_tech::where('subject_id',$subject_id)->first();
        $status = '' ;
        $message = '' ;

        if($sub_tech->count() == 0){
            // insert 
            $sub_tech = new sub_tech;
            $sub_tech->subject_id = $subject_id;
            $sub_tech->teacher_id = $teacher_id;
            $sub_tech->save();

            $status = 'success' ;
            $message = 'Teacher Assigned Successfully' ;
            
        }else{

            if($sub_tech->teacher_id == $teacher_id){

                $status = 'error' ;
                $message = 'Teacher Already Assigned' ;

            }else{

                $sub_tech->teacher_id = $teacher_id;
                $sub_tech->save();

                $status = 'success' ;
                $message = 'Teacher Assigned Successfully' ;

            }

        }

        return $notification = [$status,$message] ;

    }

    

}
