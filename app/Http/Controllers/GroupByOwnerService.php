<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupByOwnerService extends Controller
{
    public function processArray(array $files): array
    {
        $result = [];

        foreach ($files as $file => $owner) {
            if (!isset($result[$owner])) {
                $result[$owner] = [];
            }
            $result[$owner][] = $file;
        }

        return $result;
    }
}
