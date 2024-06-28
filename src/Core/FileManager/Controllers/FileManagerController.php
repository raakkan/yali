<?php

namespace Raakkan\Yali\Core\FileManager\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    public function index()
    {
        $file = Storage::disk('local')->allFiles();
        $folders = Storage::disk('local')->directories();

        return response()->json([
            'files' => $file,
            'folders'=> $folders
        ]);
    }
}