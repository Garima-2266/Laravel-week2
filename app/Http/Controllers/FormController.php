<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Form;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::get();
        return view('forms.index', ['forms' => $forms]);
        // return view('forms.index',['forms'=>Form::get()]);
    }

    public function create()
    {
        return view('forms.create');
    }

    public function store(Request $request)
    {
        //validating data
        // dd($request);
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:forms',
                'description' => 'required',
                'password' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
            ]);

            // //uploading the image
            // // dd($request->all());
            // $imageName= time().'.'.$request->image->extension();
            // $request->image->move(public_path('forms'),$imageName);
            // // dd($imageName);

            $hashedPassword = Hash::make($request->password);

            $form = new Form;
            $form->name = $request->name;
            $form->email = $request->email;
            $form->password = $hashedPassword;
            $form->description = $request->description;
            // $form->image=$imageName;
            $form->save();

            $form->updatePhoto($request->image);

        } catch (\Exception $e) {
            // dd($e->getMessage());
            \Log::error('Error occurred while storing form data: ' . $e->getMessage());
            return back()->withError('An error occurred while processing the form. Please try again later.');
        }
        return back()->withSuccess('Form created successfully!');
    }

    public function edit($id)
    {
        // dd($id);
        $form = Form::findOrFail($id);
        return view('forms.edit', ['form' => $form]);
    }

    public function update(Request $request, $id)
    {
        // dd($id);
        // dd($request->all());

        //validating data
        try {
            $form = Form::findOrFail($id);

            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:forms',
                'description' => 'required',
                'password' => 'required',
                'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'
            ]);
            // $form=Form::where('id',$id)->first();
            if (isset($request->image)) {
                //     // //uploading the image
                //     // dd($request->all());
                //     // $imageName= time().'.'.$request->image->extension();
                //     // $request->image->move(public_path('forms'),$imageName);
                //     // // // dd($imageName);
                $form->updatePhoto($request->image);
            }
            // // dd($imageName);
            // $form = new Form;
            $form->name = $request->name;
            $form->email = $request->email;
            $form->password = $request->password;
            $form->description = $request->description;
            // $form->image=$imageName;
            $form->save();
            // dd($form);

        } catch (\Exception $e) {
            // dd($e->getMessage());
            \Log::error('Error occurred while storing form data: ' . $e->getMessage());
            return back()->withError('An error occurred while processing the form. Please try again later.');
        }
        return back()->withSuccess('Form updated successfully!');
    }

    public function destroy($id)
    {
        try {
            $form = Form::findOrFail($id); // Retrieve the form by ID or throw a ModelNotFoundException
            $form->delete();
        } catch (\Exception $e) {
            \Log::error('Error occurred while deleting form data: ' . $e->getMessage());
            return back()->withError('An error occurred while deleting the form. Please try again later.');
        }
        // dd($request->all());
        // $form=Form::where('id',$id)->first();
        return back()->withSuccess('Form deleted successfully!');
    }

    public function show($id)
    {
        $form = Form::findOrFail($id);
        return view('forms.show', ['form' => $form]);
    }
}
