<x-app.layouts title="Advertise">

    <style>
        .pkg-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        @media (max-width: 600px) {
            .pkg-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-input {
            width: 100%;
            box-sizing: border-box;
            background: var(--color-gh-btn-bg);
            border: 1px solid var(--color-gh-border);
            border-radius: .4rem;
            padding: .55rem .75rem;
            color: #fff;
            font-size: .85rem;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--color-gh-accent);
            box-shadow: 0 0 0 3px rgba(88, 166, 255, 0.1);
        }

        .form-label {
            font-size: .7rem;
            font-weight: 700;
            color: var(--color-gh-dim);
            text-transform: uppercase;
            letter-spacing: .1em;
            display: block;
            margin-bottom: .3rem;
        }

        .stats-contact-grid {
            display: grid;
            grid-template-columns: 2fr 1.5fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
            align-items: start;
        }

        @media (max-width: 768px) {
            .stats-contact-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }

        /* Leaderboard Table Styles */
        .leaderboard-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 .5rem;
        }

        .leaderboard-table tr {
            background: rgba(255, 255, 255, 0.02);
        }

        .leaderboard-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .leaderboard-table td {
            padding: .75rem;
            border-top: 1px solid var(--color-gh-border);
            border-bottom: 1px solid var(--color-gh-border);
        }

        .leaderboard-table td:first-child {
            border-left: 1px solid var(--color-gh-border);
            border-top-left-radius: .5rem;
            border-bottom-left-radius: .5rem;
            font-weight: 800;
            color: var(--color-gh-dim);
            text-align: center;
        }

        .leaderboard-table td:last-child {
            border-right: 1px solid var(--color-gh-border);
            border-top-right-radius: .5rem;
            border-bottom-right-radius: .5rem;
        }

        .stats-count {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .count-value {
            font-weight: 800;
            line-height: 1;
        }

        .count-label {
            font-size: .55rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: var(--color-gh-dim);
            margin-top: .15rem;
        }

        /* Premium Polish */
        .premium-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.03) 0%, rgba(255, 255, 255, 0.01) 100%);
            border: 1px solid var(--color-gh-border);
        }

        .premium-card:hover {
            border-color: rgba(88, 166, 255, 0.4);
        }

        .btn-primary {
            background: var(--color-gh-accent);
            color: #0d1117;
            border: none;
            border-radius: .5rem;
            font-weight: 900;
            font-size: .85rem;
            text-transform: uppercase;
            letter-spacing: .12em;
            cursor: pointer;
        }
    </style>

    <div style="max-width:960px;margin:0 auto;padding:1rem 0 3rem;">

        {{-- Page header --}}
        <div style="margin-bottom:1.25rem;padding-bottom:.75rem;border-bottom:1px solid var(--color-gh-border);">
            <h1 style="font-size:1.5rem;font-weight:900;color:#fff;margin:0 0 .3rem;letter-spacing:-.02em;">Advertise on
                {{ config('app.name') }}
            </h1>
            <p style="color:var(--color-gh-dim);font-size:.85rem;margin:0;">Promote your .onion service to a
                privacy-conscious audience pay with Bitcoin.</p>
        </div>


        {{-- ═══ Pricing Tiers ═══ --}}
        <div style="margin-bottom:1.5rem;">
            <h2
                style="font-size:.8rem;font-weight:800;text-transform:uppercase;letter-spacing:.12em;color:var(--color-gh-dim);margin:0 0 .75rem;">
                Choose Your Package</h2>

            @foreach($packageGroups as $groupTitle => $groupPkgs)
            @if(!empty($groupPkgs))
            @if(!$loop->first)
            <hr style="border:none;border-top:1px dashed rgba(48,54,61,.5);margin:1.25rem 0 .75rem;">
            @endif
            <h3
                style="font-size:.65rem;font-weight:800;text-transform:uppercase;letter-spacing:.15em;color:var(--color-gh-dim);margin:0 0 .6rem;">
                {{ $groupTitle }}
            </h3>
            <div class="pkg-grid" style="{{ count($groupPkgs) == 2 ? 'grid-template-columns: repeat(2, 1fr);' : '' }}">
                @foreach ($groupPkgs as $pkg)
                @php
                $color = $pkg->badgeColor();
                $icons = [
                'basic' => '⚡',
                'standard' => '⭐',
                'premium' => '💎',
                'sponsored_14' => '🔗',
                'sponsored_30' => '🚀',
                'sidebar_14' => '📌',
                'sidebar_30' => '🔥'
                ];
                $icon = $icons[$pkg->value] ?? '📦';
                @endphp
                <div class="premium-card"
                    style="border-radius:.5rem;overflow:hidden;position:relative;display:flex;flex-direction:column; {{ $pkg->isPopular() ? 'border-color: var(--color-gh-accent);' : '' }}">

                    @if ($pkg->isPopular())
                    <span
                        style="position:absolute;top:.5rem;right:.5rem;background:var(--color-gh-accent);color:#0d1117;font-size:.58rem;font-weight:800;text-transform:uppercase;letter-spacing:.08em;padding:.2rem .5rem;border-radius:2rem;z-index:1;">Popular</span>
                    @endif

                    <div style="padding:1rem;border-bottom:1px solid var(--color-gh-border);position:relative;">
                        <div
                            style="width:2.2rem;height:2.2rem;border-radius:.5rem;background:{{ $color }}22;display:flex;align-items:center;justify-content:center;font-size:1.1rem;margin-bottom:.75rem;border:1px solid {{ $color }}44;">
                            {{ $icon }}
                        </div>
                        <div style="color:#fff;font-weight:800;font-size:.9rem;margin-bottom:.15rem;">
                            {{ $pkg->label() }}
                        </div>
                        <div
                            style="color:var(--color-gh-dim);font-size:.65rem;text-transform:uppercase;letter-spacing:.05em;font-weight:700;">
                            {{ $pkg->durationDays() }}-day campaign
                        </div>
                        <div style="margin-top:.75rem;display:flex;align-items:baseline;gap:.25rem;">
                            <span
                                style="font-size:1.75rem;font-weight:900;color:#fff;line-height:1;">${{ $pkg->priceUsd() }}</span>
                            <span style="font-size:.65rem;color:var(--color-gh-dim);font-weight:700;">USD</span>
                        </div>
                    </div>

                    <div style="padding:1rem;flex:1;">
                        <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.5rem;">
                            @foreach ($pkg->features() as $feature)
                            <li
                                style="display:flex;align-items:flex-start;gap:.5rem;font-size:.75rem;color:var(--color-gh-dim);line-height:1.4;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#4ade80"
                                    stroke-width="3" style="margin-top:2px;flex-shrink:0;">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>{{ $feature }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            @endforeach
        </div>

        <hr style="border:none;border-top:1px solid var(--color-gh-border);margin:1.5rem 0;">

        {{-- Ad Type Examples --}}
        <div style="margin-bottom:1.5rem;">
            <h2
                style="font-size:.8rem;font-weight:800;text-transform:uppercase;letter-spacing:.12em;color:var(--color-gh-dim);margin:0 0 .75rem;">
                Ad Types &amp; Placements</h2>
            <div style="display:flex;flex-direction:column;gap:.65rem;">

                {{-- Header Banner --}}
                <div style="border:1px solid var(--color-gh-border);border-radius:.5rem;overflow:hidden;">
                    <div
                        style="padding:.65rem 1rem;border-bottom:1px solid var(--color-gh-border);display:flex;align-items:center;justify-content:space-between;gap:.5rem;">
                        <div>
                            <h3 style="color:#fff;font-weight:700;font-size:.85rem;margin:0 0 .1rem;">Header Banner</h3>
                            <p style="color:var(--color-gh-dim);font-size:.7rem;margin:0;">Full-width banner at the top
                                of every page</p>
                        </div>
                        <span
                            style="background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.2);padding:.25rem .55rem;border-radius:.3rem;font-size:.68rem;font-weight:700;white-space:nowrap;">670
                            × 76 px</span>
                    </div>
                    <div style="padding:1rem;">
                        <div
                            style="border:1px solid var(--color-gh-border);border-radius:.4rem;min-height:80px;display:flex;align-items:center;justify-content:center;position:relative;">
                            <span
                                style="position:absolute;top:.3rem;right:.5rem;background:rgba(0,0,0,.7);color:var(--color-gh-dim);padding:.1rem .4rem;border-radius:.2rem;font-size:.58rem;font-weight:700;text-transform:uppercase;">Sponsored</span>
                            <div style="text-align:center;">
                                <div style="font-size:1rem;font-weight:700;color:#fff;margin-bottom:.25rem;">Your
                                    Service Name Here</div>
                                <div style="font-family:monospace;font-size:.72rem;color:var(--color-gh-accent);">
                                    http://yourservice.onion</div>
                            </div>
                        </div>
                        <p style="font-size:.72rem;color:var(--color-gh-dim);margin:.65rem 0 0;"><span
                                style="color:#fff;font-weight:700;">Standard banner:</span> 670×76 px &middot;
                            PNG/GIF/WebP/JPG (GIF animation is preserved)</p>
                    </div>
                </div>

                {{-- Sidebar + Sponsored side-by-side on wider screens --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.65rem;">
                    {{-- Sidebar --}}
                    <div style="border:1px solid var(--color-gh-border);border-radius:.5rem;overflow:hidden;">
                        <div
                            style="padding:.65rem 1rem;border-bottom:1px solid var(--color-gh-border);display:flex;align-items:center;justify-content:space-between;gap:.5rem;">
                            <div>
                                <h3 style="color:#fff;font-weight:700;font-size:.85rem;margin:0 0 .1rem;">Sidebar Banner
                                </h3>
                                <p style="color:var(--color-gh-dim);font-size:.7rem;margin:0;">Sidebar placement on
                                    homepage</p>
                            </div>
                            <span
                                style="background:rgba(88,166,255,.1);color:var(--color-gh-accent);border:1px solid rgba(88,166,255,.2);padding:.25rem .55rem;border-radius:.3rem;font-size:.68rem;font-weight:700;white-space:nowrap;">300×250</span>
                        </div>
                        <div style="padding:1rem;text-align:center;">
                            <div
                                style="border:1px solid var(--color-gh-border);border-radius:.4rem;min-height:100px;display:flex;flex-direction:column;align-items:center;justify-content:center;position:relative;padding:.75rem;">
                                <span
                                    style="position:absolute;top:.3rem;right:.4rem;background:rgba(0,0,0,.7);color:var(--color-gh-dim);padding:.1rem .35rem;border-radius:.2rem;font-size:.55rem;font-weight:700;text-transform:uppercase;">Ad</span>
                                <div style="font-size:.85rem;font-weight:700;color:#fff;margin-bottom:.25rem;">Your
                                    Banner Ad</div>
                                <div style="font-family:monospace;font-size:.65rem;color:var(--color-gh-accent);">
                                    http://example.onion</div>
                            </div>
                            <p style="font-size:.7rem;color:var(--color-gh-dim);margin:.5rem 0 0;"><span
                                    style="color:#fff;font-weight:700;">From:</span> Standard+</p>
                        </div>
                    </div>

                    {{-- Sponsored Link --}}
                    <div style="border:1px solid var(--color-gh-border);border-radius:.5rem;overflow:hidden;">
                        <div
                            style="padding:.65rem 1rem;border-bottom:1px solid var(--color-gh-border);display:flex;align-items:center;justify-content:space-between;gap:.5rem;">
                            <div>
                                <h3 style="color:#fff;font-weight:700;font-size:.85rem;margin:0 0 .1rem;">Sponsored Link
                                </h3>
                                <p style="color:var(--color-gh-dim);font-size:.7rem;margin:0;">Within listings with
                                    "Sponsored" label</p>
                            </div>
                            <span
                                style="background:rgba(168,85,247,.1);color:#a855f7;border:1px solid rgba(168,85,247,.2);padding:.25rem .55rem;border-radius:.3rem;font-size:.68rem;font-weight:700;white-space:nowrap;">Text</span>
                        </div>
                        <div style="padding:1rem;">
                            <div style="border:1px solid var(--color-gh-border);border-radius:.4rem;overflow:hidden;">
                                <div style="padding:.4rem .75rem;background:rgba(168,85,247,.05);">
                                    <div style="display:flex;align-items:center;gap:.4rem;font-size:.78rem;">
                                        <span
                                            style="background:rgba(168,85,247,.1);color:#a855f7;border:1px solid rgba(168,85,247,.2);padding:.1rem .35rem;border-radius:.2rem;font-size:.58rem;font-weight:700;text-transform:uppercase;">Ad</span>
                                        <a href="#"
                                            style="color:var(--color-gh-accent);font-weight:700;font-size:.78rem;">Your
                                            Service Name</a>
                                    </div>
                                </div>
                            </div>
                            <p style="font-size:.7rem;color:var(--color-gh-dim);margin:.5rem 0 0;"><span
                                    style="color:#fff;font-weight:700;">Available:</span> All packages</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <hr style="border:none;border-top:1px solid var(--color-gh-border);margin:1.5rem 0;">

        {{-- ═══ Submission Form ═══ --}}
        <div style="border:1px solid var(--color-gh-border);border-radius:.5rem;overflow:hidden;">
            <div
                style="padding:.7rem 1rem;border-bottom:1px solid var(--color-gh-border);color:#fff;font-weight:700;font-size:.85rem;">
                Submit Ad Request
            </div>
            <div style="padding:1.25rem;">
                <form action="{{ route('advertise.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- Honeypot --}}
                    <div style="display:none;"><input type="text" name="website_url_hp" tabindex="-1"
                            autocomplete="off"></div>

                    {{-- Package --}}
                    <div style="margin-bottom:1rem;">
                        <label class="form-label" for="form-package-tier">Package *</label>
                        <select name="package_tier" id="form-package-tier" required
                            style="width:100%;box-sizing:border-box;background:var(--color-gh-btn-bg);border:1px solid var(--color-gh-border);border-radius:.4rem;padding:.55rem .75rem;color:#fff;font-size:.85rem;outline:none;appearance:none;">
                            <option value="">— Select a package —</option>
                            @foreach ($packages as $pkg)
                            <option value="{{ $pkg->value }}" {{ old('package_tier') === $pkg->value ? 'selected' : '' }}>
                                {{ $pkg->label() }} — ${{ $pkg->priceUsd() }} USD · {{ $pkg->durationDays() }} days
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Title + URL --}}
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                        <div>
                            <label class="form-label" for="ad-title">Ad Title *</label>
                            <input type="text" name="title" id="ad-title" value="{{ old('title') }}" class="form-input"
                                placeholder="Your service name" required minlength="3" maxlength="100">
                        </div>
                        <div>
                            <label class="form-label" for="ad-url">Destination URL *</label>
                            <input type="text" name="url" id="ad-url" value="{{ old('url') }}" class="form-input"
                                style="font-family:monospace;"
                                placeholder="http://yourservice.onion or https://example.com" required>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div style="margin-bottom:1rem;">
                        <label class="form-label" for="ad-desc">Description (optional)</label>
                        <textarea name="description" id="ad-desc" rows="2" class="form-input"
                            style="resize:vertical;min-height:56px;"
                            placeholder="Short description of your service — max 500 characters"
                            maxlength="500">{{ old('description') }}</textarea>
                    </div>

                    {{-- Ad Type + Placement + Contact --}}
                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem;margin-bottom:1rem;">
                        <div>
                            <label class="form-label" for="ad-type">Ad Type *</label>
                            <select name="ad_type" id="ad-type" required class="form-input" style="appearance:none;">
                                @foreach ($adTypes as $type)
                                <option value="{{ $type->value }}" {{ old('ad_type') === $type->value ? 'selected' : '' }}>{{ $type->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="form-label" for="ad-placement">Placement *</label>
                            <select name="placement" id="ad-placement" required class="form-input"
                                style="appearance:none;">
                                @foreach ($placements as $placement)
                                <option value="{{ $placement->value }}" {{ old('placement') === $placement->value ? 'selected' : '' }}>{{ $placement->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="form-label" for="ad-contact">Contact Info *</label>
                            <input type="text" name="contact_info" id="ad-contact" value="{{ old('contact_info') }}"
                                class="form-input" placeholder="Email " required>
                        </div>
                    </div>

                    {{-- Banner --}}
                    <div style="margin-bottom:1.25rem;">
                        <label class="form-label" for="ad-banner">Banner Image (optional)</label>
                        <input type="file" name="banner" id="ad-banner" class="form-input"
                            style="padding:.4rem .6rem;font-size:.75rem;color:var(--color-gh-dim);"
                            accept="image/png,image/jpg,image/jpeg,image/gif,image/webp">
                        <div style="font-size:.62rem;color:var(--color-gh-dim);margin-top:.25rem;line-height:1.5;">
                            Max 2 MB &middot; PNG/JPG/WebP/GIF &middot; <strong style="color:#fff;">Auto-resized &amp;
                                compressed</strong>
                        </div>
                        <div id="pub-banner-preview-wrap" style="display:none;margin-top:.5rem;">
                            <p
                                style="font-size:.6rem;color:var(--color-gh-dim);text-transform:uppercase;letter-spacing:.08em;margin:0 0 .2rem;">
                                Preview</p>
                            <img id="pub-banner-preview-img" alt="Banner preview"
                                style="width:670px;max-width:100%;height:76px;object-fit:cover;border-radius:.35rem;border:1px solid var(--color-gh-accent);display:block;">
                        </div>
                        <script>
                            (function() {
                                var inp = document.getElementById('ad-banner');
                                var wrap = document.getElementById('pub-banner-preview-wrap');
                                var img = document.getElementById('pub-banner-preview-img');
                                if (!inp) return;
                                inp.addEventListener('change', function() {
                                    if (!this.files || !this.files[0]) return;
                                    var r = new FileReader();
                                    r.onload = function(e) {
                                        img.src = e.target.result;
                                        wrap.style.display = 'block';
                                    };
                                    r.readAsDataURL(this.files[0]);
                                });
                            })();
                        </script>
                    </div>

                    {{-- Challenge + Submit --}}
                    <div
                        style="display:flex;flex-direction:column;align-items:center;gap:1rem;padding-top:1.25rem;border-top:1px solid var(--color-gh-border);">
                        <div style="display:flex;flex-direction:column;align-items:center;gap:.5rem;">
                            <label class="form-label" style="margin-bottom:0;" for="ad-challenge">{{ $challenge }}
                                *</label>
                            <input type="number" name="challenge" id="ad-challenge" required placeholder="?"
                                class="form-input"
                                style="width:7rem;text-align:center;font-weight:900;font-size:1.2rem;padding:.4rem;">
                            <div
                                style="font-size:.6rem;color:var(--color-gh-dim);text-transform:uppercase;letter-spacing:.1em;font-weight:800;">
                                Human Verification</div>
                        </div>
                        <button type="submit" class="btn-primary"
                            style="width:100%;max-width:380px;padding:.85rem;box-shadow:0 4px 12px rgba(88,166,255,0.2);">
                            Submit Advertisement Request
                        </button>
                    </div>
                </form>
            </div>
        </div>

</x-app.layouts>