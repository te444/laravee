<?php
namespace App\Http\Controllers;
use App;
use Request;
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

        if(Request::input('authors'))
        {
          $books = Authors::find(Request::input('authors'))->books;
         return view('authors')->with('authors', $authors)
                ->with('books', $books);
        }
        
        if(Request::input('sql')){
        $authors = new Authors;
        $books= $authors->getBooksbySQL(Request::input('sql'));
        echo json_encode($books);
        return;
        } 
        
        
        return view('authors')->with('authors', $authors);

}



    
}
