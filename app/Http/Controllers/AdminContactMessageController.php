<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminContactMessageController extends Controller
{
    /**
     * Display all contact messages.
     */
    public function index()
    {
        $messages = ContactMessage::latest()->get();

        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Display one message.
     */
    public function show(ContactMessage $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Mark message as read.
     */
    public function markAsRead(ContactMessage $message)
    {
        $message->update([
            'is_read' => true,
        ]);

        return back()->with(
            'success',
            'Message marked as read successfully.'
        );
    }

    /**
     * Delete a message.
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with(
                'success',
                'Message deleted successfully.'
            );
    }
}