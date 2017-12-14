@if(isset($error)&&($errors->all())>0)
<div class="alert alert-error">
    <a href="#" data-dismiss="alert">X</a>
    <h4 class="alert-heading">uh !oh</h4>
    <ul>
        @foreach($errors->('<li>:messages</li>') as $message)
        {{$message}}
      
         @endforeach
    </ul>
</div>
@endif