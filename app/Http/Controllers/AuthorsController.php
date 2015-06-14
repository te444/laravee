<?php
namespace App\Http\Controllers;
use App;
use App\Authors as Authors;

class AuthorsController extends Controller
{
    
    public function __construct()
    {   parent::__construct();
        $this->title= 'Authors';
        $this->middleware('guest', ['except' => 'getLogout']);
    }

  
   
    public function index()
{       $authors = Authors::all();
        if(isset($_POST['authors']))
        {
           $books= $this->hasPost();
        return view('authors')->with('authors', $authors)
                ->with('books', $books);
        }
        return view('authors')->with('authors', $authors);

}

private function hasPost(){
    
     $books = Authors::find($_POST['authors'])->books;
    return $books;
}

public function bilderPost(){
   if($_POST['sql']){
        $authors = new Authors;
        
        $books= $authors->sqlBooks($_POST['sql']);
       
    } 
}
    
}
