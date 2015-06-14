<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use View;

abstract class Controller extends BaseController {
protected $styles = array('css/bootstrap.css',
                        'css/query-builder.css');
protected $scripts = array('scripts/jquery.js',
                        'scripts/jQuery.extendext.js',
                        'scripts/moment.js',
                        'scripts/query-builder.js' );
protected $title = "";

        public function __construct(){
            View::composer('app', function($view){
            $view->with('styles', $this->styles)
            ->with('scripts', $this->scripts)
            ->with('title', $this->title);
            });


}
}