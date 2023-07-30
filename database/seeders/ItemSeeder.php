<?php

namespace Database\Seeders;

use App\Http\Traits\SeedManager;
use App\Models\Contact;
use App\Models\Item;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
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
            "sno",
            "name",
        ];

        $streamlineFile = public_path('/services.csv');
        $records = $this->seedDatabaseFromCSV($streamlineFile, $headerColumns);
        try {
            // Set a range of possible dates (adjust as needed)
            $startTimestamp = strtotime('2022-11-01');
            $endTimestamp = strtotime('2023-06-29');

            // Generate a random timestamp within the range
            $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);

            // Format the random timestamp as a date (adjust the format as needed)
            $randomDate = date('Y-m-d', $randomTimestamp);
            $items = [];
            foreach($records as $item){
                array_push($items, $item);
            }
            $contacts = Contact::all();
            foreach($contacts as $contact){
                $chosenItem = $items[array_rand($items)]['name'];
                $data = [
                    "added_by" => $contact->added_by,
                    "tenant_id" => $contact->tenant_id,
                    "item_name" => $chosenItem,
                    "item_type" => 2,
                    "selling_price" => rand(1000,100000),
                    "slug" => $chosenItem.'-'.substr(sha1(time()),31,40),
                    "created_at"=>$randomDate,
                    "updated_at"=>$randomDate,
                    "description" => "",

                ];
                Item::create($data);
                //Item::create($data2);
            }
        }catch (\Exception $exception){
            return dd($exception);
        }
    }
}
