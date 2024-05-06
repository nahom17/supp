<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentSoreandUpdateValidation;
use App\Http\Requests\PostSoreandUpdateValidation;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Friend;
use App\Models\Like;
use App\Models\Post;
use App\Models\Privacy;
use App\Models\User;
use App\Models\SharePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //start all Post and comment functions in admin side
    public function index()
    {
        $posts = Post::orderbyDesc('id')->paginate(5);
        $categories = Category::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    public function store(PostSoreandUpdateValidation $request)
    {
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->save();
        return redirect()->route('admin.posts.index', compact('post'))->with('message', 'Post toegevoegd');
    }
    public function show(Post $post)
    {
        $this->authorize('isAdmin', User::class);

        return view('admin.posts.show', compact('post'));
    }

    public function showReported(Post $post)
    {
        $posts = Post::orderbyDesc('id')->get();
        $categories = Category::all();
        $reported = Post::where('reported', 1)->first();
        return view('admin.posts.reported', compact('posts', 'categories', 'reported'));
    }
    public function setFree(Post $post)
    {
        $post->reported = 0;
        $post->save();
        return redirect()->back()->with('message', 'Post vrijgegeven');
    }
    public function comments(Post $post)
    {
        $this->authorize('isAdmin', User::class);

        return view('admin.posts.comments', compact('post'));
    }

    public function update(PostSoreandUpdateValidation $request, Post $post)
    {
        $post->user_id = $request->user_id;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->save();
        return redirect()->route('admin.posts.index')->with('message', 'Post bijgewerkt');
    }
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', 'Post  verwijderd');
    }
    public function delete(Post $post, Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('message', 'Comment  verwijderd');
    }

    //end all Post and comment functions in admin side

    //start all Post and comment functions in user side

    public function showPost(Category $category, Post $post)
    {
        $messages = Post::latest()->take(5)->get();
        $categories = Category::all();
        $requests = Friend::where('friend_id', '=', Auth::user()->id)->where('accepted', 0)->get();
        $totalRequests = count($requests);
        return view('user.categories.post',  compact('post', 'categories', 'category', 'messages', 'totalRequests'));
    }
    public function PostIndex(Category $category)
    {
        $posts = Post::orderbyDesc('id')->get();
        $sharedPosts = SharePost::orderByDesc('id')->get();
        $posts = $posts->merge($sharedPosts)->sortByDesc('created_at');
        $messages = Post::latest()->take(5)->get();
        $categories = Category::all();
        return view('user.posts.index', compact('posts', 'categories', 'category', 'messages'));
    }

    public function PostLike(Post $post)
    {
        $post->like();
        $post->save();
        return redirect()->route('posts.index')->with('message', 'post leuk gevonden');
    }

    public function PostStore(PostSoreandUpdateValidation $request, User $user)
    {
        $post = new Post();
        $post->user_id = $request->user_id;
        $post->privacy_id = Auth::user()->privacy_id;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->save();
        return redirect()->route('posts.index', compact('post'))->with('message', 'Post toegevoegd');
    }
    public function CategoryPostStore(PostSoreandUpdateValidation $request, User $user)
    {
        $post = new Post();
        $post->user_id = $request->user_id;
        $post->privacy_id = Auth::user()->privacy_id;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->save();
        return redirect()->back()->with('message', 'Post toegevoegd');
    }

    public function PostUpdate(PostSoreandUpdateValidation $request, Post $post)
    {
        $post->user_id = $request->user_id;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->save();
        return redirect()->back()->with('message', 'Post bijgewerkt');
    }
    public function PostDestroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->with('message', 'Post verwijderd');
    }
    public function reportPost(Post $post)
    {
        $post->reported = 1;
        $post->save();

        return redirect()->back()->with('message', 'Post gerapporteerd');
    }


    public function sharePost(Post $post)
    {
        $user = Auth::user();

        // Check if the post belongs to the logged-in user
        if ($post->user_id === Auth::user()->id) {
            return redirect()->back()->with('message', 'Je kunt je eigen post niet delen');
        }

        // Check if the post has already been shared by the logged-in user


        if (SharePost::where('user_id', Auth::user()->id)->where('post_id', $post->id)->first()) {
            SharePost::where('user_id', Auth::user()->id)->where('post_id', $post->id)->first()->delete();
            return redirect()->back()->with('message', 'Gestopt met delen');
        }

        // Share the post
        // $user->sharedPosts()->attach($post);
        $sharedPost = new SharePost;
        $sharedPost->user_id = Auth::user()->id;
        $sharedPost->owner_id = $post->user_id;
        $sharedPost->post_id = $post->id;
        $sharedPost->save();
        return redirect()->back()->with('message', 'Post succesvol gedeeld!');
    }

    // start function for comments in posts user side
    //users folder has ->posts folder ->comment folder


    public function CommentStore(CommentSoreandUpdateValidation $request, Post $post)
    {
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post->id;
        $comment->parent_id = Auth::user()->id;
        $comment->content = $request->content;
        $comment->save();
        return redirect()->back()->with('message', 'comment toegevoegd');
    }



    public function CommentUpdate(Post $post, Comment $comment, CommentSoreandUpdateValidation $request)
    {
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post->id;
        $comment->content = $request->content;
        $comment->update();
        return redirect()->back()->with('message', 'comment bijgewerkt');
    }
    public function CommentDestroy(Post $post, Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('message', 'comment verwijderd');
    }
    // end function for comments in posts user side

    //end all Post and comment functions in user side

    // start functions user profile (my posts)
    //users folder has ->profile folder-> myposts folder->liked folder

    public function LikePostStore(Request $request, Post $post)
    {
        $like = new Like();
        $like->user_id = auth()->id();
        $like->post_id = $post->id;
        $like->save();
        $post->likes++;
        $post->update();
        return back();
    }
    public function PostDislike(Post $post, Like $like)
    {
        $post->likes--;
        $post->update();
        $like->delete();
        return back();
    }
    // end functions user profile (my posts)
}
