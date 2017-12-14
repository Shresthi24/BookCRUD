<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\dbmodel\areamaster;
use App\dbmodel\schoolmaster;
use App\dbmodel\statemaster;
use App\dbmodel\citymaster;
use App\dbmodel\system;
use App\dbmodel\countrymaster;
use App\User;
use App\dbmodel\languagetext;
use Carbon\Carbon;
use App\Http\common\GeneralQueries;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
Route::get('/', function (){
    
    return view ('auth.login');
    
}); 


Auth::routes();





Route::get('postreg',[
  'as'=>'bookdata',
  'uses'=>'taskController@fillbook'
  ]);

Route::post('bookdatasubmit',[
  'as'=>'bookdatasubmit',
  'uses'=>'taskController@fillbooksubmit'
  ]);

Route::get('showbookdetail',[
  'as'=>'showbookdetail',
  'uses'=>'taskController@showbooksubmit'
  ]);

Route::get('bookdatasubmit',[
  'as'=>'bookdatasubmit',
  'uses'=>'taskController@fillbooksubmit'
  ]);

Route::get('editbookdata/{id}','taskController@editbooksubmit');

Route::get('deletebookdata/{id}','taskController@deletebooksubmit');

Route::post('editbookdatasubmit',[
'as'=>'editbookdatasubmit',
  'uses'=>'taskController@editbookdatasubmit']);




Route::get('bookingdata',[
  'as'=>'bookingdata',
  'uses'=>'BookingController@DisplayData2'
  ]);




Route::get('clientdata', function (){
    
   
    return view('clientdata');
    
}); 

Route::get('/abc', function (){
    
    return view ('abc');
    
}); 

Route::get('personal', function (){
    
    return view ('personaldata');
    
});

//client
Route::get('infotoclient',[
  'as'=>'infotoclient',
  'uses'=>'clientrequestController@vendor'
  ])->middleware('authenticated');

/*Route::get('avaliablity/{id}',[
  'as'=>'avaliablity/{id}',
  'uses'=>'clientrequestController@calenderview'
  ])->middleware('authenticated'); */

Route::get('clientpersonaldata/{id}','clientrequestController@create')->middleware('authenticated');
  
/*Route::post('cclientdatesubmit',[
  'as'=>'clientdatesubmit',
  'uses'=>'clientrequestController@requestdatesubmit'
  ])->middleware('authenticated');
*/


Route::post('clientrequestsubmit',[
  'as'=>'clientrequestsubmit',
  'uses'=>'clientrequestController@requestsubmit'
  ])->middleware('authenticated');


//vendor
Route::get('home',[
  'as'=>'home',
  'uses'=>'VendordataController@create'
  ])->middleware('isVendorInSubmitted');


Route::post('storevendorcompanydata',[
  'as'=>'storevendorcompanydata',
  'uses'=>'VendordataController@store'
  ])->middleware('authenticated');

Route::post('companystore',[
  'as'=>'companystore',
  'uses'=>'VendordataController@storedata'
  ])->middleware('authenticated');

Route::post('vendorpaymentdata',[
  'as'=>'vendorpaymentdata',
  'uses'=>'VendordataController@storepaymentdata'
  ])->middleware('authenticated');

//dashboard booking  menu description

 

    Route::get('book',[
  'as'=>'book',
  'uses'=>'BookingController@booking'
  ])->middleware('authenticated');



//not neccessary
Route::get('bookingdatafetch',[
  'as'=>'bookingdatafetch',
  'uses'=>'BookingController@DisplayData'
  ])->middleware('authenticated');
//neccessart
Route::get('requestevents',[
  'as'=>'requestevents',
  'uses'=>'BookingController@DisplayDataclick'
  ])->middleware('authenticated')->middleware('authenticated');

Route::get('confirmevent',[
  'as'=>'confirmevent',
  'uses'=>'BookingController@confirmedddata'
  ])->middleware('authenticated');


Route::get('completeevent',[
  'as'=>'completeevent',
  'uses'=>'BookingController@completeddata'
  ])->middleware('authenticated');

Route::get('requesteventaccept/{id}','BookingController@acceptrequest')->middleware('authenticated');

Route::get('requesteventreject/{id}','BookingController@rejectrequest')->middleware('authenticated');


 //revenue
  Route::get('rev',[
  'as'=>'rev',
  'uses'=>'revenueController@revenues'
  ])->middleware('authenticated');

Route::get('revenuedatafetchbyclick',[
  'as'=>'revenuedatafetchbyclick',
  'uses'=>'revenueController@getrevenuemonthly'
  ])->middleware('authenticated');

Route::get('revenuedatafetchtotal',[
  'as'=>'revenuedatafetchtotal',
  'uses'=>'revenueController@getrevenuetotal'
  ])->middleware('authenticated');


//customer
   Route::get('cus',[
  'as'=>'cus',
  'uses'=>'customerController@customers'
  ])->middleware('authenticated');

Route::get('customerreview',[
  'as'=>'customerreview',
  'uses'=>'customerController@getreview'
  ])->middleware('authenticated');
 
 //dashboard

Route::get('show',[
  'as'=>'show',
  'uses'=>'dashboardController@dashboard'
  ])->middleware('authenticated');


Route::get('eventrequest',[
  'as'=>'eventrequest',
  'uses'=>'dashboardController@geteventrequest'
  ])->middleware('authenticated');

   //utilisation

 Route::get('utilize',[
  'as'=>'utilize',
  'uses'=>'utilizationController@utilization'
  ])->middleware('authenticated')->middleware('authenticated');

  //  payment

  

      Route::get('pay',[
  'as'=>'pay',
  'uses'=>'paymentController@payments'
  ])->middleware('authenticated');

      Route::get('payment',[
  'as'=>'payment',
  'uses'=>'paymentController@DisplayData'
  ])->middleware('authenticated');


      Route::get('completePaymentdata',[
  'as'=>'completePaymentdata',
  'uses'=>'paymentController@completePayment'
  ])->middleware('authenticated');


      Route::get('totalPaymentdata',[
  'as'=>'totalPaymentdata',
  'uses'=>'paymentController@getpaymenttotal'
  ])->middleware('authenticated');

//calender

Route::get('cal',[
  'as'=>'cal',
  'uses'=>'calenderController@getCalendar'
  ])->middleware('authenticated');

//naming is IMP!
Route::post('deleteCalEvent',[
  'as'=>'deleteCalEvent',
  'uses'=>'calenderController@DeleteCalenderEvent'
  ])->middleware('authenticated');

Route::get('Calender',[
  'as'=>'Calender',
  'uses'=>'calenderController@calenders'
  ])->middleware('authenticated');

  

//Auth::routes();
//Route::resource('cal','gCalenderController');
//Route::get('oauth','gCalenderController@oauth');

   



/*ajax upload filesdocplicant */

Route::post('ajaxuploadappbirthfile', ['uses'=>'FileUpload@ajaxUserDocUploadPost'])->name('uploadbirthcert'); //birth certificate
Route::post('ajaxuploadappadharfile', ['uses'=>'FileUpload@ajaxUserAdharUploadPost'])->name('ajaxappadharcardupload'); //applicantAadharCard
Route::post('ajaxuploadappdisabilityfile', ['uses'=>'FileUpload@ajaxUserDisabilitycertUploadPost'])->name('ajaxappdisabilitycertupload'); //disabilityCertificate
Route::post('ajaxuploadappleavingfile', ['uses'=>'FileUpload@ajaxUserleavingcertUploadPost'])->name('ajaxleavingcertupload'); //leavingCertificate
Route::post('ajaxuploadappuserfile', ['uses'=>'FileUpload@ajaxUsermarksheetUploadPost'])->name('ajaxmarksheetupload'); //marksheet
Route::post('ajaxuploadappcastefile', ['uses'=>'FileUpload@ajaxUsercastecertUploadPost'])->name('ajaxcastecertupload'); //casteCertificate




/*ajax upload filesdoc  father */
Route::post('ajaxuploadfatheradharcard', ['uses'=>'FileUploadFather@ajaxFatherAdharUploadPost'])->name('ajaxFatherAdharUploadPost'); 
Route::post('ajaxuploadfatherAddrsProof', ['uses'=>'FileUploadFather@ajaxFatherAddrssProofUploadPost'])->name('ajaxFatherAddrssProofUploadPost'); 
Route::post('ajaxuploadfatherIdentityProof', ['uses'=>'FileUploadFather@ajaxFatherIdentityProofUploadPost'])->name('ajaxFatherIdentityProofUploadPost'); 


/*ajax mother doc upload */
Route::post('ajaxuploadmotheradharcard', ['uses'=>'FileUploadMother@ajaxMotherAdharUploadPost'])->name('ajaxMotherAdharUploadPost'); 
Route::post('ajaxuploadmotherAddrsProof', ['uses'=>'FileUploadMother@ajaxMotherAddrssProofUploadPost'])->name('ajaxMotherAddrssProofUploadPost'); 
Route::post('ajaxuploadmotherIdentityProof', ['uses'=>'FileUploadMother@ajaxMotherIdentityProofUploadPost'])->name('ajaxMotherIdentityProofUploadPost'); 
