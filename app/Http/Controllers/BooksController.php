<?php
namespace App\Http\Controllers;
use App;
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
        
        if(isset($_POST['books']))
        {
           $arr= $this->hasPost();
        return view('books')->with('books',$books )->with('authors', $arr[0])->with('categories', $arr[1]);
        }
        return view('books')->with('books', $books);

}

public function hasPost(){
    $authors = Books::find($_POST['books'])->authors;
    $categories = Books::find($_POST['books'])->categories;
    return array($authors,$categories);
}



public function bilderPost(){
   if($_POST['sql']){
       
        $books = new Books;
        $result= $books->sqlAuthorsAndCategories($_POST['sql']);
       
       
    } 
}
    
}
