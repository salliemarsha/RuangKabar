<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function read(Request $request, string $id)
    {
        $notification = $request->user()
            ->notifications()
            ->whereKey($id)
            ->firstOrFail();

        $notification->markAsRead();

        return redirect($notification->data['url'] ?? '/');
    }

    public function readAll(Request $request)
    {
        $request->user()
            ->unreadNotifications
            ->markAsRead();

        return back();
    }

    public function destroy(Request $request, string $id)
    {
        $request->user()
            ->notifications()
            ->whereKey($id)
            ->firstOrFail()
            ->delete();

        return back()->with('success', 'Notifikasi berhasil dihapus.');
    }

    public function destroyAll(Request $request)
    {
        $request->user()
            ->notifications()
            ->delete();

        return back()->with('success', 'Seluruh notifikasi berhasil dihapus.');
    }
}
