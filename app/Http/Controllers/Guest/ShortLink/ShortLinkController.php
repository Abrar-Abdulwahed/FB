<?php

namespace App\Http\Controllers\Guest\ShortLink;

use App\Http\Controllers\Controller;
use App\Models\ShortLink;
use Jenssegers\Agent\Facades\Agent;
use Stevebauman\Location\Facades\Location;

class ShortLinkController extends Controller
{
    public function show($param)
    {
        //
        $short_link = ShortLink::with('statistics')->where('slug', $param)->orWhere('id', $param)->firstOrFail();

        // check if user has cookie
        if (
            request()->hasCookie('link_statistics')
            && request()->cookie('link_statistics') == $short_link->id
        ) {
            return redirect()->to($short_link->url);
        }

        $ip = request()->ip();
        $country = Location::get($ip) ? Location::get($ip)->countryName : Location::get()->countryName;
        $browser = Agent::browser();
        $user_agent = request()->header('user-agent');

        $shortLinkStatistics = $short_link->statistics()
            ->where('ip', $ip)
            ->where('country', $country)
            ->where('browser', $browser)
            ->where('user_agent', $user_agent)
            ->first();

        if (!$shortLinkStatistics) {
            $short_link->statistics()->create([
                'ip' => $ip,
                'country' => $country,
                'browser' => $browser,
                'user_agent' => $user_agent,
                'visits' => 1,
            ]);
        } else {
            $shortLinkStatistics->update([
                'visits' => $shortLinkStatistics->visits + 1,
            ]);
        }

        return redirect()->to($short_link->url);
    }

}
