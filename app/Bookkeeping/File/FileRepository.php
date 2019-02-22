<?php

namespace App\Bookkeeping\File;

use App\File;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class FileRepository implements FileInterface
{
    public function uploadFile($request)
    {
        $file = $request->file("invoice");

        $transactionID = $request->input('transactionID');

        $fileName = Carbon::now()->format('my').$transactionID.'_invoice.pdf';

        $path = Storage::disk('public')->putFileAs('/invoices', $file, $fileName);

        $transaction = Transaction::find($transactionID);

        $result = $transaction->file()->create(['file_path' => $path]);

        return $result->id;
    }

    public function downloadFile($transactionID)
    {
        $transaction = Transaction::find($transactionID);

        $file = $transaction->file;

        return $file->file_path;
    }

    public function deleteFile($transactionID)
    {
        $transaction = Transaction::find($transactionID);

        $file = $transaction->file->fila_path;

        Storage::disk('public')->delete($file);
    }
}
