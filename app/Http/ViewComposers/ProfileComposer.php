<?php
namespace App\Http\ViewComposers;

use Auth;
use Illuminate\View\View;
class ProfileComposer

{

    protected $access_level;

    public function __construct()
    {
        $access_level = Auth::user()->access_level;
        $this->access_level = $access_level;
    }

    /**
    * Bind data to the view.
    *
    * @param  View  $view
    * @return void
    */
    public function compose(View $view)
    {
        print_r($this->access_level); exit();
        $view->with('access_level', $this->access_level);
    }
}
