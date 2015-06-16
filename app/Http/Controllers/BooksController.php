<?php
namespace App\Http\Controllers;
use App;
use Request;
use App\Books as Books;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Categories as Categories;

class BooksController extends Controller
{
    public $books;
    public function __construct()
    {
        $this->books=Books::all();
        parent::__construct();
        $this->title= 'Books';
        $this->middleware('guest', ['except' => 'getLogout']);
    }

  
   
    public function index()
{       
       return view('books')->with('books', $this->books);
}

public function getAuthorsCategories(){
    if(Request::input('books'))
        { 
        $authors = Books::find(Request::input('books'))->authors;
        $categories = Books::find(Request::input('books'))->categories;
         return view('books')->with('books',$this->books)->with('authors', $authors)->with('categories', $categories);
        }
        
        if(Request::input('sql')){
            $validate = \Validator::make( array('sql' => Request::input('sql')),
                             array('sql' => 'regex:/^[a-zA-Z]{4,10}_id\s=\s[0-9]+$/'));
         if(!$validate->fails())
         {   
        $books = new Books;
        $result = $books->getAuthorsAndCategoriesBySQL(Request::input('sql'));
        return response()->json($result);
        }
          else
            return;
    }
    
}



    
}
