<?php

namespace App\Bookkeeping\File;

interface FileInterface
{
    public function uploadFile($invoice);

    public function downloadFile($fileID);

    public function deleteFile($transactionID);
}
