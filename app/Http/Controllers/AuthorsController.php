<?php
namespace App\Http\Controllers;
use App;
use Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Authors as Authors;
use Illuminate\Validation\Validator;

class AuthorsController extends Controller
{
    public $authors;
    
    public function __construct()
     { 
        $this->authors = Authors::all();    
         parent::__construct();
        $this->title= 'Authors';
        $this->middleware('guest', ['except' => 'getLogout']);
    }

  
   
    public function index()
    {  
        return view('authors')->with('authors', $this->authors);
    }

    public function getBooks()
  {
     if(Request::input('authors'))
        {
            $books = Authors::find(Request::input('authors'))->books;
         return view('authors')->with('authors', $this->authors)
                ->with('books', $books);
        }
        
        if(Request::input('sql')){
        $validate = \Validator::make( array('sql' => Request::input('sql')),
                             array('sql' => 'regex:/^[a-zA-Z]{4,10}_id\s=\s[0-9]+$/'));
            if(!$validate->fails())
            {      
           $authors = new Authors;
           $books= $authors->getBooksbySQL(Request::input('sql'));
           return response()->json($books);
            }
             else
               return;
        } 
    
}





}
