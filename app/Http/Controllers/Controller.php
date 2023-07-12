<?php

namespace App\Http\Controllers;

use App\Services\AppSettingService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $settingService;

    public function __construct(AppSettingService $settingService)
    {
        $this->settingService = $settingService;
    }
}
