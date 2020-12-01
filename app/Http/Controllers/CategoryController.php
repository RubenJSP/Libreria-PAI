<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasPermissionTo('crud categories')){
            $categories = Category::paginate(10);
            return view('categories.admin',compact('categories'));
        }
        return redirect()->back()->with("error","You don't have permissions");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasPermissionTo('crud categories')){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
            ]);
            if ($validator->fails()) {
                return  redirect()->back()->with('error', "Invalid fields, couldn't create category");

            }
            if($category = Category::create($request->all())){
                return  redirect()->back()->with('success', 'Category created successfully');
            }
            return  redirect()->back()->with('error', "Sorry, couldn't create category");
        }
        return redirect()->back()->with("error","You don't have permissions");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(Auth::user()->hasPermissionTo('crud categories')){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
            ]);
            if ($validator->fails()) {
                return  redirect()->back()->with('error', "Invalid fields, couldn't edit category");

            }
            $category = Category::find($request['id']);
            if($category->Update($request->all()))
                return  redirect()->back()->with('success', 'Category created successfully');
            
            return  redirect()->back()->with('error', "Sorry, couldn't update category");
        }
        return redirect()->back()->with("error","You don't have permissions");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(Auth::user()->hasPermissionTo('crud categories')){
            if($category){
                if($category->delete()){
                    return response()->json([
                        'message' => 'Category deleted successfully', 
                        'code' => '200'
                    ]);
                }
                return response()->json([
                        'message' => "Sorry, coudn't delete category", 
                        'code' => '400'
                    ]);
            }
        }
        return response()->json([
            'message' => "You don't have permissions", 
            'code' => '403'
        ]);
    }
}
