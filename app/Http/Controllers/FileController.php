<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookkeeping\File\FileInterface as FileInterface;

class FileController extends Controller
{
    protected $file;

    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }
    
    public function uploadFile(Request $request)
    {
        $result = $this->file->uploadFile($request);
        
        return response()->json($result);
    }

    public function downloadFile($transactionID)
    {
        $filePath = $this->file->downloadFile($transactionID);

        return response()->download(storage_path('app/public/'.$filePath), 'invoice.pdf');
    }
}
