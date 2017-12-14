<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class taskController extends Controller
{
    public function fillbook()
    {

     return view('bookfilldata');
    }


    public function fillbooksubmit(Request $data) {

      $bookdata=$data->all();
            
              //dd($bookdata);

            
             $bookdatafillevent = new Task();

             $bookdatafillevent->Book_name   = $data ->book_name;
             $bookdatafillevent->Publication = $data ->publish_name;     
			 $bookdatafillevent->environementry_count = $data ->environementry_count;

              if($bookdatafillevent->save())
              {
                                   

 //$last_insert_id = \Response::json(array('success' => true,'last_insert_id' => $bookdatafillevent->id), 200)->getData()->last_insert_id;

 
      
          
            return redirect()->route('showbookdetail');
        } 
        else 
        {
              return \Response::json('fail', 404);
        }

}


 public function showbooksubmit()
    {
    	$client=DB::table('task')
    			->get();

     return view('submitbookdata',['client'=>$client]);
    }

 public function deletebooksubmit($id)
    {
    	$bookid=$id;
    	$client1=DB::table('task')
    			->where('Book_id', '=',$id)
    			->delete();

    	$client=DB::table('task')
    			->get();

     return redirect()->route('showbookdetail');
    }

public function editbooksubmit($id)
    {
    	$bookid=$id;
return view('editbookdata',['client'=>$bookid]);

    /*	$client=DB::table('task')
    			->where('Book_id', '=',$id)
    			->update();

    	
     return view('submitbookdata',['client'=>$client]);*/
    }
  


public function editbookdatasubmit(Request $data)
    {
    	$bookdata=$data->all();
    	$id= $data ->Book_id;
    	$name= $data ->book_name;
    	$publish=$data ->publish_name ;
    	$no= $data ->environementry_count;

//return view('editbookdata',['client'=>$bookid]);

// DB::update('update into task (Book_id,Book_name,Publication,environementry_count ) values (?,?,?,?)', [ $id , $name , $publish , $no] );


    	DB::table('task')
    			->where('Book_id', '=',$id)
    			->update([
    				'Book_name' =>$name,
    			 	'Publication'=>$publish,
    				'environementry_count'=>$no
    				]);

  $client=DB::table('task')
    			->get();

     return view('submitbookdata',['client'=>$client]);
    }

    }



