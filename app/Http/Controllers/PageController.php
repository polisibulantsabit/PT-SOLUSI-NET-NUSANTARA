<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function profile(): View
    {
        return view('profile');
    }

    public function contact(): View
    {
        return view('contact');
    }

    public function submitContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        ContactMessage::create($validated);

        return redirect()->route('contact')->with('success', 'Pesan Anda berhasil terkirim. Tim kami akan segera menghubungi Anda.');
    }
}
