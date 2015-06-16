<?php

namespace App;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
   public function books()
    {
        return $this->belongsToMany('App\books');
    }
    
    
    public function getBooksbySQL($query)
    {
        
          $results = DB::select("SELECT name,description FROM books WHERE id IN
   (SELECT books_id FROM books_categories where $query)");


   return $results;
}
}