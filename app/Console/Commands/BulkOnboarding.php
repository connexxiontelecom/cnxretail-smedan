<?php

namespace App\Console\Commands;

use App\Http\Traits\SeedManager;
use App\Models\AdminNotification;
use App\Models\Item;
use App\Models\Location;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class BulkOnboarding extends Command
{
    use SeedManager;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:bulkOnBoarding';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->tenant = new Tenant();
        $this->user = new User();
        $this->adminnotification = new AdminNotification();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $headerColumns = [
            "",
            "NAME",
            "PHONE NO",
            "COMPANY ORG",
            "LOCATION",
            "BIZ ADDRESS",
            "SHARE CAPITAL",
            "EMAIL",
            "SECTOR",
            "PRODUCT/SERVICES",
            "NO OF EMPLOYEES",
            "TURNOVER"
        ];

        $streamlineFile = public_path('/retail2.csv');// Storage::disk('local')->get('smedan2.csv');

        // Loop through all CSV records
        try {
            $duplicates = [];
            $records = $this->seedDatabaseFromCSV($streamlineFile, $headerColumns);
            $counter = 0;
            foreach ($records as $row) { //696
                //return dd($row);
                //$location = !empty($row['LOCATION']) ? Location::createLocation($row['LOCATION']) : null;
                $loc = !empty($row['LOCATION']) ? Location::getLocationByName($row['LOCATION']) : null;
                $locationId = $loc->id ?? 0;
                $companyName = $row['NAME'] ?? null;
                $email = $row['EMAIL'] ?? null;
                $cat = 1;
                $nin = 101;
                $rcNo = '719273';
                $phone = $row['PHONE NO'];
                $website = substr(strtolower(str_replace(" ","",$row['NAME'])),0,15); //$row['Website'];
                $address = $row['BIZ ADDRESS'] ?? null;
                $startDate = '2022-10-3';
                $endDate = '2023-10-2';

                $record = $this->tenant->getTenantByEmail($email);
                if(empty($record) /*&& ($counter < 696 ) */){
                    $tenant = $this->tenant->commandInitiatedNewTenantOnboarding($companyName, $email, $cat, $rcNo, $phone, $address, $website, $locationId);
                    $user = $this->user->commandInitiatedNewUserOnboarding($companyName, $email, $startDate, $endDate, $nin, $address, $tenant);
                    #Notification
                    $subject = "New registration";
                    $body = "There's a new registration to CNX Retail. Kindly check it out.";
                    $this->adminnotification->setNewAdminNotification($subject, $body, 'view-tenant', $tenant->slug, 1, 0);
                    $counter++;
                    //return dd($row);
                }else{
                    array_push($duplicates, $email);
                }

            }
            return dd($duplicates);
        }catch (\Exception $exception){

        }


        return 0;
    }
}
