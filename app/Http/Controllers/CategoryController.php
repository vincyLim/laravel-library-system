<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    private function validateCategory(Request $request, $id = null)
    {
        $rules = ['name' => 'required|unique:categories,name' . ($id ? ',' . $id : ''),
                  'icon' => ($id ? 'nullable' : 'required') . '|image|mimes:png,jpeg,jpg,svg|max:2048',
    ];
        return $request->validate($rules);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('category/viewCategory', ['categories' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('category/createCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateCategory($request);
        $path = $request->icon->store('icons', 'public');
        $validatedData['icon'] = $path;

        Category::create($validatedData);

        return redirect()->route('category.index')->with('success', 'Genre created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        if(!$category){
            return redirect()->route('category.index')->with('error', 'Genre not found.');
        }
        return view('category/editCategory', ['category'=> $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateCategory($request, $id);
        $category = Category::find($id);

        if($request->hasFile('icon')){
            //delete old icon image
            if (file_exists(storage_path('app/public/' . $category->icon))) {
                unlink(storage_path('app/public/'. $category->icon));
            }

            //add new icon image
            $path = $request->file("icon")->store('icons','public');
            $validatedData['icon'] = $path;

        }else{
            $validatedData['icon'] = $category->icon;
        }

        $category->update($validatedData);
        return redirect()->route('category.index')->with('success', 'Genre updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Genre not found.');
        }

        if ($category->icon && file_exists(storage_path('app/public/'. $category->icon))) {
            unlink(storage_path('app/public/'. $category->icon));
        }

        $category->delete();
        return redirect()->route('category.index')->with('success', 'Genre deleted successfully.');
    }
}
