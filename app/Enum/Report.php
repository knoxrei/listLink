<?php

namespace App\Enum;

enum Report: string
{
    // ── Simple types (low-risk, factual corrections) ──────────────────────
    case MISSING_INFORMATION = 'missing_information';
    case WRONG_CATEGORY      = 'wrong_category';
    case LINK_BROKEN         = 'link_broken';
    case DUPLICATE           = 'duplicate';
    case SPAM                = 'spam';

    // ── Complex types (require admin investigation / takedown) ────────────
    case PHISHING            = 'phishing';
    case SCAM                = 'scam';
    case ILLEGAL_CONTENT     = 'illegal_content';
    case MALWARE             = 'malware';
    case COPYRIGHT           = 'copyright';

    // ── Catch-all ─────────────────────────────────────────────────────────
    case OTHER               = 'other';

    public function label(): string
    {
        return match ($this) {
            self::MISSING_INFORMATION => 'Missing Information',
            self::WRONG_CATEGORY      => 'Wrong Category',
            self::LINK_BROKEN         => 'Link Broken / Offline',
            self::DUPLICATE           => 'Duplicate Entry',
            self::SPAM                => 'Spam',
            self::PHISHING            => 'Phishing / Identity Theft',
            self::SCAM                => 'Scam / Fraud',
            self::ILLEGAL_CONTENT     => 'Illegal Content',
            self::MALWARE             => 'Malware / Exploit',
            self::COPYRIGHT           => 'Copyright Infringement',
            self::OTHER               => 'Other',
        };
    }

    /**
     * Short description shown in the report form to guide the reporter.
     */
    public function description(): string
    {
        return match ($this) {
            self::MISSING_INFORMATION => 'The listing is missing key details such as description or category.',
            self::WRONG_CATEGORY      => 'This link is listed under an incorrect category.',
            self::LINK_BROKEN         => 'The .onion address is unreachable or permanently offline.',
            self::DUPLICATE           => 'This URL already exists under a different listing.',
            self::SPAM                => 'This link is spam, fake, or low-quality content.',
            self::PHISHING            => 'This site is impersonating a legitimate service to steal credentials.',
            self::SCAM                => 'This site is involved in fraud, exit-scam, or financial deception.',
            self::ILLEGAL_CONTENT     => 'This site hosts content that violates applicable laws.',
            self::MALWARE             => 'This site distributes malware, ransomware, or exploits.',
            self::COPYRIGHT           => 'This site infringes on copyrights or intellectual property.',
            self::OTHER               => 'None of the above — please describe in the details field.',
        };
    }

    /**
     * Whether this type requires deeper admin investigation (true = complex).
     */
    public function isComplex(): bool
    {
        return match ($this) {
            self::PHISHING,
            self::SCAM,
            self::ILLEGAL_CONTENT,
            self::MALWARE,
            self::COPYRIGHT => true,
            default         => false,
        };
    }

    /**
     * Badge color hint for UI rendering.
     */
    public function badgeColor(): string
    {
        return match ($this) {
            self::PHISHING,
            self::SCAM,
            self::ILLEGAL_CONTENT,
            self::MALWARE         => 'red',
            self::COPYRIGHT       => 'orange',
            self::SPAM,
            self::DUPLICATE       => 'yellow',
            self::LINK_BROKEN,
            self::MISSING_INFORMATION,
            self::WRONG_CATEGORY  => 'blue',
            self::OTHER           => 'gray',
        };
    }
}
