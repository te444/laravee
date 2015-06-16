<?php
namespace App\Http\Controllers;
use Request;
use App;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Categories as Categories;
class CategoriesController extends Controller
{
    public $categories;
    public function __construct()
     { 
        $this->categories = Categories::all();
        parent::__construct();
        $this->title= 'Categories';
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function index()
{   
        $categories = Categories::all();
      return view('categories')->with('categories', $this->categories);

}

  public function getBooks(){
      
       if(Request::input('categories')){
        $books = Categories::find(Request::input('categories'))->books;
        return view('categories')->with('categories', $this->categories)
                ->with('books', $books);
        }
        
        if(Request::input('sql')){
        $validate = \Validator::make( array('sql' => Request::input('sql')),
                             array('sql' => 'regex:/^[a-zA-Z]{4,10}_id\s=\s[0-9]+$/'));
     if(!$validate->fails())
        {      
        $categories = new Categories;
        $books= $categories->getBooksbySQL(Request::input('sql'));
        return response()->json($books);
        }
          else
            return;
    } 
        
      
  }

}

