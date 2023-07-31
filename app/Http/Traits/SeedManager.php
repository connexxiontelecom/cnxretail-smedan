<?php
namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Model;use League\Csv\Reader;

trait SeedManager{

    public function seedDatabaseFromCSV($filepath, $headerColumns){

        $streamlineFile = $filepath; //public_path('/retail.csv');
        $csv = Reader::createFromPath($streamlineFile);
        $csv->setDelimiter(',');
        $csv->setHeaderOffset(0);

        // Get import file header columns
        $csvHeader = $csv->getHeader();

        // Throw an exception if header columns count is not the same
        if (count($headerColumns) !== count($csvHeader)) {
            throw new \Exception("Header columns count does not match");
        }

        // Check if all columns are in place and in the same order, if yes unset each value from headerColumns array
        foreach ($csvHeader as $index => $column) {
            if (array_key_exists($index, $headerColumns) && ($column == $headerColumns[$index])) {
                unset($headerColumns[$index]);
            }
        }

        // Throw an exception if header columns check is not passed. Array is not empty.
        if (!empty($headerColumns)) {
            throw new \Exception("Header columns do not match defined column names and their order");
        }
        return $csv->getRecords();
        // Loop through all CSV records
        /*foreach ($csv->getRecords() as $row) {

        }*/
    }
}

?>
