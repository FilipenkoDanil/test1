<?php

namespace App\Http\Controllers;

use App\Jobs\NewTicketJob;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        $days = $this->checkDays();
        return view('user.index', compact('days'));
    }

    public function create(Request $request) {
        if(!$this->checkDays()) {
            return redirect()->route('user')->with('error', 'Заявка уже отправлена. Подождите 24 часа.');
        }

        $request->validate([
            'topic' => 'required',
            'message' => 'required',
       ]);

       $file = '';
       if($request->hasFile('file')) {
          $file = $request->file('file')->store('files');
       }

       $ticket = Ticket::create([
           'topic' => $request->topic,
           'message' => $request->message,
           'file' => $file,
           'user_id' => Auth::user()->id
       ]);

       $this->dispatch(new NewTicketJob($ticket));

       return redirect()->route('user')->with('success', 'Заявка отправлена.');
    }

    public function checkDays() {
        $lastTicket = Ticket::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first();
        $days = true;
        if($lastTicket) {
            $days = Carbon::now()->diff($lastTicket->created_at)->days;
        }

        return $days;
    }
}
