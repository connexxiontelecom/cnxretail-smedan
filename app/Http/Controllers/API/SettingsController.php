<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\MailchimpSettings;
use App\Models\Tenant;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->tenant = new Tenant();
        $this->mailchimpsettings = new MailchimpSettings();
        $this->bank = new Bank();
    }
}
