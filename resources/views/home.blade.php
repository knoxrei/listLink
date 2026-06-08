<x-app.layouts title="Verified Tor .Onion Directory"
    description="The most reliable Tor hidden services directory. Daily uptime monitoring, verified .onion links, and community driven indexing.">

    <style>
        .stats-grid {
            margin-top: 3rem;
            width: 100%;
            max-width: 850px;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1rem;
            border-top: 1px solid rgba(48, 54, 61, .4);
            padding-top: 1.5rem;
            text-align: center;
        }

        .activity-grid {
            max-width: 1200px;
            margin: 2rem auto 0;
            padding: 0 1rem 3rem;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 2rem;
            opacity: .75;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }

            .stats-grid>div:last-child {
                grid-column: span 2;
            }

            .activity-grid {
                grid-template-columns: 1fr;
                gap: 2.5rem;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid>div:last-child {
                grid-column: auto;
            }
        }

        .home-ads-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            width: 100%;
            justify-items: center;
        }

        @media (min-width: 1024px) {
            .home-ads-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>

    <div
        style="display:flex;flex-direction:column;min-height:65vh;align-items:center;justify-content:center;padding:1rem;">





        {{-- Hero --}}
        <div
            style="width:100%;max-width:600px;display:flex;flex-direction:column;align-items:center;margin-bottom:2rem;text-align:center;">
            <x-app.logo style="height:7rem;margin-bottom:.5rem;opacity:.9;" />
            <h1 style="font-size:2rem;font-weight:900;color:#fff;letter-spacing:-.02em;margin:0 0 .3rem;">
                {{ config('app.name') }}
            </h1>
            <p
                style="font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;color:var(--color-gh-dim);margin:0;">
                Decentralized Search Protocol without javascript</p>

            {{-- ── Dual Gateway Badge ── --}}
            @php
            $torUrl = config('site.tor_url');
            $clearnetUrl = config('site.clearnet_url');
            $currentHost = request()->getHost();
            $torHost = parse_url($torUrl, PHP_URL_HOST);
            $isOnTor = $torHost && str_ends_with($currentHost, $torHost);
            @endphp
            @if($clearnetUrl)
            <div
                style="display:flex;align-items:center;gap:.5rem;margin-top:.85rem;flex-wrap:wrap;justify-content:center;">
                {{-- Tor Gate --}}
                <a href="{{ $torUrl }}" title="Access via Tor Network"
                    style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .7rem;border-radius:2rem;border:1px solid {{ $isOnTor ? 'rgba(74,222,128,.55)' : 'rgba(48,54,61,.7)' }};background:{{ $isOnTor ? 'rgba(74,222,128,.08)' : 'rgba(13,17,23,.6)' }};text-decoration:none;">
                    {{-- Tor onion SVG --}}
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                        stroke="{{ $isOnTor ? '#4ade80' : 'var(--color-gh-dim)' }}" stroke-width="2.5"
                        stroke-linecap="round">
                        <circle cx="12" cy="12" r="10" />
                        <path
                            d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                        <path d="M2 12h20" />
                    </svg>
                    <span
                        style="font-size:.58rem;font-weight:800;text-transform:uppercase;letter-spacing:.12em;color:{{ $isOnTor ? '#4ade80' : 'var(--color-gh-dim)' }};">
                        Tor Gate
                    </span>
                    @if($isOnTor)
                    <span
                        style="width:5px;height:5px;border-radius:50%;background:#4ade80;box-shadow:0 0 5px #4ade80;"></span>
                    @endif
                </a>

                <span style="color:var(--color-gh-border);font-size:.65rem;">↔</span>

                {{-- Clearnet Gate --}}
                <a href="{{ $clearnetUrl }}" title="Access via Clearnet (HTTPS)"
                    style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .7rem;border-radius:2rem;border:1px solid {{ !$isOnTor ? 'rgba(88,166,255,.55)' : 'rgba(48,54,61,.7)' }};background:{{ !$isOnTor ? 'rgba(88,166,255,.08)' : 'rgba(13,17,23,.6)' }};text-decoration:none;">
                    {{-- HTTPS lock SVG --}}
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                        stroke="{{ !$isOnTor ? 'var(--color-gh-accent)' : 'var(--color-gh-dim)' }}" stroke-width="2.5"
                        stroke-linecap="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    <span
                        style="font-size:.58rem;font-weight:800;text-transform:uppercase;letter-spacing:.12em;color:{{ !$isOnTor ? 'var(--color-gh-accent)' : 'var(--color-gh-dim)' }};">
                        Clearnet Gate
                    </span>
                    @if(!$isOnTor)
                    <span
                        style="width:5px;height:5px;border-radius:50%;background:var(--color-gh-accent);box-shadow:0 0 5px var(--color-gh-accent);"></span>
                    @endif
                </a>
            </div>
            @endif
        </div>


        {{-- Search --}}
        <form action="{{ route('search.index') }}" method="GET" style="width:100%;max-width:540px;">
            <div
                style="display:flex;align-items:center;background:var(--color-gh-btn-bg);border:1px solid var(--color-gh-border);border-radius:.6rem;overflow:hidden;">
                <span
                    style="padding:.6rem .75rem;color:var(--color-gh-dim);display:flex;align-items:center;flex-shrink:0;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <circle cx="11" cy="11" r="8" />
                        <path d="M21 21l-4.35-4.35" />
                    </svg>
                </span>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search anything on the darknet..."
                    style="flex:1;background:transparent;border:none;color:#fff;font-size:.95rem;padding:.6rem .25rem;outline:none;">
                <button type="submit"
                    style="background:var(--color-gh-accent);color:#0d1117;padding:.6rem 1.1rem;border:none;font-weight:800;font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;cursor:pointer;white-space:nowrap;">Search</button>
            </div>

            <div style="display:flex;justify-content:center;gap:1.2rem;margin-top:1.2rem;align-items:center;">
                <a href="{{ route('directory') }}"
                    style="font-size:.65rem;font-weight:800;color:var(--color-gh-dim);text-transform:uppercase;letter-spacing:.12em;text-decoration:none;">Browse
                    Directory</a>
                <span style="color:var(--color-gh-border);">|</span>
                <a href="{{ route('submit.create') }}"
                    style="font-size:.65rem;font-weight:800;color:var(--color-gh-dim);text-transform:uppercase;letter-spacing:.12em;text-decoration:none;">
                    Submit Link</a>
                <span style="color:var(--color-gh-border);">|</span>
                <a href="{{ route('advertise.create') }}"
                    style="font-size:.65rem;font-weight:800;color:var(--color-gh-sponsored);text-transform:uppercase;letter-spacing:.12em;text-decoration:none;">
                    Advertise</a>
                <span style="color:var(--color-gh-border);">|</span>
                <a href="{{ route('leaderboard') }}"
                    style="font-size:.65rem;font-weight:800;color:var(--color-gh-accent);text-transform:uppercase;letter-spacing:.12em;text-decoration:none;">
                    Elite</a>
            </div>
        </form>

        {{-- ── Announcement Banner ── --}}
        <div id="home-announce" style="width:100%;max-width:540px;margin-top:1.1rem;display:flex;align-items:flex-start;gap:.7rem;padding:.75rem 1rem;border-radius:.45rem;background:rgba(74,222,128,.06);border:1px solid rgba(74,222,128,.2);position:relative;">
            <div style="flex:1;min-width:0;">
                <span style="font-size:.72rem;font-weight:800;color:#4ade80;letter-spacing:.01em;">Advertise Form Now Open — </span>
                <span style="font-size:.72rem;color:var(--color-gh-dim);line-height:1.5;">We apologize for the previous issue. The form is fully restored.
                    <a href="{{ route('advertise.create') }}" style="color:var(--color-gh-accent);font-weight:700;text-decoration:none;">Advertise now →</a>
                </span>
            </div>
            <button onclick="this.parentElement.style.display='none';"
                style="background:none;border:none;color:var(--color-gh-dim);cursor:pointer;font-size:.85rem;padding:0 .1rem;flex-shrink:0;line-height:1;opacity:.6;"
                title="Dismiss">✕</button>
        </div>



        {{-- Internal & AdMate Ads Section --}}
        <div style="margin-top: 3rem; width: 100%; max-width: 970px; display: flex; flex-direction: column; align-items: center; gap: 1.5rem;">



            {{-- Internal Header Ads --}}
            @if (isset($headerAds) && $headerAds->count() > 0)
            <div class="home-ads-grid">
                @foreach ($headerAds as $ad)
                <div style="position:relative;width:468px;height:60px;border-radius:.4rem;overflow:hidden;border:1px solid var(--color-gh-border);flex-shrink:0;">
                    @if ($ad->banner_path)
                    <a href="{{ route('ad.track', $ad->id) }}" style="display:block;width:100%;height:100%;">
                        <img src="{{ asset('storage/' . $ad->banner_path) }}" alt="{{ $ad->title }}" style="width:100%;height:100%;object-fit:cover;">
                    </a>
                    @else
                    <a href="{{ route('ad.track', $ad->id) }}" style="display:flex;width:100%;height:100%;align-items:center;justify-content:center;text-decoration:none;background:var(--color-gh-btn-bg);">
                        <div style="text-align:center;">
                            <div style="font-size:.7rem;font-weight:700;color:#fff;text-transform:uppercase;letter-spacing:.05em;">{{ $ad->title }}</div>
                            <div style="font-size:.55rem;font-family:monospace;color:var(--color-gh-dim);opacity:.6;">{{ $ad->url }}</div>
                        </div>
                    </a>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

        </div>

    </div>

    {{-- Live Activity --}}
    <div style="width:100%;max-width:1100px;margin:3rem auto;padding:0 1rem;">
        <h2 style="font-size:1.1rem;font-weight:800;color:#fff;margin-bottom:1.5rem;text-transform:uppercase;letter-spacing:.05em;display:flex;align-items:center;gap:.5rem;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--color-gh-accent);">
                <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
            </svg>
            Live Activity
        </h2>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:2rem;">
            {{-- Latest Users --}}
            <div style="background:var(--color-gh-bg);border:1px solid var(--color-gh-border);border-radius:.6rem;padding:1.2rem;">
                <h3 style="font-size:.85rem;color:var(--color-gh-dim);text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;padding-bottom:.5rem;border-bottom:1px solid var(--color-gh-border);">New Citizens</h3>
                <div style="display:flex;flex-direction:column;gap:.8rem;">
                    @foreach($latestUsers as $user)
                    <div style="display:flex;align-items:center;gap:.75rem;">
                        <div style="width:32px;height:32px;border-radius:50%;background:rgba(88,166,255,.1);border:1px solid rgba(88,166,255,.2);display:flex;align-items:center;justify-content:center;color:var(--color-gh-accent);font-weight:700;font-size:.8rem;">
                            {{ substr($user->username, 0, 1) }}
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:.85rem;color:#fff;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $user->username }}</div>
                            <div style="font-size:.65rem;color:var(--color-gh-dim);">Joined {{ $user->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Latest Links --}}
            <div style="background:var(--color-gh-bg);border:1px solid var(--color-gh-border);border-radius:.6rem;padding:1.2rem;">
                <h3 style="font-size:.85rem;color:var(--color-gh-dim);text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;padding-bottom:.5rem;border-bottom:1px solid var(--color-gh-border);">New Links</h3>
                <div style="display:flex;flex-direction:column;gap:.8rem;">
                    @foreach($latestLinks as $link)
                    <div style="display:flex;flex-direction:column;gap:.2rem;border-bottom:1px solid rgba(48,54,61,.4);padding-bottom:.5rem;">
                        <a href="{{ route('link.show', $link->id) }}" style="font-size:.85rem;color:var(--color-gh-accent);font-weight:600;text-decoration:none;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            {{ $link->title }}
                        </a>
                        <div style="font-size:.65rem;color:var(--color-gh-dim);display:flex;align-items:center;gap:.3rem;">
                            Added by <span style="color:#fff;">{{ $link->user ? $link->user->username : 'Anonymous' }}</span> • {{ $link->created_at->diffForHumans() }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>


        </div>
    </div>

</x-app.layouts>