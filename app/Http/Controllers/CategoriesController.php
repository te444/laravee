<?php
namespace App\Http\Controllers;
use Request;
use App;
use App\Categories as Categories;
class CategoriesController extends Controller
{
    
    public function __construct()
    {   parent::__construct();
        $this->title= 'Categories';
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function index()
{   
        $categories = Categories::all();
       
        if(Request::input('categories')){
        $books = Categories::find(Request::input('categories'))->books;
        return view('categories')->with('categories', $categories)
                ->with('books', $books);
        }
        
        if(Request::input('sql')){
        $categories = new Categories;
        $books= $categories->getBooksbySQL(Request::input('sql'));
        echo json_encode($books);
        return;
       
    } 
        
        return view('categories')
                ->with('categories', $categories);

}

}

