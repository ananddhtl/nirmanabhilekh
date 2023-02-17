<?php

namespace App\Exports;

use App\Models\ActivityCatagory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivityCatagoryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ActivityCatagory::select('id', 'activity_catagories_name', 'status', )->get();
    }
    public function headings(): array{
        return ["ID","Activties Catagories Name","Status",];
    }
}
