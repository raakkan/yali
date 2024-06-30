<?php

namespace Raakkan\Yali\Core\FileManager\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Raakkan\Yali\Core\FileManager\FileManager;

class FileManagerController extends Controller
{
    protected $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function index(Request $request)
    {
        $folder = $request->query('folder', '');
        $contents = $this->fileManager->getFolderContents($folder);
        
        return response()->json($contents);
    }

    public function createFolder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent' => 'nullable|string',
        ]);

        try {
            $this->fileManager->createFolder($request->name, $request->parent);
            return response()->json(['message' => 'Folder created successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'folder' => 'nullable|string',
        ]);

        $path = $this->fileManager->uploadFile($request->file('file'), $request->folder);
        
        return response()->json(['message' => 'File uploaded successfully', 'path' => $path]);
    }

    public function delete(Request $request, $type, $path)
    {
        try {
            $this->fileManager->delete($type, $path);
            return response()->json(['message' => 'Item deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
