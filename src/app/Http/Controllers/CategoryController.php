<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
        public function index()
    {
        $categories=Category::all();
        return view('categories',compact('categories'));
    }

        public function store(CategoryRequest $request)
    {
        $category = $request->only(['name']);
        Category::create($category);
        return redirect('/categories')->with('message', 'categoryを作成しました');
    }

    public function update(CategoryRequest $request)
    {
        $category = $request->all();
        unset($category['_token']);
        Category::find($request->id)->update($category);
        return redirect('/categories')->with('message', 'categoryを更新しました');
    }

    public function destroy(Request $request)
    {
        Category::find($request->id)->delete();
        return redirect('/categories')->with('message', 'categoryを削除しました');
    }
}
