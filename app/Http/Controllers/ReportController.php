<?php

namespace App\Http\Controllers;

use App\Mail\ReportApprovedMail;
use App\Models\Report;
use App\Models\Link;
use App\Enum\Report as ReportType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Enum;

class ReportController extends Controller
{
    /**
     * Store a newly created report in storage.
     * Email field is optional — if provided, reporter will be notified on approval.
     */
    public function store(Request $request)
    {
        $request->validate([
            'link_id' => 'required|exists:links,id',
            'type'    => ['required', new Enum(ReportType::class)],
            'message' => 'nullable|string|max:1000',
            'email'   => 'nullable|email|max:255',
        ]);

        Report::create([
            'link_id' => $request->link_id,
            'user_id' => Auth::id(),
            'type'    => $request->type,
            'message' => $request->message,
            'email'   => $request->email,
            'status'  => 'pending',
        ]);

        return back()->with('success', 'Report submitted successfully. Thank you for helping keep the directory safe!');
    }

    /**
     * Admin: Display a listing of reports.
     */
    public function index()
    {
        $reports = Report::with(['link', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Admin: Accept a report.
     * Sends an email notification to the reporter if they provided an email address.
     */
    public function accept($id)
    {
        $report = Report::with(['link', 'user'])->findOrFail($id);
        $report->update(['status' => 'accepted']);

        // Send notification email if reporter left their address
        if ($report->email) {
            Mail::to($report->email)->queue(new ReportApprovedMail($report));
        }

        return back()->with('success', 'Report accepted.' . ($report->email ? ' Notification email queued for the reporter.' : ''));
    }

    /**
     * Admin: Reject a report.
     */
    public function reject($id)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => 'rejected']);

        return back()->with('success', 'Report marked as rejected.');
    }

    /**
     * Admin: Delete a report.
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return back()->with('success', 'Report deleted.');
    }
}
