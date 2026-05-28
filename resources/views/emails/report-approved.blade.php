<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Approved</title>
    <style>
        body { margin: 0; padding: 0; background: #0d1117; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        .wrapper { max-width: 600px; margin: 0 auto; padding: 32px 16px; }
        .card { background: #161b22; border: 1px solid #30363d; border-radius: 8px; overflow: hidden; }

        /* Header */
        .header { background: #1c2128; border-bottom: 1px solid #30363d; padding: 20px 24px; }
        .header-badge { display: inline-block; background: rgba(74,222,128,.12); border: 1px solid rgba(74,222,128,.25); color: #4ade80; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: .08em; padding: 3px 10px; border-radius: 20px; margin-bottom: 8px; }
        .header-title { color: #e6edf3; font-size: 18px; font-weight: 800; margin: 0; letter-spacing: -.02em; }
        .header-sub { color: #7d8590; font-size: 13px; margin: 4px 0 0; }

        /* Body */
        .body { padding: 24px; }
        .greeting { font-size: 14px; color: #e6edf3; line-height: 1.6; margin-bottom: 20px; }
        .section-label { font-size: 10px; font-weight: 800; color: #7d8590; text-transform: uppercase; letter-spacing: .12em; margin: 0 0 10px; }

        /* Detail grid */
        .detail-grid { background: #0d1117; border: 1px solid #30363d; border-radius: 6px; overflow: hidden; margin-bottom: 20px; }
        .detail-row { display: flex; border-bottom: 1px solid #21262d; }
        .detail-row:last-child { border-bottom: none; }
        .detail-key { width: 130px; min-width: 130px; padding: 10px 14px; font-size: 11px; font-weight: 700; color: #7d8590; text-transform: uppercase; letter-spacing: .06em; background: rgba(255,255,255,.02); }
        .detail-val { padding: 10px 14px; font-size: 13px; color: #e6edf3; word-break: break-all; flex: 1; }

        /* Type badge */
        .type-badge-red    { display: inline-block; background: rgba(248,113,113,.12); border: 1px solid rgba(248,113,113,.3); color: #f87171; font-size: 11px; font-weight: 800; padding: 2px 9px; border-radius: 20px; }
        .type-badge-orange { display: inline-block; background: rgba(251,146,60,.12); border: 1px solid rgba(251,146,60,.3); color: #fb923c; font-size: 11px; font-weight: 800; padding: 2px 9px; border-radius: 20px; }
        .type-badge-yellow { display: inline-block; background: rgba(250,204,21,.10); border: 1px solid rgba(250,204,21,.25); color: #facc15; font-size: 11px; font-weight: 800; padding: 2px 9px; border-radius: 20px; }
        .type-badge-blue   { display: inline-block; background: rgba(88,166,255,.10); border: 1px solid rgba(88,166,255,.25); color: #58a6ff; font-size: 11px; font-weight: 800; padding: 2px 9px; border-radius: 20px; }
        .type-badge-gray   { display: inline-block; background: rgba(125,133,144,.12); border: 1px solid rgba(125,133,144,.3); color: #7d8590; font-size: 11px; font-weight: 800; padding: 2px 9px; border-radius: 20px; }

        /* Complex alert */
        .complex-alert { background: rgba(248,113,113,.06); border: 1px solid rgba(248,113,113,.2); border-radius: 6px; padding: 12px 16px; margin-bottom: 20px; }
        .complex-alert-title { color: #f87171; font-weight: 800; font-size: 11px; text-transform: uppercase; letter-spacing: .06em; margin-bottom: 5px; }
        .complex-alert-body { font-size: 12px; color: #7d8590; line-height: 1.6; }

        /* Approved status box */
        .approved-box { background: rgba(74,222,128,.06); border: 1px solid rgba(74,222,128,.2); border-radius: 6px; padding: 14px 18px; margin-bottom: 20px; }
        .approved-title { font-size: 13px; font-weight: 800; color: #4ade80; margin: 0 0 5px; }
        .approved-body { font-size: 12px; color: #7d8590; line-height: 1.6; margin: 0; }

        /* Link redirect buttons (no icon) */
        .btn-group { display: table; width: 100%; border-collapse: separate; border-spacing: 8px; margin-bottom: 20px; }
        .btn-tor {
            display: block;
            background: #1c2128;
            border: 1px solid rgba(88,166,255,.35);
            color: #58a6ff;
            text-align: center;
            text-decoration: none;
            padding: 11px 20px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .04em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .btn-clearnet {
            display: block;
            background: #1c2128;
            border: 1px solid rgba(74,222,128,.3);
            color: #4ade80;
            text-align: center;
            text-decoration: none;
            padding: 11px 20px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .04em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .btn-label { font-size: 10px; font-weight: 700; color: #7d8590; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 5px; }

        .mono { font-family: 'Courier New', monospace; }
        .info-box { background: rgba(88,166,255,.06); border: 1px solid rgba(88,166,255,.2); border-radius: 6px; padding: 14px 18px; margin-bottom: 20px; font-size: 13px; color: #e6edf3; line-height: 1.6; }
        .contact-link { color: #58a6ff; text-decoration: none; }
        .footer { padding: 16px 24px; border-top: 1px solid #30363d; font-size: 11px; color: #7d8590; line-height: 1.5; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <div class="header">
                <div class="header-badge">&#10003; Report Approved</div>
                <p class="header-title">Your Report Has Been Reviewed</p>
                <p class="header-sub">{{ config('app.name') }} — Community Safety</p>
            </div>

            <div class="body">
                <p class="greeting">
                    Thank you for helping keep the directory safe. Your report has been
                    <strong style="color:#4ade80;">reviewed and approved</strong> by our moderation team.
                    We have taken action on the flagged listing.
                </p>

                {{-- Report summary --}}
                <p class="section-label">Report Details</p>
                <div class="detail-grid">
                    <div class="detail-row">
                        <div class="detail-key">Report ID</div>
                        <div class="detail-val mono">#{{ str_pad($report->id, 6, '0', STR_PAD_LEFT) }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-key">Issue Type</div>
                        <div class="detail-val">
                            @php $color = $report->type->badgeColor(); @endphp
                            <span class="type-badge-{{ $color }}">{{ $report->type->label() }}</span>
                            @if($report->type->isComplex())
                                &nbsp;<span style="font-size:10px;color:#f87171;font-weight:700;">&#9888; High-priority</span>
                            @endif
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-key">Type Info</div>
                        <div class="detail-val" style="font-size:12px;color:#7d8590;">{{ $report->type->description() }}</div>
                    </div>
                    @if($report->message)
                    <div class="detail-row">
                        <div class="detail-key">Your Note</div>
                        <div class="detail-val" style="font-size:12px;font-style:italic;color:#7d8590;">{{ $report->message }}</div>
                    </div>
                    @endif
                    <div class="detail-row">
                        <div class="detail-key">Submitted</div>
                        <div class="detail-val mono" style="font-size:12px;">{{ $report->created_at->format('d M Y, H:i') }} UTC</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-key">Status</div>
                        <div class="detail-val" style="color:#4ade80;font-weight:800;">&#9679; Approved</div>
                    </div>
                </div>

                {{-- Link summary --}}
                @if($report->link)
                <p class="section-label">Reported Listing</p>
                <div class="detail-grid" style="margin-bottom:20px;">
                    <div class="detail-row">
                        <div class="detail-key">Title</div>
                        <div class="detail-val"><strong>{{ $report->link->title }}</strong></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-key">Category</div>
                        <div class="detail-val">{{ $report->link->category->label() }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-key">Onion URL</div>
                        <div class="detail-val mono" style="font-size:12px;color:#7d8590;word-break:break-all;">{{ $report->link->url }}</div>
                    </div>
                </div>

                {{-- Complex type warning box --}}
                @if($report->type->isComplex())
                <div class="complex-alert">
                    <div class="complex-alert-title">&#9888; High-Priority Report — Action Taken</div>
                    <p class="complex-alert-body">
                        This report was classified as a <strong style="color:#f87171;">{{ $report->type->label() }}</strong> — a high-priority issue
                        that requires immediate attention. Our team has reviewed the listing and applied the appropriate moderation action.
                        If you believe this site continues to operate elsewhere, please submit a new report.
                    </p>
                </div>
                @else
                <div class="approved-box">
                    <p class="approved-title">&#10003; Moderation Complete</p>
                    <p class="approved-body">
                        The listing has been updated or removed based on your report.
                        Thank you for contributing to a safer hidden service directory.
                    </p>
                </div>
                @endif

                {{-- View listing buttons — no icons, direct redirect --}}
                @php
                    $torUrl       = url(route('link.show', $report->link->slug, false));
                    $clearnetUrl  = rtrim(config('app.clearnet_url', env('CLEARNET_URL', '')), '/')
                                    . '/' . ltrim(route('link.show', $report->link->slug, false), '/');
                @endphp

                <p class="section-label">Visit the Listing</p>
                <div>
                    @if($torUrl)
                    <p class="btn-label">Tor (.onion) Network</p>
                    <a href="{{ $torUrl }}" class="btn-tor">
                        Open via Tor Browser
                    </a>
                    @endif

                    @if(config('app.clearnet_url') || env('CLEARNET_URL'))
                    <p class="btn-label">Clearnet (Surface Web)</p>
                    <a href="{{ $clearnetUrl }}" class="btn-clearnet">
                        Open on Clearnet
                    </a>
                    @endif
                </div>
                @endif

                <div class="info-box">
                    &#10139; Questions? Contact us at
                    <a href="mailto:{{ config('site.contact_email', config('mail.from.address')) }}" class="contact-link">{{ config('site.contact_email', config('mail.from.address')) }}</a>
                    and reference report <strong>#{{ str_pad($report->id, 6, '0', STR_PAD_LEFT) }}</strong>.
                </div>
            </div>

            <div class="footer">
                This is an automated notification from <strong>{{ config('app.name') }}</strong>.<br>
                Report Reference: <span class="mono">#{{ str_pad($report->id, 6, '0', STR_PAD_LEFT) }}</span> &middot;
                Reviewed: {{ now()->format('d M Y, H:i') }} UTC
            </div>
        </div>
    </div>
</body>
</html>
