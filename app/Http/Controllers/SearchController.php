<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Friend;
use App\Models\Post;
use App\Models\Privacy;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function CategorySearch(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::query()
            ->where('name', 'LIKE', "%" . $search . "%")
            ->paginate(30);
        return view('admin.categories.index', compact('categories'));
    }
    public function UserCategorySearch(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::query()
            ->where('name', 'LIKE', "%" . $search . "%")
            ->paginate(30);
        return view('user.categories.index', compact('categories'));
    }

    public function PostSearch(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::all();
        $posts = Post::orWhereRelation('category', 'name', 'LIKE', '%' . $request->search . '%')
            ->orWhereRelation('user', 'name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('id', 'LIKE', '%' . $request->search . '%')
            ->paginate(30);
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    public function UserSearch(Request $request)
    {
        $search = $request->input('search');
        $users = User::orWhereRelation('role', 'name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('email', 'LIKE', '%' . $request->search . '%')
            ->paginate(30);
        return view('admin.users.index', compact('users'));
    }
    public function UserDataSearch(Request $request)
    {
        $search = $request->input('search');
        $user = User::find(1);
        $roles = Role::all();
        $posts = Post::orWhereRelation('category', 'name', 'LIKE', '%' . $request->search . '%')
            ->orWhereRelation('user', 'name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('id', 'LIKE', '%' . $request->search . '%')
            ->paginate(30);
        return view('admin.users.show', compact('posts', 'user', 'roles'));
    }

    public function OpenSearch(Request $request, User $user)
    {
        $categories = Category::all();
        $messages = Post::latest()->take(5)->get();
        $search = $request->input('search');
        $posts = Post::orWhereRelation('category', 'name', 'LIKE', '%' . $request->search . '%')
            ->orWhereRelation('user', 'name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('id', 'LIKE', '%' . $request->search . '%')
            ->paginate(30);
        $users = User::query()
            ->where('name', 'LIKE', "%" . $search . "%")
            ->paginate(30);

        return view('user.search.index', compact('posts', 'categories', 'messages', 'users'));
    }

    public function PrivacySearch(Request $request)
    {
        $search = $request->input('search');
        $privacies = Privacy::query()
            ->where('privacy_name', 'LIKE', "%" . $search . "%")
            ->paginate(5);
        return view('admin.privacies.index', compact('privacies'));
    }


}
