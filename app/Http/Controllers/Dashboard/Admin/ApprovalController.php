<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function unapprovedUsers()
    {
        $users = User::where('is_approved', false)->get();
        return view('dashboard.admin.approval.unapproved', compact('users'));
    }
    public function approvedUser(Request $request, User $user)
    {
        if ($request->input('action') === 'approve') {
            $user->is_approved = true;
            $user->role = 2;

            $user->save();
            // Optionally, send an email to the user notifying them of their approval
        } else {
            $user->delete();
            // Optionally, send an email to the user notifying them of their rejection
        }

        return redirect()->back();
    }
    public function approvedUsers()
    {
        $users = User::where('is_approved', true)
                        ->where('role', [2])
                        ->get();
        return view('dashboard.admin.approval.approved', compact('users'));
    }
    public function deleteProf(Request $request)
    {
        try {
            User::where('id',$request->id)->delete();
            return response()->json(['success' => true, 'msg' => 'Prof deleted successfully.']);

        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }
}
