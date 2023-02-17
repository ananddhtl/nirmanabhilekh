<?php

namespace App\Exports;

use App\Models\Activity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivtiesExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        return Activity::select('id', 'activities_title', 'activities_subtitle', 'activities_cat_ID', )->get();
    }
    public function headings(): array{
        return ["ID","Activites Title ", "Activites Subtitle","Activites Catagory ID"];
    }
}
