<?php

namespace App\Exports;

use App\Models\ExpensesFromEquipment;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExpensesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ExpensesFromEquipment::select('id', 'equipment_id', 'amount', 'customer_id')->get();
    }
    public function headings(): array{
        return ["ID","Equipment Name","Amount","Customer ID"];
    }
}
