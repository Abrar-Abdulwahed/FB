<?php
namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class AppSettingService
{
    private $settings;

    public function __construct()
    {
        $this->settings = Cache::rememberForever("settings", function () {
            return Setting::pluck('value', 'name')->toArray();
        });
    }

    public function get($key)
    {
        if (array_key_exists($key, $this->settings) === false) {
            return null;
        }
        return $this->settings[$key];
    }

    public function set($key, $value)
    {
        $this->settings[$key] = $value;
        Setting::updateOrCreate(['name' => $key], ['value' => $value]);
        Cache::forever('settings', $this->settings);
    }

    public function getAll()
    {
        return $this->settings;
    }
}