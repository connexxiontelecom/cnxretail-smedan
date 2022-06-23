<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarginReport extends Model
{
    use HasFactory;


    public function registerReport($type, $amount){
        $report = new MarginReport();
        $report->credit = $type == 1 ? $amount : 0;
        $report->debit = $type == 2 ? $amount : 0;
        $report->save();
        return $report;
    }
}
