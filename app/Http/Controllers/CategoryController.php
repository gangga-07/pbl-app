<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function allCategory()
    {
        $data = [
            'title' => 'Categories | PBL-APP',
            // 'categories' => Category::all(),
        ];
        $cat = Category::all();
        return view('dashboard.admin.categories.category-all', $data, compact('cat'));
    }
    public function createCategory()
    {
        $data = [
            'title' => 'Add New Category | PBL-APP'
        ];
        return view('dashboard.admin.categories.category-add', $data);
    }
    public function detailCategory(Category $category)
    {
        $data = [
            'title' => 'Category Detail | PBL-APP',
            'category' => $category
        ];
        return view('dashboard.admin.categories.category-detail', $data);
    }
    public function updateCategory(Category $category)
    {
        $data = [
            'title' => 'Category Update | PBL-APP',
            'category' => $category
        ];
        return view('dashboard.admin.categories.category-edit', $data);
    }
    public function storeCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Input Failed!<br>Please Try Again With Correct Input');
        }
        $validated = $validator->validated();
        $created_category = Category::create([
            'name' => $validated['name'],
        ]);
        if ($created_category) {
            return redirect()->route('manage_category.all')->with('success', 'New Category Successfully Added');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }
    public function patchCategory(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Input Failed!<br>Please Try Again With Correct Input');
        }
        $validated = $validator->validated();
        $category->touch();
        $updated_category = $category->update([
            'name' => $validated['name'],
        ]);
        if ($updated_category) {
            return redirect()->route('manage_category.all')->with('success', 'The Category Successfully Updated');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }
    public function deleteCategory(Category $category)
    {
        $category->products()->delete();
        if ($category->delete()) {
            return redirect()->route('manage_category.all')->with('success', 'The Category Successfully Deleted');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }
}
