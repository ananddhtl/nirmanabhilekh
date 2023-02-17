<?php

namespace App\Exports;

use App\Models\EquipmentCatagory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EquipmentCatagoryExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EquipmentCatagory::select('id', 'equipment_catagories_name')->get();
    }
    public function headings(): array{
        return ["ID","Equipment Catagories Name"];
    }
}
