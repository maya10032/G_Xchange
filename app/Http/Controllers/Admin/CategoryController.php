<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }
}
