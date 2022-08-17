<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Presence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class IndexDashboard extends Component
{
    public $userId, $date, $presence, $typeToDay, $come, $go, $status, $code;
    public $submission, $rejected, $approve;

    protected $listeners = ['render'];


    public function render()
    {
        $role = Auth::user()->roles->first();
        if ($role->name == 'tenaga kontrak') {
            $this->userId = auth()->user()->id;
            $this->date = Carbon::today();
            $this->presence = Presence::where('user_id', $this->userId)->whereDate('created_at', $this->date)->first();
            $this->come = $this->presence ? $this->presence->come_presence : null;
            $this->go = $this->presence ? $this->presence->go_presence : null;
            $this->status = $this->presence ? $this->presence->type : null;

            $this->submission = Presence::where('user_id', $this->userId)->where('type', 'DL')->where('status', 'submission')->count();
            $this->rejected = Presence::where('user_id', $this->userId)->where('type', 'DL')->where('status', 'rejected')->count();
            $this->approve = Presence::where('user_id', $this->userId)->where('type', 'DL')->where('status', 'approved')->count();
        } else if ($role->name == 'admin') {
            $this->submission = Presence::where('type', 'DL')->where('status', 'submission')->count();
            $this->rejected = Presence::where('type', 'DL')->where('status', 'rejected')->count();
            $this->approve = Presence::where('type', 'DL')->where('status', 'approved')->count();
            $this->employees = User::whereHas('roles', function ($q) {
                $q->where('name', 'tenaga kontrak');
            })->count();
        }



        return view('livewire.dashboard.index-dashboard');
    }
}
