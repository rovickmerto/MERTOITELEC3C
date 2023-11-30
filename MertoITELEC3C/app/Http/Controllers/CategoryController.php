<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $retrieve = Category::withTrashed()
            ->whereNotNull('deleted_at') 
            ->orderBy('id', 'desc')->get();
        return view('admin.category.category', compact(['categories', 'retrieve']));
    
    }

    public function retrieve(Request $request){
        $id = $request->query('id');

        $db = Category::withTrashed()->find($id);

        if($db){
            $db->restore();
        }

        return Redirect()->back();
    }

    public function delete(Request $request){

        $id = $request->query('id');

        $db = Category::where('id',$id)->first();

        $db->delete();
        
        return Redirect()->back();

    }

    public function edit(Request $request){
        $id = $request->input('id');

        $db = Category::where('id',$id)->first();

       
        $file = $request->file('image');

        $filename = time(). '-'. $file->getClientOriginalName();
        $uploadPath = public_path('images');
        $filePath = "images/". $filename;
        
        $file->move($uploadPath, $filename);

    

        $db->category_name = $request->input('category_name');
        $db->image = $filePath;
        
      

        $db->save();

        return redirect()->route('AllCat');
    }

    public function store(Request $request)
    {

        $file = $request->file('image');

        $filename = time(). '-'. $file->getClientOriginalName();
        $uploadPath = public_path('images');
        $filePath = "images/". $filename;
        
        $file->move($uploadPath, $filename);

        $category = new Category();

        $category->category_name = $request->input('category_name');
        $category->image = $filePath;
        
        $category->user_id = Auth::id(); // Assuming you're using authentication and want to associate the logged-in user's ID

        $category->save();

        return redirect()->route('AllCat');
    }
}