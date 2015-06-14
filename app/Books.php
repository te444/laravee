<?php

namespace App;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
     public function authors()
    {
        return $this->belongsToMany('App\authors');
    }
     public function categories()
    {
        return $this->belongsToMany('App\categories');
    }
    
    
    public function sqlAuthorsAndCategories($query){
    $authors = DB::select("SELECT first_name,last_name FROM authors WHERE id IN
   (SELECT authors_id FROM authors_books where $query)");
        $categories = DB::select("SELECT name FROM categories WHERE id IN
   (SELECT categories_id FROM books_categories where $query)");

 $results =array_merge($categories, $authors);
   echo json_encode($results);
}
}
