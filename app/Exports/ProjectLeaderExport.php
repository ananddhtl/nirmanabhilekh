<?php

namespace App\Exports;

use App\Models\ProjectLeader;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectLeaderExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProjectLeader::select('id','project_leader_name',  'project_leader_mobilenumber','project_leader_address','project_leader_profession')->get();
    }
    public function headings(): array{
        return ["ID","Project Leader Name","Project Leader Mobile Number","Project Leader Address","Project Leader Profession", ];
    }
}
