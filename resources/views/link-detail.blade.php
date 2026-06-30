<x-app.layouts title="{{ $link->title }} - Tor .Onion Directory"
    description="Details for {{ $link->title }}: {{ Str::limit($link->description, 150) }} - Verified .onion link on {{ config('app.name') }}.">

    <style>
        .detail-layout { display: grid; grid-template-columns: 1fr; gap: 1.5rem; }
        @media (min-width: 1024px) { .detail-layout { grid-template-columns: 1fr 300px; } }

        .meta-row { display: flex; align-items: flex-start; gap: .75rem; padding: .75rem 0; border-bottom: 1px solid var(--color-gh-border); }
        .meta-row:last-child { border-bottom: none; }
        .meta-icon { width: 1.75rem; height: 1.75rem; border-radius: .35rem; border: 1px solid var(--color-gh-border); display: flex; align-items: center; justify-content: center; color: var(--color-gh-accent); flex-shrink: 0; }
        .meta-label { font-size: .6rem; font-weight: 800; color: var(--color-gh-dim); text-transform: uppercase; letter-spacing: .12em; display: block; margin-bottom: .15rem; }
        .meta-val { font-size: .8rem; font-weight: 600; color: #fff; }

        .comment-form-input {
            width: 100%; box-sizing: border-box;
            background: transparent;
            border: 1px solid var(--color-gh-border);
            border-radius: .4rem;
            padding: .55rem .75rem;
            color: #fff;
            font-size: .82rem;
            outline: none;
        }
        .comment-form-input:focus { border-color: var(--color-gh-accent); }
    </style>

    <div style="max-width:1100px;margin:0 auto;padding:0 0 3rem;">

        {{-- Breadcrumb --}}
        <nav style="display:flex;align-items:center;gap:.5rem;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.12em;color:var(--color-gh-dim);margin-bottom:1.25rem;">
            <a href="{{ route('home') }}" style="color:var(--color-gh-dim);text-decoration:none;">Home</a>
            <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" opacity=".35"><path d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('category.show', $link->category->value) }}" style="color:var(--color-gh-dim);text-decoration:none;">{{ $link->category->label() }}</a>
            <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" opacity=".35"><path d="M9 5l7 7-7 7"/></svg>
            <span style="color:#fff;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:200px;">{{ $link->title }}</span>
        </nav>



        <x-app.ads />

        <div class="detail-layout">

            {{-- ══ LEFT: Main Content ══ --}}
            <div>

                {{-- ── Hero: Title + Status + URL ── --}}
                <div style="border:1px solid var(--color-gh-border);border-radius:.5rem;padding:1.25rem;margin-bottom:1rem;">

                    {{-- Title row --}}
                    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;margin-bottom:.75rem;">
                        <div style="min-width:0;">
                            <h1 style="font-size:1.35rem;font-weight:900;color:#fff;margin:0 0 .3rem;letter-spacing:-.02em;line-height:1.2;">{{ $link->title }}</h1>
                            <div style="display:flex;flex-wrap:wrap;align-items:center;gap:.35rem .65rem;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--color-gh-dim);">
                                <span style="display:flex;align-items:center;gap:.3rem;">
                                    <span style="width:5px;height:5px;border-radius:50%;background:var(--color-gh-accent);"></span>
                                    {{ $link->category->label() }}
                                </span>
                                <span>·</span>
                                <span style="opacity:.55;font-style:italic;">via {{ $link->user->username ?? 'Anonymous' }}</span>
                            </div>
                        </div>

                        {{-- Status pill --}}
                        @php $isOnline = $link->uptime_status === \App\Enum\UptimeStatus::ONLINE; @endphp
                        <span style="flex-shrink:0;display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .75rem;border-radius:2rem;font-size:.65rem;font-weight:800;text-transform:uppercase;letter-spacing:.06em;border:1px solid {{ $isOnline ? 'rgba(74,222,128,.3)' : 'rgba(248,113,113,.3)' }};color:{{ $isOnline ? '#4ade80' : '#f87171' }};background:{{ $isOnline ? 'rgba(74,222,128,.06)' : 'rgba(248,113,113,.06)' }};">
                            <span style="width:5px;height:5px;border-radius:50%;background:{{ $isOnline ? '#4ade80' : '#f87171' }};flex-shrink:0;"></span>
                            {{ $link->uptime_status->label() }}
                        </span>
                    </div>

                    {{-- URL bar --}}
                    <div style="display:flex;align-items:center;background:var(--color-gh-btn-bg);border:1px solid var(--color-gh-border);border-radius:.4rem;overflow:hidden;margin-bottom:1rem;">
                        <span style="padding:.55rem .65rem;color:var(--color-gh-dim);display:flex;align-items:center;flex-shrink:0;">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        </span>
                        <span style="flex:1;font-family:monospace;font-size:.78rem;color:rgba(230,237,243,.7);padding:.55rem 0;user-select:all;word-break:break-all;" title="Select to copy">{{ $link->url }}</span>
                        <span style="padding:.55rem .85rem;border-left:1px solid var(--color-gh-border);color:var(--color-gh-dim);font-size:.65rem;font-weight:700;white-space:nowrap;opacity:.5;">select to copy</span>
                    </div>

                    {{-- Description --}}
                    @if($link->description)
                        <p style="font-size:.85rem;color:rgba(230,237,243,.65);line-height:1.7;margin:0 0 1rem;">{{ $link->description }}</p>
                    @endif

                    {{-- Action buttons --}}
                    <div style="display:flex;flex-wrap:wrap;align-items:center;gap:.65rem;padding-top:.9rem;border-top:1px solid var(--color-gh-border);">
                        
                        {{-- Voting Section --}}
                        <div style="display:inline-flex;align-items:center;background:var(--color-gh-btn-bg);border:1px solid var(--color-gh-border);border-radius:.4rem;padding:.2rem;margin-right:.5rem;">
                            <form action="{{ route('link.like', $link->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" title="Like this node" style="background:transparent;border:none;color:#4ade80;padding:.3rem .6rem;cursor:pointer;display:flex;align-items:center;gap:.35rem;border-radius:.3rem;transition:background 0.2s;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>
                                    <span style="font-size:.75rem;font-weight:800;">{{ number_format($link->likes_count) }}</span>
                                </button>
                            </form>
                            <span style="width:1px;height:14px;background:var(--color-gh-border);margin:0 .2rem;"></span>
                            <form action="{{ route('link.dislike', $link->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" title="Dislike this node" style="background:transparent;border:none;color:#f87171;padding:.3rem .6rem;cursor:pointer;display:flex;align-items:center;gap:.35rem;border-radius:.3rem;transition:background 0.2s;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="transform:rotate(180deg);"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>
                                    <span style="font-size:.75rem;font-weight:800;">{{ number_format($link->dislikes_count) }}</span>
                                </button>
                            </form>
                        </div>

                        <form action="{{ route('link.check', $link->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="display:inline-flex;align-items:center;gap:.4rem;background:var(--color-gh-btn-bg);color:var(--color-gh-dim);border:1px solid var(--color-gh-border);padding:.5rem .9rem;border-radius:.4rem;font-size:.75rem;font-weight:700;cursor:pointer;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                Check Status
                            </button>
                        </form>
                        <a href="{{ $link->url }}" target="_blank" rel="noreferrer noopener"
                            style="display:inline-flex;align-items:center;gap:.4rem;background:var(--color-gh-accent);color:#0d1117;border:none;padding:.5rem 1.1rem;border-radius:.4rem;font-size:.75rem;font-weight:800;cursor:pointer;text-decoration:none;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            Open in Tor
                        </a>

                        <button onclick="document.getElementById('report-form-container').style.display = 'block'; this.style.display = 'none';"
                            style="display:inline-flex;align-items:center;gap:.4rem;background:transparent;color:#f87171;border:1px solid rgba(248,113,113,.3);padding:.5rem .9rem;border-radius:.4rem;font-size:.75rem;font-weight:700;cursor:pointer;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                            Report
                        </button>
                    </div>

                    {{-- Report Form (Hidden by default) --}}
                    <div id="report-form-container" style="display:none;margin-top:1.25rem;padding:1.25rem;border:1px solid rgba(248,113,113,.2);background:rgba(248,113,113,.03);border-radius:.5rem;">
                        <h3 style="font-size:.8rem;font-weight:800;color:#f87171;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;display:flex;align-items:center;justify-content:space-between;">
                            Report this Link
                            <button onclick="document.getElementById('report-form-container').style.display = 'none'; document.querySelector('button[onclick*=\'report-form-container\']').style.display = 'inline-flex';" style="background:transparent;border:none;color:var(--color-gh-dim);cursor:pointer;font-size:1.2rem;">&times;</button>
                        </h3>

                        @php
                            // Separate report types for optgroup grouping
                            $simpleTypes  = array_filter($reportLabel, fn($r) => !$r->isComplex());
                            $complexTypes = array_filter($reportLabel, fn($r) =>  $r->isComplex());

                            // Build JS lookup: value => { label, description, isComplex }
                            $typeJsonMap = collect($reportLabel)->mapWithKeys(fn($r) => [
                                $r->value => [
                                    'label'       => $r->label(),
                                    'description' => $r->description(),
                                    'isComplex'   => $r->isComplex(),
                                    'color'       => $r->badgeColor(),
                                ],
                            ])->toJson();
                        @endphp

                        <script>
                            var _reportTypes = {!! $typeJsonMap !!};
                            function _onReportTypeChange(val) {
                                var info = _reportTypes[val];
                                if (!info) return;
                                var hint = document.getElementById('report-type-hint');
                                var badge = document.getElementById('report-type-badge');
                                var emailSection = document.getElementById('report-email-section');
                                hint.textContent = info.description;
                                badge.textContent = info.isComplex ? 'High Priority' : 'Standard';
                                badge.style.color = info.isComplex ? '#f87171' : '#58a6ff';
                                badge.style.borderColor = info.isComplex ? 'rgba(248,113,113,.3)' : 'rgba(88,166,255,.25)';
                                badge.style.background = info.isComplex ? 'rgba(248,113,113,.08)' : 'rgba(88,166,255,.08)';
                                emailSection.style.display = info.isComplex ? 'block' : 'block'; // always show email
                            }
                        </script>

                        <form action="{{ route('report.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="link_id" value="{{ $link->id }}">
                            <div style="display:grid;grid-template-columns:1fr;gap:1rem;">

                                {{-- Issue Type select + description hint --}}
                                <div>
                                    <label style="display:block;font-size:.65rem;font-weight:800;color:var(--color-gh-dim);text-transform:uppercase;letter-spacing:.1em;margin-bottom:.4rem;">Issue Type</label>
                                    <select name="type" required class="comment-form-input" style="background:var(--color-gh-bg);" onchange="_onReportTypeChange(this.value)">
                                        <optgroup label="── Simple Issues">
                                            @foreach ($simpleTypes as $report)
                                                <option value="{{ $report->value }}">{{ $report->label() }}</option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="── Complex / High Priority">
                                            @foreach ($complexTypes as $report)
                                                <option value="{{ $report->value }}">{{ $report->label() }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>

                                    {{-- Dynamic type hint --}}
                                    <div style="display:flex;align-items:flex-start;gap:.5rem;margin-top:.45rem;">
                                        <span id="report-type-badge" style="flex-shrink:0;display:inline-block;font-size:.55rem;font-weight:800;text-transform:uppercase;letter-spacing:.06em;padding:.15rem .45rem;border-radius:2rem;border:1px solid rgba(88,166,255,.25);color:#58a6ff;background:rgba(88,166,255,.08);">Standard</span>
                                        <span id="report-type-hint" style="font-size:.68rem;color:var(--color-gh-dim);line-height:1.5;"></span>
                                    </div>
                                </div>

                                {{-- Details textarea --}}
                                <div>
                                    <label style="display:block;font-size:.65rem;font-weight:800;color:var(--color-gh-dim);text-transform:uppercase;letter-spacing:.1em;margin-bottom:.4rem;">Details (Optional)</label>
                                    <textarea name="message" rows="3" class="comment-form-input" placeholder="Please provide more details about the issue..." style="background:var(--color-gh-bg);resize:vertical;"></textarea>
                                </div>

                                {{-- Optional email for notification --}}
                                <div id="report-email-section">
                                    <label style="display:block;font-size:.65rem;font-weight:800;color:var(--color-gh-dim);text-transform:uppercase;letter-spacing:.1em;margin-bottom:.2rem;">
                                        Notify Me (Optional)
                                    </label>
                                    <p style="font-size:.65rem;color:var(--color-gh-dim);opacity:.7;margin:0 0 .4rem;line-height:1.5;">
                                        Leave your email if you want to be notified when this report is reviewed. Your address is never shared or stored beyond this report.
                                    </p>
                                    <input type="email" name="email" class="comment-form-input" placeholder="your@email.com (optional)" style="background:var(--color-gh-bg);">
                                </div>

                                <div style="display:flex;justify-content:flex-end;">
                                    <button type="submit" style="padding:.5rem 1.5rem;background:#f87171;color:#fff;border:none;border-radius:.4rem;font-size:.75rem;font-weight:800;cursor:pointer;">Submit Report</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- ── Comments ── --}}
                <div style="margin-top:1.5rem;">
                    <h2 style="display:flex;align-items:center;gap:.5rem;font-size:.8rem;font-weight:800;color:#fff;text-transform:uppercase;letter-spacing:.12em;margin:0 0 1rem;">
                        <span style="display:inline-block;width:3px;height:14px;background:var(--color-gh-accent);border-radius:2px;"></span>
                        Comments
                        <span style="font-weight:700;color:var(--color-gh-dim);font-size:.7rem;">({{ $link->comments->count() }})</span>
                    </h2>

                    {{-- Comment list --}}
                    <div style="display:flex;flex-direction:column;gap:.65rem;margin-bottom:1.25rem;">
                        @forelse($link->comments as $comment)
                            <div style="border:1px solid var(--color-gh-border);border-radius:.5rem;padding:.85rem 1rem;">
                                <div style="display:flex;align-items:center;justify-content:space-between;gap:.75rem;margin-bottom:.6rem;">
                                    <div style="display:flex;align-items:center;gap:.55rem;">
                                        <div style="width:1.75rem;height:1.75rem;border-radius:.3rem;background:rgba(88,166,255,.1);border:1px solid rgba(88,166,255,.15);display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:800;color:var(--color-gh-accent);flex-shrink:0;">
                                            {{ strtoupper(substr($comment->username, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-size:.8rem;font-weight:700;color:#fff;line-height:1;">{{ $comment->username }}</div>
                                            <div style="font-size:.6rem;color:var(--color-gh-dim);margin-top:.1rem;opacity:.6;">Verified</div>
                                        </div>
                                    </div>
                                    <span style="font-size:.65rem;color:var(--color-gh-dim);flex-shrink:0;">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p style="font-size:.82rem;color:rgba(230,237,243,.7);line-height:1.65;margin:0;padding-left:2.3rem;">{{ $comment->content }}</p>
                            </div>
                        @empty
                            <div style="border:1px dashed var(--color-gh-border);border-radius:.5rem;padding:2rem;text-align:center;">
                                <p style="font-size:.75rem;color:var(--color-gh-dim);margin:0;opacity:.5;">No comments yet. Be the first.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Comment form --}}
                    <div style="border:1px solid var(--color-gh-border);border-radius:.5rem;overflow:hidden;">
                        <div style="padding:.6rem 1rem;border-bottom:1px solid var(--color-gh-border);font-size:.72rem;font-weight:800;color:var(--color-gh-dim);text-transform:uppercase;letter-spacing:.1em;">
                            Post a Comment
                        </div>
                        <div style="padding:1rem;">
                            <form action="{{ route('link.comment', $link->id) }}" method="POST" style="display:flex;flex-direction:column;gap:.75rem;">
                                @csrf
                                <div style="display:none;"><input type="text" name="website_url_hp" tabindex="-1"></div>

                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.65rem;">
                                    <div style="display:flex;flex-direction:column;gap:.3rem;">
                                        <label for="username" style="font-size:.62rem;font-weight:700;color:var(--color-gh-dim);text-transform:uppercase;letter-spacing:.1em;">Identity (Optional)</label>
                                        @auth
                                            <div style="background:var(--color-gh-btn-bg);border:1px solid var(--color-gh-border);border-radius:.4rem;padding:.55rem .75rem;font-size:.82rem;color:rgba(230,237,243,.45);font-weight:600;">{{ auth()->user()->username }}</div>
                                            <input type="hidden" name="username" value="{{ auth()->user()->username }}">
                                        @else
                                            <input type="text" name="username" id="username" placeholder="Anonymous (Auto-generated if empty)" class="comment-form-input">
                                        @endauth
                                    </div>
                                    <div style="display:flex;flex-direction:column;gap:.3rem;">
                                        <label for="challenge" style="font-size:.62rem;font-weight:700;color:var(--color-gh-dim);text-transform:uppercase;letter-spacing:.1em;">Human test: {{ $challenge }}</label>
                                        <input type="number" name="challenge" id="challenge" required placeholder="Answer" class="comment-form-input">
                                    </div>
                                </div>

                                <div style="display:flex;flex-direction:column;gap:.3rem;">
                                    <label for="content" style="font-size:.62rem;font-weight:700;color:var(--color-gh-dim);text-transform:uppercase;letter-spacing:.1em;">Comment</label>
                                    <textarea name="content" id="content" required rows="4" placeholder="Share your experience with this node…" class="comment-form-input" style="resize:vertical;"></textarea>
                                </div>

                                <div>
                                    <button type="submit" style="padding:.55rem 1.25rem;background:var(--color-gh-accent);color:#0d1117;border:none;border-radius:.4rem;font-size:.75rem;font-weight:800;cursor:pointer;text-transform:uppercase;letter-spacing:.08em;">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

       
            </div>

            {{-- ══ RIGHT: Sidebar ══ --}}
            <aside style="display:flex;flex-direction:column;gap:1rem;">

                {{-- Node Vitals --}}
                <div style="border:1px solid var(--color-gh-border);border-radius:.5rem;overflow:hidden;">
                    <div style="padding:.6rem 1rem;border-bottom:1px solid var(--color-gh-border);font-size:.68rem;font-weight:800;color:var(--color-gh-dim);text-transform:uppercase;letter-spacing:.12em;">
                        Node Vitals
                    </div>
                    
              

                    <div style="padding:.25rem .75rem;">
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            </div>
                            <div>
                                <span class="meta-label">Registered</span>
                                <span class="meta-val">{{ $link->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div>
                                <span class="meta-label">Last Check</span>
                                <span class="meta-val">{{ $link->last_check ? $link->last_check->diffForHumans() : '—' }}</span>
                            </div>
                        </div>
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                            </div>
                            <div>
                                <span class="meta-label">Total Checks</span>
                                <span class="meta-val">{{ number_format($link->check_count) }}</span>
                            </div>
                        </div>
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            </div>
                            <div>
                                <span class="meta-label">Category</span>
                                <span class="meta-val">{{ $link->category->label() }}</span>
                            </div>
                        </div>
                    </div>

                </div>



                {{-- Security notice --}}
                <div style="border:1px solid rgba(248,113,113,.2);border-radius:.5rem;padding:.85rem 1rem;">
                    <h4 style="display:flex;align-items:center;gap:.4rem;font-size:.65rem;font-weight:800;color:#f87171;text-transform:uppercase;letter-spacing:.1em;margin:0 0 .5rem;">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" stroke-linecap="round"/></svg>
                        Safety
                    </h4>
                    <p style="font-size:.75rem;color:rgba(230,237,243,.5);line-height:1.6;margin:0;">Never share personal info. Always use Tor Browser with scripts disabled for maximum anonymity.</p>
                </div>


            </aside>

        </div>


    </div>



</x-app.layouts>