<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreandUpdateValidation;
use App\Models\Category;
use App\Models\Friend;
use App\Models\Like;
use App\Models\Post;
use App\Models\SharePost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    //start functions for Category in admin side
    public function index()
    {
        $categories = Category::withCount('posts')->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $category = Category::query()->where('name', 'LIKE', "%" . $search . "%")->paginate(10);
        return view('admin.categories.index', compact('category'));
    }


    public function store(CategoryStoreandUpdateValidation  $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return redirect()->route('admin.categories.index')->with('message', 'categorie toegevoegd');
    }
    public function edit(Category $category)
    {
        $this->authorize('isAdmin', User::class);
        return view('admin.categories.edit', compact('category'));
    }
    public function update(CategoryStoreandUpdateValidation $request, Category $category)
    {
        $category->name = $request->name;
        $category->description = $request->description;
        $category->update();
        return redirect()->route('admin.categories.index')->with('message', 'categorie bijgewerkt');
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('message', 'categorie verwijderd');
    }
    //end functions for Category in admin side
    //start functions for Category in user side
    public function Categories(Category $category, Post $post)
    {
        $messages = Post::latest()->take(5)->get();
        $categories = Category::all();
        $requests = Friend::where('friend_id', '=', Auth::user()->id)->where('accepted', 0)->get();
        $totalRequests = count($requests);
        return view('user.categories.index', compact('categories', 'messages', 'post', 'totalRequests'));
    }
    public function CategoryShow(Category $category, Post $post)
    {
        $messages = Post::latest()->take(5)->get();
        $categories = Category::all();
        $posts = Post::orderByDesc('created_at')->where('category_id', $category->id)->get();
        $sharedPosts = SharePost::whereRelation('post', 'category_id', $category->id)->get();
        $posts = $posts->merge($sharedPosts)->sortByDesc('created_at');
        if (Auth::check() == true) {
            $requests = Friend::where('friend_id', '=', Auth::user()->id)->where('accepted', 0)->get();
            $totalRequests = count($requests);
        } else {
            $totalRequests = 0;
        }
        return view('user.categories.category', compact('category', 'posts', 'categories', 'messages', 'post', 'totalRequests'));
    }
    public function CategoryPrivateShow(Category $category, Post $post)
    {
        $messages = Post::latest()->take(5)->get();
        $categories = Category::all();
        $posts = Post::orderByDesc('created_at')->where('category_id', $category->id)->get();
        $sharedPosts = SharePost::whereRelation('post', 'category_id', $category->id)->get();
        $posts = $posts->merge($sharedPosts)->sortByDesc('created_at');
        if (Auth::check() == true) {
            $requests = Friend::where('friend_id', '=', Auth::user()->id)->where('accepted', 0)->get();
            $totalRequests = count($requests);
        } else {
            $totalRequests = 0;
        }
        return view('user.categories.private', compact('category', 'posts', 'categories', 'messages', 'post', 'totalRequests'));
    }
    //end functions for Category in user side
}
