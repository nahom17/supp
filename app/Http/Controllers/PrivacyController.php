<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAndUpdatePrivacyRequest;
use App\Models\Privacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PrivacyController extends Controller
{
    //admin gedeelte
    public function index()
    {
        $privacies = Privacy::orderByDesc('id')->paginate(5);
        return view('admin.privacies.index', compact('privacies'));
    }

    public function store(StoreAndUpdatePrivacyRequest $request)
    {
        $privacy = new Privacy();
        $privacy->privacy_name = $request->privacy_name;
        $privacy->description = $request->description;
        $privacy->save();
        return redirect(route('admin.privacies.index'))->with('message', 'Privacy toegevoegd');
    }

    public function edit(Privacy $privacy)
    {
        $this->authorize('isAdmin', User::class);
        return view('admin.privacies.edit', compact('privacy'));
    }

    public function update(StoreAndUpdatePrivacyRequest $request, Privacy $privacy)
    {
        $privacy->privacy_name = $request->privacy_name;
        $privacy->description = $request->description;
        $privacy->update();
        return redirect(route('admin.privacies.index'))->with('message', 'Privacy bijgwerkt');
    }
    public function destroy(Privacy $privacy)
    {
        $privacy->delete();
        return redirect(route('admin.privacies.index'))->with('message', 'Privacy verwijdered');
    }

    //user gedeelte

    public function updatePrivacy(Request $request, User $user)
    {
        $user->privacy_id = $request->privacy_id;

        $user->save();
        return redirect()->route('profile.settings', $user->name)->with('message', 'Privacy voorkeur gewijzigd');
    }
}
