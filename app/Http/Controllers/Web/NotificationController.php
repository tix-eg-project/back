<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function getNotifications()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
        $notifications = $user->notifications()->orderBy('created_at', 'desc')->paginate(10);
        $newCount      = $user->unreadNotifications()->count();
        return view('Admin.pages.notifications.index', compact('notifications', 'newCount'));
    }
    public function markAsRead(Request $request)
    {
        $notification = auth()->user()->notifications()->find($request->id);
        if ($notification) {
            $notification->markAsRead();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function ReadAll()
    {
        $notification = Auth::user()->unreadNotifications;
        if ($notification) {
            $notification->markAsRead();
            return back();
        }
    }

    public function destroy($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->delete();
        return redirect()->route('Admin.notifications')->with('success', 'Deleted Notification');
    }



    public function delete()
    {
        Auth::user()->notifications()->delete();
        return back();
    }

    // public function index()
    // {
    //     $notifications = auth()->user()->notifications;

    //     return view('admin.notifications.index', compact('notifications'));
    // }
}
