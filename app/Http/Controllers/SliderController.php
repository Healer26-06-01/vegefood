<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{

    public function addslider()
    {
        return view('admin.addslider');
    }

    public function saveslider(Request $request)
    {
        $this->validate($request, [
            'description_one' => 'required',
            'description_two' => 'required',
            'slider_image' => 'image|nullable|max:1999',
        ]);

        if ($request->hasFile('slider_image')) {
            //1: Get filename with the extension
            $filenameWithExt = $request->file('slider_image')->getClientOriginalName();

            //2: Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //3: Get just ext
            $extension = $request->file('slider_image')->getClientOriginalExtension();

            //4: Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            //5: Upload Image
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $slider = new Slider();
        $slider->description1 = $request->input('description_one');
        $slider->description2 = $request->input('description_two');
        $slider->slider_image = $fileNameToStore;
        $slider->slider_status = 1;

        $slider->save();

        return redirect('/addslider')->with('status', 'The slider has been added successfully');

    }

    public function sliders()
    {
        $sliders = Slider::get();
        return view('admin.sliders')->with('sliders', $sliders);
    }

    public function editslider($id)
    {
        $slider = Slider::find($id);
        return view('admin.editslider')->with('slider', $slider);
    }

    public function updateslider(Request $request)
    {
        $this->validate($request, [
            'description_one' => 'required',
            'description_two' => 'required',
            'slider_image' => 'image|nullable|max:1999',
        ]);

        $slider = Slider::find($request->input('id'));

        $slider->description1 = $request->input('description_one');
        $slider->description2 = $request->input('description_two');

        if ($request->hasFile('slider_image')) {
            //1: Get filename with the extension
            $filenameWithExt = $request->file('slider_image')->getClientOriginalName();

            //2: Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //3: Get just ext
            $extension = $request->file('slider_image')->getClientOriginalExtension();

            //4: Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            //5: Upload Image
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);

            // Get old image
            $old_image = Slider::find($request->input('id'));

            if ($old_image->slider_image != 'noimage.jpg') {
                // Delete old image
                Storage::delete('public/slider_images/' . $old_image->slider_image);
            }
            $slider->slider_image = $fileNameToStore;
        }
        $slider->update();
        return redirect('/sliders')->with('status', 'Slider updated successfully');
    }

    public function deleteslider($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        return redirect('/sliders')->with('status', 'The slider has been deleted successfully');
    }

    public function activeslider($id)
    {
        $slider = Slider::find($id);
        $slider->slider_status = 1;
        $slider->save();
        return redirect('/sliders')->with('status', 'The slider has been activated successfully');
    }

    public function unactiveslider($id)
    {
        $slider = Slider::find($id);
        $slider->slider_status = 0;
        $slider->save();
        return redirect('/sliders')->with('status', 'The slider has been unactivated successfully');
    }

}
