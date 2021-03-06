<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Models
//use App\Models\Category;
//use App\Models\Page;


/*

Categories = name
Pages    = title
Users    = name
*/


class ListController extends Controller
{
    
    public function index(Request $request) {
        
        $type = $request->segment(2);
        $field = $request->segment(3);
        
        $search = $request->input('q');
        $id = $request->input('id');
        
        /*        \DB::enableQueryLog();*/
        
        //TODO take a condition request and gives 20 at max results
        //Now DANGER returns all data and no AUTH yet
        $db = \DB::table($type)
            ->select( ['id', \DB::raw("$field as text") ] )
            ->orWhere($field, 'like', "$search%");
        
        if(!empty($id))
        		$db->where('id', $id);
        
        return $db->take(20)
       			 ->get();
        
    }
    
    
}
