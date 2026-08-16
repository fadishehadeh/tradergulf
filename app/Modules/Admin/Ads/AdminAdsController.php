<?php
declare(strict_types=1);

namespace App\Modules\Admin\Ads;

use App\Core\Request;
use App\Core\Response;
use App\Modules\Admin\AdminBaseController;

class AdminAdsController extends AdminBaseController
{
    public function index(Request $request): void
    {
        $this->requireAuth();
        $zones = $this->db()->fetchAll(
            'SELECT z.*,
                    COUNT(a.id)            AS total_ads,
                    SUM(a.impressions)     AS total_impressions,
                    SUM(a.clicks)          AS total_clicks
             FROM ad_zones z
             LEFT JOIN ads a ON a.zone_id = z.id
             GROUP BY z.id
             ORDER BY z.sort_order'
        );

        foreach ($zones as &$z) {
            $z['ads'] = $this->db()->fetchAll(
                'SELECT * FROM ads WHERE zone_id = ? ORDER BY is_active DESC, id DESC',
                [$z['id']]
            );
        }
        unset($z);

        $this->render('admin/ads/index', [
            'pageTitle' => 'Ad Spaces',
            'zones'     => $zones,
        ]);
    }

    public function create(Request $request): void
    {
        $this->requireAuth();
        $zoneId = (int) ($request->input('zone_id') ?? 0);
        $zone   = $this->db()->fetch('SELECT * FROM ad_zones WHERE id = ?', [$zoneId]);
        if (!$zone) {
            session()->flash('error', 'Invalid ad zone.');
            Response::redirect('admin/ads');
        }

        $this->render('admin/ads/form', [
            'pageTitle' => 'New Ad — ' . $zone['name'],
            'zone'      => $zone,
            'ad'        => null,
        ]);
    }

    public function store(Request $request): void
    {
        $this->requireAuth();
        $this->verifyCsrf();
        $zoneId    = (int) $request->input('zone_id');
        $advertiser = trim($request->input('advertiser', ''));
        $imageUrl   = trim($request->input('image_url', ''));
        $clickUrl   = trim($request->input('click_url', ''));
        $altText    = trim($request->input('alt_text', ''));
        $startsAt   = $request->input('starts_at') ?: null;
        $endsAt     = $request->input('ends_at') ?: null;
        $isActive   = (int) (bool) $request->input('is_active');

        if (!$zoneId || !$imageUrl || !$clickUrl) {
            session()->flash('error', 'Image URL and Click URL are required.');
            Response::redirect('admin/ads/create?zone_id=' . $zoneId);
        }

        $this->db()->execute(
            'INSERT INTO ads (zone_id, advertiser, image_url, click_url, alt_text, starts_at, ends_at, is_active)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
            [$zoneId, $advertiser, $imageUrl, $clickUrl, $altText, $startsAt, $endsAt, $isActive]
        );

        session()->flash('success', 'Ad created successfully.');
        Response::redirect('admin/ads');
    }

    public function edit(Request $request, string $id): void
    {
        $this->requireAuth();
        $ad   = $this->db()->fetch('SELECT * FROM ads WHERE id = ?', [(int) $id]);
        $zone = $ad ? $this->db()->fetch('SELECT * FROM ad_zones WHERE id = ?', [$ad['zone_id']]) : null;

        if (!$ad || !$zone) {
            session()->flash('error', 'Ad not found.');
            Response::redirect('admin/ads');
        }

        $this->render('admin/ads/form', [
            'pageTitle' => 'Edit Ad — ' . $zone['name'],
            'zone'      => $zone,
            'ad'        => $ad,
        ]);
    }

    public function update(Request $request, string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();
        $advertiser = trim($request->input('advertiser', ''));
        $imageUrl   = trim($request->input('image_url', ''));
        $clickUrl   = trim($request->input('click_url', ''));
        $altText    = trim($request->input('alt_text', ''));
        $startsAt   = $request->input('starts_at') ?: null;
        $endsAt     = $request->input('ends_at') ?: null;
        $isActive   = (int) (bool) $request->input('is_active');

        if (!$imageUrl || !$clickUrl) {
            session()->flash('error', 'Image URL and Click URL are required.');
            Response::redirect('admin/ads/' . $id . '/edit');
        }

        $this->db()->execute(
            'UPDATE ads SET advertiser=?, image_url=?, click_url=?, alt_text=?, starts_at=?, ends_at=?, is_active=?
             WHERE id = ?',
            [$advertiser, $imageUrl, $clickUrl, $altText, $startsAt, $endsAt, $isActive, (int) $id]
        );

        session()->flash('success', 'Ad updated.');
        Response::redirect('admin/ads');
    }

    public function toggle(Request $request, string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();
        $this->db()->execute(
            'UPDATE ads SET is_active = 1 - is_active WHERE id = ?',
            [(int) $id]
        );
        Response::redirect('admin/ads');
    }

    public function delete(Request $request, string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();
        $this->db()->execute('DELETE FROM ads WHERE id = ?', [(int) $id]);
        session()->flash('success', 'Ad deleted.');
        Response::redirect('admin/ads');
    }
}
