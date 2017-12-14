@extends('layouts.app')
@section('content')

<script src='vendor/assets/lib/jquery.min.js'></script>

	<div class="container-fluid" style="padding-left: 270px">
	
<table class="table table-striped table-bordered table-success table-sm	" style="border:1px solid black; border-collapse: collapse;width:100%">
		<thead class="thead-inverse" style="background-color: #dff0d8">
	  <tr>      
		<th style="padding: 3px;border-bottom: 1px solid black;">Book name</th>
		<th style="padding: 3px;border-bottom: 1px solid black;">Publication Name</th>
        <th style="padding: 3px;border-bottom: 1px solid black;">Environmentory number</th>
		<th style="padding: 3px;border-bottom: 1px solid black;"></th>
		<th style="padding: 3px;border-bottom: 1px solid black;"></th>
</tr>
</thead>	

 @foreach($client as $Clients)
	    
	  <tr>
	   <th style="padding: 3px;border-bottom: 1px solid black;">{{$Clients->Book_name}}</th>
	    <th style="padding: 3px;border-bottom: 1px solid black;">{{ $Clients->Publication }}</th>
	     <th style="padding: 3px;border-bottom: 1px solid black;">{{ $Clients->environementry_count}}</th>
		<th style="padding: 3px;border-bottom: 1px solid black;">
			
			<a href="{{('editbookdata/'. $Clients->Book_id)}}"> 
 <i class="fa fa-pencil "></i>
 </a>
		</th>
		<th style="padding: 3px;border-bottom: 1px solid black;">
			
			<a href="{{('deletebookdata/'. $Clients->Book_id)}}"> 
 <i class="fa fa-trash"></i>
 </a>
		</th>
	    
		  
	  </tr>
@endforeach	  
	  </table>
	  <h1></h1>
	

	</div>


