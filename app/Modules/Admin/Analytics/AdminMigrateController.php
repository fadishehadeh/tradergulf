<?php
declare(strict_types=1);

namespace App\Modules\Admin\Analytics;

use App\Core\Request;
use App\Modules\Admin\AdminBaseController;

/**
 * One-time migration: update broker review metas and add fees sections.
 * DELETE this file after running /admin/migrate/broker-metas once on production.
 */
class AdminMigrateController extends AdminBaseController
{
    public function brokerMetas(Request $request): void
    {
        $this->requireAuth();
        $db  = $this->db();
        $log = [];

        // 1. Fix 2025 → 2026 in all meta titles
        $affected = $db->execute(
            "UPDATE broker_reviews SET meta_title = REPLACE(meta_title, '2025', '2026') WHERE meta_title LIKE '%2025%'"
        );
        $log[] = "Year fix: $affected rows";

        // 2. XM - add fees/inactivity section + update meta
        $xmBrokerId  = (int)$db->fetchValue("SELECT id FROM brokers WHERE slug='xm'");
        $xmReviewId  = (int)$db->fetchValue("SELECT id FROM broker_reviews WHERE broker_id=?", [$xmBrokerId]);
        if ($xmReviewId && !$this->alreadyMigrated($db, $xmReviewId)) {
            $existing = (string)$db->fetchValue("SELECT spreads_html FROM broker_reviews WHERE id=?", [$xmReviewId]);
            $db->execute(
                'UPDATE broker_reviews SET spreads_html=?, verdict_html=?, meta_title=?, meta_description=?, last_updated=NOW() WHERE id=?',
                [
                    $this->xmFeesPrefix() . "\n" . $existing,
                    $this->xmVerdict(),
                    'XM Review 2026 | Fees, Inactivity Charges & Regulation | Trader Gulf',
                    'XM review 2026: $5/month inactivity fee after 90 days, EUR/USD from 0.8 pips (Ultra Low), min deposit $5, leverage to 1:888. Regulated by ASIC, CySEC & IFSC. Independent review for UAE & Gulf traders.',
                    $xmReviewId,
                ]
            );
            $log[] = "XM review updated (id=$xmReviewId)";
        } else {
            $log[] = 'XM: already migrated or not found';
        }

        // 3. Exness - no inactivity fee (selling point) + update meta
        $exBrokerId  = (int)$db->fetchValue("SELECT id FROM brokers WHERE slug='exness'");
        $exReviewId  = (int)$db->fetchValue("SELECT id FROM broker_reviews WHERE broker_id=?", [$exBrokerId]);
        if ($exReviewId && !$this->alreadyMigrated($db, $exReviewId)) {
            $existing = (string)$db->fetchValue("SELECT spreads_html FROM broker_reviews WHERE id=?", [$exReviewId]);
            $db->execute(
                'UPDATE broker_reviews SET spreads_html=?, meta_title=?, meta_description=?, last_updated=NOW() WHERE id=?',
                [
                    $this->exnessFeesPrefix() . "\n" . $existing,
                    'Exness Review 2026 | No Inactivity Fee, Spreads & Regulation | Trader Gulf',
                    'Exness review 2026: no inactivity fee, instant withdrawals 24/7, EUR/USD from 0.3 pips (Standard), min deposit $10. Regulated by FCA, CySEC & FSCA. Independent review for UAE & Gulf traders.',
                    $exReviewId,
                ]
            );
            $log[] = "Exness review updated (id=$exReviewId)";
        } else {
            $log[] = 'Exness: already migrated or not found';
        }

        header('Content-Type: text/plain');
        echo implode("\n", $log) . "\nDone. Delete AdminMigrateController.php now.\n";
    }

    private function alreadyMigrated($db, int $reviewId): bool
    {
        $html = (string)$db->fetchValue("SELECT spreads_html FROM broker_reviews WHERE id=?", [$reviewId]);
        return str_contains($html, 'Inactivity Fee</h3>');
    }

    private function xmFeesPrefix(): string
    {
        return '<h2>XM Fees &amp; Charges</h2>
<p>XM\'s fee structure combines trading costs (spreads and commissions) with non-trading charges including an inactivity fee. Understanding all charges upfront helps avoid surprises.</p>
<h3>XM Inactivity Fee</h3>
<p>XM charges an <strong>inactivity fee of $5 per month</strong> (or currency equivalent) on accounts with no trading activity for <strong>90 consecutive days or more</strong>. The fee is deducted from the available account balance each month until the balance reaches zero or trading resumes. Accounts at zero balance incur no further charge. To avoid the fee, simply place one trade within any 90-day period.</p>
<h3>Deposit and Withdrawal Charges</h3>
<p>XM does not charge fees on deposits. Withdrawals via e-wallet and card are free; bank wire withdrawals may attract a small processing fee from the receiving bank, though XM reimburses wire fees once per month for accounts meeting minimum trading volume thresholds.</p>
<h3>Commission Charges by Account Type</h3>
<p>Standard, Micro, and Ultra Low accounts are commission-free - the spread is the only trading cost. The XM Zero account carries a commission of <strong>$3.50 per side per standard lot</strong> ($7.00 round turn) with raw spreads from 0.0 pips on EUR/USD.</p>';
    }

    private function exnessFeesPrefix(): string
    {
        return '<h2>Exness Fees &amp; Charges</h2>
<p>Exness has one of the more straightforward fee structures among major retail brokers. Unlike many competitors, Exness charges <strong>no inactivity fee</strong> - your account balance is never deducted for periods of no trading, regardless of how long the account remains dormant.</p>
<h3>Exness Inactivity Fee</h3>
<p><strong>Exness does not charge an inactivity fee.</strong> Your account can remain inactive indefinitely without any balance deductions. This is a meaningful advantage over brokers such as XM (which charges $5/month after 90 days) and eToro ($10/month after 12 months).</p>
<h3>Deposit and Withdrawal Fees</h3>
<p>Exness charges no deposit fees and no standard withdrawal fees. Withdrawals are processed instantly (24/7) on most payment methods including cards and e-wallets - a feature few major brokers match. Bank wire withdrawals are free but subject to standard banking processing times.</p>
<h3>Commission Charges by Account Type</h3>
<p>Standard and Standard Cent accounts are commission-free with spreads from approximately 0.3 pips on EUR/USD. Pro, Raw Spread, and Zero accounts offer tighter spreads with a commission of <strong>$3.50 per side per standard lot</strong> ($7.00 round turn).</p>';
    }
}
