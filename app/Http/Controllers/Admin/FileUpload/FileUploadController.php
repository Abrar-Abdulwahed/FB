<?php

namespace App\Http\Controllers\Admin\FileUpload;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FileUploadRequest;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function index()
    {
        $files = FileUpload::all();

        return view('admin.files.index', compact('files'));
    }

    public function create()
    {
        return view('admin.files.create');
    }

    public function store(FileUploadRequest $request)
    {
        $file = $request->file('file');
        if (!$file) {
            // return redirect()->back();
            return redirect()->route('admin.uploads.index');
        }

        $file->store('public/uploads');
        $file_name = $file->hashName();

        FileUpload::query()->create([
            'name' => $file_name,
        ]);
        session()->forget('error');
        // Return the file data
        return response()->json([
            'name' => $file->hashName(),
            'path' => Storage::url('public/uploads/' . $file_name),
            'size' => $file->getSize(),
        ]);
    }

    public function download($id)
    {
        $file = FileUpload::findOrFail($id);
        $filePath = storage_path('app/public/uploads/' . $file->name);

        return response()->download($filePath, $file->name);
    }

    public function destroy($id)
    {
        $file = FileUpload::findOrFail($id);

        $file->delete();

        Storage::disk('local')->delete('public/uploads/' . $file->name);

        return redirect()->route('admin.uploads.index');
    }
}
