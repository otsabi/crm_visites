<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class VisitesPhImport implements ToCollection,WithMultipleSheets 
{

    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            'Liste Ph' => new FirstSheetImport(),
            'Rapport Ph' => new SecondSheetImport(),
            
        ];
    }

    public function collection(Collection $rows)
    {
      //dd(worksheet1);
      //dd($rows);
      
        //   foreach ($rows as $row) 

        //   print($row)."<br>";
        
    }

    
}