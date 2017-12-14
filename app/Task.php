<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
     protected $table = 'task';
   protected $fillable=[ 'Book_id', 'Book_name', 'Publication ', 'environementry_count',];
    protected $primaryKey= "Book_id" ;
    public $timestamps = false;
}
