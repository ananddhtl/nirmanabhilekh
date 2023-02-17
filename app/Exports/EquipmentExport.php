<?php

namespace App\Exports;

use App\Models\Equipment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EquipmentExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Equipment::select('id', 'equipment_name', 'equipment_cat_id', 'purchase_rate')->get();
    }
    public function headings(): array{
        return ["ID","Equipment Name","Equipment Catagory ID","Purchase Rate"];
    }
}
