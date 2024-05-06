<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostSoreandUpdateValidation;
use App\Http\Requests\UserStoreValidation;
use App\Http\Requests\UserUpdateValidation;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Friend;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBydesc('id')->paginate(5);
        return view('admin.users.index', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::query()
            ->where('name', 'LIKE', "%" . $search . "%")
            ->orWhere('email', 'LIKE', "%" . $search . "%")
            ->paginate(30);
        return view('admin.users.index', compact('users'));
    }
    public function store(UserStoreValidation $request)
    {
        $user = new User();
        $user->role_id = Role::USER;
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/profileImage/', $filename);
            $user->image = $filename;
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('admin.users.index');
    }
    public function show(User $user)
    {
        $this->authorize('isAdmin', User::class);
        $roles = Role::all();
        return view('admin.users.show', compact('user', 'roles'));
    }
    public function comments(User $user)
    {
        $this->authorize('isAdmin', User::class);
        $roles = Role::all();
        return view('admin.users.comments', compact('user', 'roles'));
    }
    public function friends(User $user)
    {
        $this->authorize('isAdmin', User::class);
        $roles = Role::all();
        $friendRequests = Friend::where('friend_id', $user->id)->where('accepted', '=', 1)->get();
        $friendSend = Friend::where('user_id', $user->id)->where('accepted', '=', 1)->get();
        $confirmedFriends = count($friendRequests) + count($friendSend);
        $totalFriends = $confirmedFriends;
        return view('admin.users.friends', compact('user', 'roles', 'totalFriends'));
    }

    public function update(User $user, UserUpdateValidation $request)
    {
        $user->role_id = $request->role_id;
        $user->name = $request->name;
        if ($request->email) {
            $user->email = $request->email;
        }
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        } else {
            unset($request->password);
        }
        $user->save();

        return redirect()->route('admin.users.show', $user);
    }
    public function destroy(User $user)
    {
        $destination = 'uploads/profileImage/' . $user->image;
        if (File::exists($destination) && $user->image != 'avatar.png') {
            File::delete($destination);
        }
        $user->delete();
        return redirect()->route('admin.users.index');
    }
    public function delete(User $user, Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.users.comments', $user)->with('message', 'Comment  verwijderd');
    }
    //start userProfile all functions in user side
    public function userIndex(User $user, Category $category)
    {

        $categories = Category::all();
        $isFriend = Friend::where(['user_id' => Auth::user()->id, 'friend_id' => $user->id])->orWhere(['user_id' => $user->id, 'friend_id' => Auth::user()->id])->where('accepted', 1)->first();
        $pendingFriendship = Friend::where(['user_id' => Auth::user()->id, 'friend_id' => $user->id])->orWhere(['user_id' => $user->id, 'friend_id' => Auth::user()->id])->where('accepted', 0)->first();
        $acceptedFriends = Friend::where('friend_id', $user->id)->orWhere('user_id', $user->id)->where('accepted', 1)->get();
        $friendRequests = Friend::where('friend_id', $user->id)->where('accepted', '=', 1)->get();
        $friendSend = Friend::where('user_id', $user->id)->where('accepted', '=', 1)->get();
        $confirmedFriends = count($friendRequests) + count($friendSend);
        $totalFriends = $confirmedFriends;

        return view('user.profile.user', compact('categories', 'user', 'category', 'isFriend', 'acceptedFriends', 'pendingFriendship', 'totalFriends'));
    }
    public function userComments(User $user, Category $category)
    {

        $categories = Category::all();
        $isFriend = Friend::where(['user_id' => auth()->user()->id, 'friend_id' => $user->id])->orWhere(['user_id' => $user->id, 'friend_id' => auth()->user()->id])->first();
        $pendingFriendship = Friend::where('friend_id', $user->id)->where('user_id', Auth::user()->id)->where('accepted', 0)->first();
        $comments = Comment::all();
        $acceptedFriends = Friend::where('friend_id', $user->id)->orWhere('user_id', $user->id)->where('accepted', 1)->get();
        $friendRequests = Friend::where('friend_id', $user->id)->where('accepted', '=', 1)->get();
        $friendSend = Friend::where('user_id', $user->id)->where('accepted', '=', 1)->get();
        $confirmedFriends = count($friendRequests) + count($friendSend);
        $totalFriends = $confirmedFriends;

        return view('user.profile.userComments', compact('categories', 'user', 'category', 'isFriend', 'comments', 'acceptedFriends', 'pendingFriendship', 'totalFriends'));
    }
    public function userFriends(User $user, Category $category)
    {

        $categories = Category::all();
        $isFriend = Friend::where(['user_id' => auth()->user()->id, 'friend_id' => $user->id])->orWhere(['user_id' => $user->id, 'friend_id' => auth()->user()->id])->first();
        $pendingFriendship = Friend::where(['user_id' => auth()->user()->id, 'friend_id' => $user->id])->orWhere(['user_id' => $user->id, 'friend_id' => auth()->user()->id])->first();
        $friends = Friend::all();
        $confirmedFriends = Friend::where('friend_id', $user->id)->orWhere('user_id', $user->id)->where('accepted', 1)->get();



        $friendRequests = Friend::where('friend_id', $user->id)->where('accepted', '=', 1)->get();
        $friendSend = Friend::where('user_id', $user->id)->where('accepted', '=', 1)->get();
        $confirmedFriends = count($friendRequests) + count($friendSend);
        $totalFriends = $confirmedFriends;
        $allFriends = Friend::where('user_id', $user->id)->orWhere('friend_id', $user->id)->get();

        return view('user.profile.userFriends', compact('categories', 'user', 'category', 'isFriend', 'friends', 'confirmedFriends', 'pendingFriendship', 'totalFriends', 'allFriends'));
    }
    public function profileIndex(Category $category)
    {
        if (Auth::check()) {
            $messages = Post::latest()->take(5)->get();
            $categories = Category::all();
            $user = Auth::user();
            $requests = Friend::where('friend_id', '=', Auth::user()->id)->where('accepted', 0)->get();
            $totalRequests = count($requests);
            $friendRequests = Friend::where('friend_id', Auth::user()->id)->where('accepted', '=', 1)->get();
            $friendSend = Friend::where('user_id', Auth::user()->id)->where('accepted', '=', 1)->get();
            $confirmedFriends = count($friendRequests) + count($friendSend);
            $totalFriends = $confirmedFriends;

            return view('user.profile.profile', compact('categories', 'user', 'category', 'messages', 'totalFriends', 'totalRequests'));
        } else {
            return view('login');
        }
    }
    public function ProfileEdit(User $user)
    {
        $messages = Post::latest()->take(5)->get();
        $categories = Category::all();
        $requests = Friend::where('friend_id', '=', Auth::user()->id)->where('accepted', 0)->get();
        $totalRequests = count($requests);
        $friendRequests = Friend::where('friend_id', Auth::user()->id)->where('accepted', '=', 1)->get();
        $friendSend = Friend::where('user_id', Auth::user()->id)->where('accepted', '=', 1)->get();
        $confirmedFriends = count($friendRequests) + count($friendSend);
        $totalFriends = $confirmedFriends;

        return view('user.profile.settings', compact('user', 'categories', 'messages', 'totalFriends', 'totalRequests'));
    }
    public function ProfileShared(User $user)
    {
        $messages = Post::latest()->take(5)->get();
        $categories = Category::all();
        $requests = Friend::where('friend_id', '=', Auth::user()->id)->where('accepted', 0)->get();
        $totalRequests = count($requests);
        $friendRequests = Friend::where('friend_id', Auth::user()->id)->where('accepted', '=', 1)->get();
        $friendSend = Friend::where('user_id', Auth::user()->id)->where('accepted', '=', 1)->get();
        $confirmedFriends = count($friendRequests) + count($friendSend);
        $totalFriends = $confirmedFriends;

        return view('user.profile.shared', compact('user', 'categories', 'messages', 'totalFriends', 'totalRequests'));
    }

    public function ProfileFriends(User $user)
    {
        $messages = Post::latest()->take(5)->get();
        $categories = Category::all();
        $friendRequests = Friend::where('friend_id', Auth::user()->id)->where('accepted', '=', 1)->get();
        $friendSend = Friend::where('user_id', Auth::user()->id)->where('accepted', '=', 1)->get();
        $confirmedFriends = count($friendRequests) + count($friendSend);
        $totalFriends = $confirmedFriends;
        $requests = Friend::where('friend_id', '=', Auth::user()->id)->where('accepted', 0)->get();
        $totalRequests = count($requests);
        $allFriends = Friend::where('user_id', Auth::user()->id)->orWhere('friend_id', Auth::user()->id)->get();
        return view('user.profile.friends', compact('user', 'categories', 'messages', 'totalFriends', 'totalRequests', 'allFriends'));
    }
    public function ProfileRequests(User $user)
    {
        $messages = Post::latest()->take(5)->get();
        $categories = Category::all();
        $friendRequests = Friend::where('friend_id', Auth::user()->id)->where('accepted', '=', 1)->get();
        $friendSend = Friend::where('user_id', Auth::user()->id)->where('accepted', '=', 1)->get();
        $confirmedFriends = count($friendRequests) + count($friendSend);
        $totalFriends = $confirmedFriends;
        $requests = Friend::where('friend_id', '=', Auth::user()->id)->where('accepted', 0)->get();
        $totalRequests = count($requests);
        $send = Friend::where('user_id', '=', Auth::user()->id)->where('accepted', 0)->get();
        return view('user.profile.requests', compact('user', 'categories', 'messages', 'requests', 'send', 'totalFriends', 'totalRequests'));
    }
    public function ProfileLikes(User $user)
    {
        $messages = Post::latest()->take(5)->get();
        $categories = Category::all();
        $requests = Friend::where('friend_id', '=', Auth::user()->id)->where('accepted', 0)->get();
        $totalRequests = count($requests);
        $friendRequests = Friend::where('friend_id', Auth::user()->id)->where('accepted', '=', 1)->get();
        $friendSend = Friend::where('user_id', Auth::user()->id)->where('accepted', '=', 1)->get();
        $confirmedFriends = count($friendRequests) + count($friendSend);
        $totalFriends = $confirmedFriends;
        return view('user.profile.likes', compact('user', 'categories', 'messages', 'totalFriends', 'totalRequests'));
    }

    public function ProfileUpdate(UserUpdateValidation $request, User $user)
    {
        $user->name = $request->name;
        if ($request->email) {
            $user->email = $request->email;
        }

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/profileImage/', $filename);
            $user->image = $filename;
        }

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        } else {
            unset($request->password);
        }

        $user->save();
        return redirect()->route('profile.settings', $user->name)->with('message', 'Gegevens gewijzigd');
    }

    public function ProfileDestroy(User $user)
    {
        $user->delete();
        return redirect()->route('welcome');
    }

    //end userProfile all functions in user side
}
