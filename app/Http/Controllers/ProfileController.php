<?php

namespace App\Http\Controllers;
use App\Http\Requests\LogoValidateRequest;
use App\Models\Task;
use App\Http\Requests\ProfileUpdateRequest;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show(): View
    {
        $user = Auth::user()->load('tasks');

        $totalTasks = $user->tasks->count();

        $completedTasksCount = $user->tasks->where('status', Task::COMPLETED)->count();
        $pendingTasksCount = $user->tasks->where('status', Task::IN_PROGRESS)->count();
        $overdueTasksCount = $user->tasks
            ->where('deadline', '<', Carbon::now())
            ->where('status', '!=', Task::COMPLETED)
            ->count();

        $completedTasksPercentage = $totalTasks > 0 ? ($completedTasksCount / $totalTasks) * 100 : 0;


        return view('dashboard', compact(
            'user',
            'totalTasks',
            'completedTasksCount',
            'pendingTasksCount',
            'overdueTasksCount',
            'completedTasksPercentage',
        ));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($request->hasFile('logo')) {
            // Delete the old logo if it exists
            if ($user->logo) {
                Storage::delete($user->logo);
            }

            // Store the new logo
            $path = $request->file('logo')->store('logos', 'public');
            $user->logo = $path;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete the user's logo if it exists
        if ($user->logo) {
            Storage::delete($user->logo);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }
}
