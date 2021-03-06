<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Contracts\Session\Session;

class CategoryController extends Controller
{
    //
    public static function index(){
        $cats = Category::getAll();
        if($cats) {
            return view('categories.index', ['categories' => $cats]);
        } else {
            abort(404);
        }
    }

    public static function show(Category $category){
        // dd($category);
        return view('categories.show', [
            'category' => $category,
        ]);  
    }

    public static function create(){
        // dd('create');
        if(request()->isMethod('post')){
            $data = request()->all();
            // dd($data);
            $cat = new Category();
            $cat->name = $data['name'];
            $cat->thumbnail='';
            $cat->save();
            // Session::flash('success', 'Category created successfully');
            return redirect('/categories')->with('message', 'Category created successfully');
        } else {
            return view('categories.create');
        }
    }
}
