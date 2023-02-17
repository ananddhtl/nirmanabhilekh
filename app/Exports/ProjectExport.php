<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
   
        public function collection()
    {
        return Project::select('id', 'customer_id', 'project_name', 'project_address', 'project_city','project_fiscal_year','project_duration', 'project_costestimation','project_leader_id')->get();
    }
    public function headings(): array{
        return ["ID","Customer ID","Project Name","Project Address","Project City","Project Fiscal Year", "Project Duration", "Project Cost Estimation","Project Leader ID" ];
    }
    }

