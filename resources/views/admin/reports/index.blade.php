<x-app.layouts title="Admin - User Reports">

    @include('admin._nav')

    <div class="admin-header">
        <div>
            <h1>User Reports</h1>
            <p>Review and handle reports submitted by users regarding links.</p>
        </div>
    </div>

    @if ($reports->count() > 0)
        <div class="panel">
            <div style="overflow-x:auto;">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Report Details</th>
                            <th>Link</th>
                            <th>Reporter</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td>
                                    {{-- Type badge with color --}}
                                    @php
                                        $badgeColors = [
                                            'red'    => ['color' => '#f87171', 'bg' => 'rgba(248,113,113,.1)', 'border' => 'rgba(248,113,113,.2)'],
                                            'orange' => ['color' => '#fb923c', 'bg' => 'rgba(251,146,60,.1)',  'border' => 'rgba(251,146,60,.2)'],
                                            'yellow' => ['color' => '#facc15', 'bg' => 'rgba(250,204,21,.1)',  'border' => 'rgba(250,204,21,.2)'],
                                            'blue'   => ['color' => '#58a6ff', 'bg' => 'rgba(88,166,255,.1)', 'border' => 'rgba(88,166,255,.2)'],
                                            'gray'   => ['color' => '#7d8590', 'bg' => 'rgba(125,133,144,.1)','border' => 'rgba(125,133,144,.2)'],
                                        ];
                                        $bc = $badgeColors[$report->type->badgeColor()] ?? $badgeColors['gray'];
                                    @endphp
                                    <div style="margin-bottom:.3rem;">
                                        <span style="font-size:.6rem;font-weight:800;text-transform:uppercase;letter-spacing:.05em;padding:.15rem .45rem;border-radius:2rem;border:1px solid {{ $bc['border'] }};color:{{ $bc['color'] }};background:{{ $bc['bg'] }};">
                                            {{ $report->type->label() }}
                                        </span>
                                        @if($report->type->isComplex())
                                            <span style="margin-left:.3rem;font-size:.55rem;font-weight:800;color:#f87171;">&#9888; High Priority</span>
                                        @endif
                                    </div>
                                    {{-- Type description hint --}}
                                    <div style="font-size:.62rem;color:var(--color-gh-dim);opacity:.7;margin-bottom:.25rem;max-width:280px;line-height:1.4;">
                                        {{ $report->type->description() }}
                                    </div>
                                    @if($report->message)
                                        <div style="font-size:.68rem;color:var(--color-gh-dim);line-height:1.4;max-width:280px;padding:.35rem .5rem;background:rgba(255,255,255,.02);border-left:2px solid var(--color-gh-border);border-radius:0 .2rem .2rem 0;">
                                            {{ $report->message }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if($report->link)
                                        <a href="{{ route('link.show', $report->link->slug) }}" target="_blank" style="font-size:.7rem;font-weight:600;color:var(--color-gh-accent);text-decoration:none;display:block;margin-bottom:.2rem;">
                                            {{ Str::limit($report->link->title, 30) }}
                                        </a>
                                        <div style="font-size:.55rem;font-family:monospace;color:var(--color-gh-dim);opacity:.6;margin-bottom:.35rem;word-break:break-all;">
                                            {{ Str::limit($report->link->url, 40) }}
                                        </div>
                                        {{-- Direct visit buttons (no icon) for Tor and Clearnet --}}
                                        <div style="display:flex;gap:.3rem;flex-wrap:wrap;">
                                            <a href="{{ route('link.show', $report->link->slug) }}" target="_blank"
                                               style="font-size:.55rem;font-weight:700;padding:.2rem .5rem;border-radius:.25rem;border:1px solid rgba(88,166,255,.25);color:#58a6ff;background:rgba(88,166,255,.07);text-decoration:none;white-space:nowrap;">
                                                Open via Tor
                                            </a>
                                            @if(config('app.clearnet_url') || env('CLEARNET_URL'))
                                                @php
                                                    $clearBase = rtrim(config('app.clearnet_url', env('CLEARNET_URL', '')), '/');
                                                    $clearPath = route('link.show', $report->link->slug, false);
                                                @endphp
                                                <a href="{{ $clearBase . $clearPath }}" target="_blank"
                                                   style="font-size:.55rem;font-weight:700;padding:.2rem .5rem;border-radius:.25rem;border:1px solid rgba(74,222,128,.2);color:#4ade80;background:rgba(74,222,128,.06);text-decoration:none;white-space:nowrap;">
                                                    Open Clearnet
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <span style="font-size:.7rem;color:#f87171;opacity:.6;">Link Deleted</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-size:.7rem;color:#fff;">
                                        {{ $report->user ? $report->user->username : 'Anonymous' }}
                                    </div>
                                    @if($report->user_id)
                                        <div style="font-size:.55rem;color:var(--color-gh-dim);">ID: #{{ $report->user_id }}</div>
                                    @endif
                                </td>
                                {{-- Reporter email column --}}
                                <td>
                                    @if($report->email)
                                        <a href="mailto:{{ $report->email }}" style="font-size:.68rem;color:var(--color-gh-accent);text-decoration:none;word-break:break-all;">{{ $report->email }}</a>
                                        <div style="font-size:.55rem;color:#4ade80;margin-top:.1rem;opacity:.7;">&#10003; Will notify on approve</div>
                                    @else
                                        <span style="font-size:.65rem;color:var(--color-gh-dim);opacity:.5;">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($report->status === 'accepted')
                                        <span style="font-size:.55rem;font-weight:800;text-transform:uppercase;color:#4ade80;background:rgba(74,222,128,.1);padding:.15rem .45rem;border-radius:.2rem;border:1px solid rgba(74,222,128,.2);">Accepted</span>
                                    @elseif($report->status === 'rejected')
                                        <span style="font-size:.55rem;font-weight:800;text-transform:uppercase;color:#f87171;background:rgba(248,113,113,.1);padding:.15rem .45rem;border-radius:.2rem;border:1px solid rgba(248,113,113,.2);">Rejected</span>
                                    @else
                                        <span style="font-size:.55rem;font-weight:800;text-transform:uppercase;color:var(--color-gh-accent);background:rgba(88,166,255,.1);padding:.15rem .45rem;border-radius:.2rem;border:1px solid rgba(88,166,255,.2);">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <span style="font-size:.6rem;color:var(--color-gh-dim);">{{ $report->created_at->diffForHumans() }}</span>
                                </td>
                                <td style="text-align:right;">
                                    @if($report->status === 'pending')
                                        <form action="{{ route('admin.reports.accept', $report->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-sm" style="color:#4ade80;border-color:rgba(74,222,128,.2);" title="Accept & notify reporter{{ $report->email ? ' (' . $report->email . ')' : '' }}">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.reports.reject', $report->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-sm" style="color:#f87171;border-color:rgba(248,113,113,.2);" title="Reject Report">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.reports.delete', $report->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this report record?')">
                                        @csrf
                                        <button type="submit" class="btn-sm" style="color:var(--color-gh-dim);border-color:var(--color-gh-border);" title="Delete Record">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($reports->hasPages())
                <div style="padding:.65rem 1rem;border-top:1px solid var(--color-gh-border);">
                    {{ $reports->links('pagination.simple') }}
                </div>
            @endif
        </div>
    @else
        <div class="empty-state" style="border:1px dashed var(--color-gh-border);border-radius:.6rem;">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
            <p>No reports found.</p>
        </div>
    @endif

</x-app.layouts>
