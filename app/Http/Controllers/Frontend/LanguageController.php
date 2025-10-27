<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
   /*=================== Start Bangla Methoed ===================*/
      public function Bangla(){
         session()->get('language');
         session()->forget('language');
         Session::put('language','bangla');

         Session::flash('success','Language Updated Successfully.');
         return redirect()->back();
    }
   /*=================== End Bangla Methoed ===================*/

   /*=================== Start English Methoed ===================*/
    public function English(){
         session()->get('language');
         session()->forget('language');
         Session::put('language','english');

         Session::flash('success','Language Updated Successfullyy.');
         return redirect()->back();
    }
   /*=================== End English Methoed ===================*/
}

