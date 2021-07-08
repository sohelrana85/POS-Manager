<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CategoryController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->user->can('category.view')){
            abort(403, 'sorry! Access Denied');
        }

        return view('pages.product.category');
    }


    public function all_category()
    {
        if(!$this->user->can('category.view')){
            abort(403, 'sorry! Access Denied');
        }

        return Category::paginate(10);
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
        if(!$this->user->can('category.create')){
            abort(403, 'sorry! Access Denied');
        }

        $id = $request->id;
        $request->validate([
            'name'   => 'required|unique:categories,name,' .$id,
            'status' => 'required|in:1,0',
        ]);

        try {
            Category::create([
                'user_id' => Auth::id(),
                'name'    => $request->name,
                'status'  => $request->status,
            ]);
            return response()->json([
                'status'  => '1',
                'message' => 'Category Save Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Category Save Failed'
            ]);
        }
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
    public function update(Request $request, $id)
    {
        if(!$this->user->can('category.edit')){
            abort(403, 'sorry! Access Denied');
        }

        $request->validate([
            'name'   => 'required|unique:categories,name,' .$id,
            'status' => 'required|in:1,0',
        ]);

        try {
            $category = Category::find($id);

            $category->name   = $request->name;
            $category->status = $request->status;
            $category->update();

            return response()->json([
                'status'  => '1',
                'message' => 'Category Update Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Category Update Failed'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->user->can('category.delete')){
            abort(403, 'sorry! Access Denied');
        }

        Category::find($id)->delete();

        return response()->json([
            'status' => '1',
            'message' => "Category Delete Success"
        ]);
    }
}
