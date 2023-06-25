<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ImageTrait
{
    public function uploadImage($file, $path)
    {
        $file->store($path);
        return $file->hashName();
    }
}
