<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Fullcalender;
use Illuminate\http\Request;
USE Illuminate\Support\Facades\Redirect;
use Auth;
use App\calender;

class calenderController extends Controller
{


    public function calenders()
    {

        return view('asd');
    }
    //
public function getCalendar()
    {
        $getvendorid=Auth::user()->id;
       
       $events=DB::table('fullcalenders')
        ->where('Vendor_id','=',$getvendorid)
        ->where('fullcalenders.start_confirmed_date' ,'>',date('Y-m-d'))
        ->get();


        //dd($events);
        //$events = Fullcalender::all();
              $calenderEventsdata = [];
// not necassary u can pass it directly remove it
              /*
                 foreach ($events as  $eve) {
            $calenderEventsdata[] = [
                'title' => $eve->event_name .' by '. $eve->client_id,
                'id' => $eve->event_id,
                'start' => $eve->start_confirmed_date,
                'end'   => $eve->end_confirmed_date,
       ];
        }
*/
         // u have converted $events it collection to array by doing for each blade don recognise array but only collection
   

//return View ('asd')
  //    ->with('calenderEventsdata',$events);

return \Response::json($events, 200);
         
    }

    
     
     public function DeleteCalenderEvent(Request $data)

    {
      $DataArray=$data->all();
            //not necessary to use find or fail
     $calendar_event = Fullcalender::find($DataArray['data']);
     $calendar_event->delete();

                
    return \Response::json($DataArray['data'], 200);
    }
  }
        
          




