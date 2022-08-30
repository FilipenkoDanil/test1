<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
    public function index() {
        $tickets = Ticket::orderByDesc('id')->get();
        return view('manager.index', compact('tickets'));
    }

    public function download($filename) {
        return Storage::download('/files/' . $filename);
    }

    public function change(Request $request) {
        $ticket = Ticket::findOrFail($request->id);
        $ticket->isAnswered = !$ticket->isAnswered;
        $ticket->save();

        return true;
    }
}
