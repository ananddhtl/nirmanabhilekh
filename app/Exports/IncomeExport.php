<?php

namespace App\Exports;

use App\Models\IncomeFromEquipment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IncomeExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return IncomeFromEquipment::select('id', 'equipment_id', 'amount', 'customer_id')->get();
    }
    public function headings(): array{
        return ["ID","Equipment Name","Amount","Customer ID"];
    }
}
