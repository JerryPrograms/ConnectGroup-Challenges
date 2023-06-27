<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FindDuplocates extends Controller
{
    public function findDuplicates($arr) {
        $freq = [];  // Associative array to store element frequencies
        $result = [];  // Array to store duplicate elements

        foreach ($arr as $num) {
            if (isset($freq[$num])) {
                $freq[$num]++;
            } else {
                $freq[$num] = 1;
            }
        }

        foreach ($freq as $num => $count) {
            if ($count > 1) {
                $result[] = $num;
            }
        }

        return $result;
    }
}
