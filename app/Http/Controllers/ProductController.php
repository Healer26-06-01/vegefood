<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{

    public function addproduct()
    {
        $categories = Category::ALL()->pluck('category_name', 'category_name');
        return view('admin.addproduct')->with('categories', $categories);
    }

    public function saveproduct(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_image' => 'image|nullable|max:1999',
        ]);

        if ($request->input('product_category')) {

            if ($request->hasFile('product_image')) {
                //1: Get filename with the extension
                $filenameWithExt = $request->file('product_image')->getClientOriginalName();

                //2: Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

                //3: Get just ext
                $extension = $request->file('product_image')->getClientOriginalExtension();

                //4: Filename to store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                //5: Upload Image
                $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
            } else {
                $fileNameToStore = 'noimage.jpg';
            }

            $product = new Product();
            $product->product_name = $request->input('product_name');
            $product->product_price = $request->input('product_price');
            $product->product_category = $request->input('product_category');
            $product->product_image = $fileNameToStore;
            $product->product_status = 1;

            $product->save();

            return redirect('/addproduct')->with('status', 'The product has been added successfully');

        } else {
            return redirect('/addproduct')->with('status1', 'The product has not been added successfully');
        }
    }

    public function products()
    {
        $products = Product::get();
        return view('admin.products')->with('products', $products);
    }

    public function editproduct($id)
    {
        $categories = Category::ALL()->pluck('category_name', 'category_name');
        $product = Product::find($id);
        return view('admin.editproduct')->with('product', $product)->with('categories', $categories);
    }

    public function updateproduct(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_image' => 'image|nullable|max:1999',
        ]);

        $product = Product::find($request->input('id'));

        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');

        if ($request->hasFile('product_image')) {
            //1: Get filename with the extension
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();

            //2: Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //3: Get just ext
            $extension = $request->file('product_image')->getClientOriginalExtension();

            //4: Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            //5: Upload Image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);

            // Get old image
            $old_image = Product::find($request->input('id'));

            if ($old_image->product_image != 'noimage.jpg') {
                // Delete old image
                Storage::delete('public/product_images/' . $old_image->product_image);
            }
            $product->product_image = $fileNameToStore;
        }
        $product->update();
        return redirect('/products')->with('status', 'Product updated successfully');

    }
    public function deleteproduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products')->with('status', 'Product deleted successfully');
    }

    public function activeproduct($id)
    {
        $product = Product::find($id);
        $product->product_status = 1;
        $product->update();
        return redirect('/products')->with('status', 'Product status updated successfully');
    }

    public function unactiveproduct($id)
    {
        $product = Product::find($id);
        $product->product_status = 0;
        $product->update();
        return redirect('/products')->with('status', 'Product status updated successfully');
    }

}
