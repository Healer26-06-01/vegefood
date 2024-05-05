<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{

    public function addcategory()
    {
        return view('admin.addcategory');
    }

    public function savecategory(Request $request)
    {
        $checkcat = Category::where('category_name', $request->input('category_name'))->first();

        $category = new Category();
        if ($request->input('category_name') == null) {
            return redirect('/addcategory')->with('status2', 'Category name cannot be empty');
        }
        if (!$checkcat) {
            $category->category_name = $request->input('category_name');
            $category->save();
            return redirect('/addcategory')->with('status', 'Category added successfully');
        } else {
            return redirect('/addcategory')->with('status1', 'Category already exists');
        }

    }

    public function categories()
    {
        $categories = Category::get();
        return view('admin.categories')->with('categories', $categories);
    }

    public function editcategory($id)
    {
        $category = Category::find($id);
        return view('admin.editcategory')->with('category', $category);
    }

    public function updatecategory(Request $request)
    {
        $category = Category::find($request->input('id'));
        $oldcat = $category->category_name;

        $category->category_name = $request->input('category_name');

        DB::table('products')->where('product_category', $oldcat)->update(['product_category' => $request->input('category_name')]);

        $category->update();
        return redirect('/categories')->with('status', 'Category updated successfully');
    }

    public function deletecategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/categories')->with('status', 'Category deleted successfully');
    }

}
