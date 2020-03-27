<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SecondSheetImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        //
        foreach ($rows as $row) 

        print($row[3])."<br>";
    }
}