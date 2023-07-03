<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShortLink\ShortLinkValidation;
use App\Models\ShortLink;
use Jenssegers\Agent\Facades\Agent;
use Stevebauman\Location\Facades\Location;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $short_links = ShortLink::paginate(5);
        return view('short_links.index', compact('short_links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('short_links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShortLinkValidation $request)
    {
        //
        /* $check = ShortLink::query()->where('id',$request->slug)->first();
        if($check){
            return redirect()->back()->with('error', 'يجب الا يكون ال slug  وال id متساويان');
        } */
        $short_link = ShortLink::create($request->validated());
        return redirect()->route('admin.short_links.index')->with('success', 'تم اضافة اللينك بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show($param)
    {
        //
        $short_link = ShortLink::with('statistics')->where('slug', $param)->orWhere('id', $param)->firstOrFail();

        $cookie = null;
        if (!request()->hasCookie('link_statistics')) {
            // Add the cookie if it doesn't exist
            $cookie = cookie('link_statistics', $short_link->id, 60 * 24 * 365);
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
                'visits' => 1
            ]);
        } else {
            $shortLinkStatistics->update([
                'visits' => $shortLinkStatistics->visits + 1,
            ]);
        }

        if ($cookie) {
            return redirect()->to($short_link->url)->withCookie($cookie);
        }

        return redirect()->to($short_link->url);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $short_link = ShortLink::find($id);
        return view('short_links.edit', compact('short_link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShortLinkValidation $request, $id)
    {
        //
        /*  $check = ShortLink::query()->where('id',$request->slug)->first();
        if($check){
            return redirect()->back()->with('error', 'يجب الا يكون ال slug  وال id متساويان');
        } */
        ShortLink::find($id)->update($request->validated());
        return redirect()->route('admin.short_links.index')->with('success', 'تم تعديل اللينك بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        ShortLink::where('id', $id)->delete();
        return redirect()->back()->with(['success' => 'تم حذف اللينك بنجاح']);
    }

    public function statistics($short_link_id)
    {
        $short_link = ShortLink::with('statistics')->findOrFail($short_link_id);

        $browsers = $short_link->statistics()
            ->select('browser')
            ->get()
            ->unique('browser')
            ->toArray();

        $countries = $short_link->statistics()
            ->select('country')
            ->get()
            ->unique('country')
            ->toArray();

        $browsers = array_column($browsers, 'browser');
        $countries = array_column($countries, 'country');

        foreach ($browsers as $browser) {
            $browserVisits[] = $short_link->statistics()
                ->where('browser', '=', $browser)
                ->sum('visits');
        }

        foreach ($countries as $country) {
            $countryVisits[] = $short_link->statistics()
                ->where('country', '=', $country)
                ->sum('visits');
        }

        $pieData = json_encode([
            'labels' => $countries,
            'datasets' => [[
                'data' => $countryVisits,
                'backgroundColor' => ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            ]]
        ]);

        $donutData = json_encode([
            'labels' => $browsers,
            'datasets' => [[
                'data' => $browserVisits,
                'backgroundColor' => ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            ]]
        ]);


        return view('short_links.statistics', compact('donutData', 'pieData'));
    }
}
