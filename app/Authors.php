<?php

namespace App;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    public function books()
    {
        return $this->belongsToMany('App\books');
    }
    
      public function sqlBooks($query)
    {
          $results = DB::select("SELECT name,description FROM books WHERE id IN
   (SELECT books_id FROM authors_books where $query)");

   echo json_encode($results);
}
}
