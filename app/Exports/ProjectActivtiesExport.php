<?php

namespace App\Exports;


use App\Models\ProjectActivity;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectActivtiesExport implements FromCollection , WithHeadings   
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProjectActivity::select('id', 'project_id', 'activities_id', 'debit', 'credit','cancel','fiscal_year')->get();
    }
    public function headings(): array{
        return ["ID","Project ID","Activties ID","Debit","Credit","Cancel", "Fiscal Year" ];
    }
}
