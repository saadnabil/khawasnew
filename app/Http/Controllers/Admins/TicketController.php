<?php

namespace App\Http\Controllers\Admins;

use App\Exports\ExportUsers;
use App\Exports\UserExport;
use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\ValidateTicketForm;
use App\Http\Requests\Admins\TicketFormAdminValdate;
use App\Imports\UserImport;
use App\Models\Admin;
use App\Models\Inquiry;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\Return_;

class TicketController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ticket-list', ['only' => ['index']]);
         $this->middleware('permission:ticket-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:ticket-close', ['only' => ['close']]);
         $this->middleware('permission:ticket-my', ['only' => ['mytickets']]);
    }

    public function mytickets(){
        $user = auth()->user();
        $user->load('tickets');
        $tickets = $user->tickets()->latest()->paginate(8);
        return response()->view('admins.tickets.mytickets', compact('tickets'));
    }

    public function index()
    {
        $tickets = Ticket::latest()->paginate(8);
        return response()->view('admins.tickets.index', compact('tickets'));
    }

    public function edit(Request $request, Ticket $ticket)
    {
        $method = true;
        $langs = availableLanguages();
        $admins = Admin::get();
        $action = route('tickets.update', $ticket);
        return response()->view('admins.tickets.form', compact('ticket', 'action', 'method','admins'));
    }

    public function update(TicketFormAdminValdate $request, Ticket $ticket)
    {
        $data = $request->validated();
        $data['status'] = 'open';
        $ticket->update($data);
        session()->flash('success', __('translation.Item updated successfully'));
        return redirect()->route('tickets.index');
    }

    public function close(Ticket $ticket){
        $ticket->update(['status' => 'closed']);
        session()->flash('success', __('translation.Ticket closed successfully'));
        return redirect()->route('tickets.index');
    }


}
