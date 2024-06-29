<?php

namespace Raakkan\Yali\Core\FileManager\Controllers;

use Illuminate\Routing\Controller;
use Raakkan\Yali\Core\FileManager\FileManager;

class FileManagerController extends Controller
{
    protected FileManager $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function index()
    {
        $contents = $this->fileManager->getFolderContents();

        return response()->json($contents);
    }
}