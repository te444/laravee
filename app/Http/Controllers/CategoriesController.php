<?php
namespace App\Http\Controllers;
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
       
        if(isset($_POST['categories'])){
        $books = $this->hasPost();
        return view('categories')->with('categories', $categories)
                ->with('books', $books);
        }
        
        return view('categories')
                ->with('categories', $categories);

}

private function hasPost(){
    
     $books = Categories::find($_POST['categories'])->books;
    return $books;
    
}

public function bilderPost(){
   if($_POST['sql']){
        $categories = new Categories;
        
        $books= $categories->sqlBooks($_POST['sql']);
       
    } 
}

}

