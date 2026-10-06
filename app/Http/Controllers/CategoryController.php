<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categs = Category::all();
        return view('categories.index',['categs' => $categs]);
    }

    
    public function create()
    {
        Gate::authorize('create',Category::class);
        return view('categories.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','unique:categories','min:3','max:20'],
        ]);
        Category::create([
            'name' => $validated['name'],
            // may add img later
        ]);
        return redirect()->route('categories');
    }

    
    
    public function show(Category $category)
    {
        
    $products = Product::where('category_id', $category->id)->get();
    return view('categories.category',['category' => $category,'products' => $products]);

    }
    public function get_manage(){
        Gate::authorize('manage_categs',Category::class);
        $categs = Category::all();
        return view('categories.management',['categs' => $categs]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $categ)
    {
        return view('categories.edit',['categ' => $categ]);
        
        // try to edit in place with Js somehow
    }
     public function delete(Category $categ)
    {
        Gate::authorize('delete',$categ);
        // delete categ? how about its products? their foreign key? should we drop them? how about the orders?
        dd($categ->name. ' deleted');
        return redirect()->back();
    }

        public function update(Request $request, Category $categ)
    {
        Gate::authorize('update_category',$categ);
        $validated = $request->validate([
            'name' => ['required','unique:categories','min:3','max:20']
        ]);
        if ($categ->name == $validated['name']) {
            return redirect()->back()->withErrors(['name' => 'nothing was changed!']);
        }
        
        $categ->name = $validated['name'];
        $categ->save();
        return redirect()->route('management');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
