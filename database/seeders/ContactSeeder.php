<?php

namespace Database\Seeders;

use App\Http\Traits\SeedManager;
use App\Models\Contact;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    use SeedManager;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $headerColumns = [
            "id",
            "added_by",
            "tenant_id",
            "company_name",
            "company_address",
            "company_email",
            "company_phone",
            "company_website",
            "contact_first_name",
            "contact_last_name",
            "contact_position",
            "contact_email",
            "contact_mobile",
            "communication_channel",
            "whatsapp_contact",
            "hear_about_us",
            "preferred_time",
            "slug",
            "created_at",
            "updated_at",
            "contact_type",
            "description",
        ];

        $streamlineFile = public_path('/contactsmedan.csv');
        $records = $this->seedDatabaseFromCSV($streamlineFile, $headerColumns);
        try {
            // Set a range of possible dates (adjust as needed)
            $startTimestamp = strtotime('2022-11-01');
            $endTimestamp = strtotime('2023-06-29');

        // Generate a random timestamp within the range
            $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);

            // Format the random timestamp as a date (adjust the format as needed)
            $randomDate = date('Y-m-d', $randomTimestamp);

           // echo $randomDate;


            foreach($records as $row){
                $tenant = Tenant::inRandomOrder()->take(1)->first();
                $user = User::where('tenant_id', $tenant->id)->first();
                $data = [
                  "added_by" => $user->id,
                  "tenant_id" => $tenant->id,
                  "company_name" => $row['company_name'],
                  "company_address" => $row['company_address'],
                  "company_email" => $row['company_email'],
                  "company_phone" => $row['company_phone'],
                  "company_website" => $row['company_website'],
                  "contact_first_name" => $row['contact_first_name'],
                  "contact_last_name" => $row['contact_last_name'],
                  "contact_position" => $row['contact_position'],
                  "contact_email" => $row['contact_email'],
                  "contact_mobile" => $row['contact_mobile'],
                  "communication_channel" => $row['communication_channel'],
                  "whatsapp_contact" => $row['whatsapp_contact'],
                  "hear_about_us" => $row['hear_about_us'],
                  "preferred_time" => $row['preferred_time'],
                  "slug" => $row['company_name'].'-'.substr(sha1(time()),31,40),
                  "contact_type" => 0,
                  "created_at"=>$randomDate,
                  "updated_at"=>$randomDate,
                  "description" => "",

                ];
                Contact::create($data);
            }
        }catch (\Exception $exception){
            return dd($exception);
        }
    }
}
