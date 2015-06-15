<?php
namespace App\Http\Controllers;
use App;
use Request;
use App\Books as Books;
use App\Categories as Categories;

class BooksController extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->title= 'Books';
        $this->middleware('guest', ['except' => 'getLogout']);
    }

  
   
    public function index()
{       $books = Books::all();
        if(Request::input('books'))
        { 
        $authors = Books::find(Request::input('books'))->authors;
        $categories = Books::find(Request::input('books'))->categories;
         return view('books')->with('books',$books )->with('authors', $authors)->with('categories', $categories);
        }
        
        if(isset($_POST['sql'])){
        $books = new Books;
        $result = $books->getAuthorsAndCategoriesBySQL(Request::input('sql'));
        echo json_encode($result);
        return;
    }
        return view('books')->with('books', $books);

}



    
}
