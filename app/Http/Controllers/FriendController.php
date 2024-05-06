<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    public function index(Request $request, User $user)
    {
        //$friends = $user->friends()->where('accepted', 1)->get();
        $pendingfriends = $user->friends()->where('accepted', 0)->get();
        $categories = Category::all();
        $isFriend = Friend::where('user_id', Auth::user()->id)->orWhere('friend_id', Auth::user()->id)->first();
        $user = Auth::user();
        return view('user.profile.friends', compact('categories', 'user', 'isFriend'));
    }


    public function store(Request $request, User $user)
    {

        $friend = new Friend;
        $friend->user_id = auth()->id();
        $friend->friend_id = $request->friend_id;
        $friend->save();
        return redirect()->back()->with('message', 'Vriendschapsverzoek verstuurd');
    }

    public function update(Request $request, Friend $friend, User $user)
    {

        $friend->accepted = 1;
        $friend->save();

        return redirect()->route('profile.friends.index', $user->id)->with('message', 'Vriendschapsverzoek is geaccepteerd');
    }

    public function destroy(Friend $friend, User $user)
    {

        $friend->delete();
        return redirect()->back()->with('message', 'Vriend verwijderd');
    }
}
