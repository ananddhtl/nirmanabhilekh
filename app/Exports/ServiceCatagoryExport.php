<?php

namespace App\Exports;

use App\Models\ServiceCatagory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiceCatagoryExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ServiceCatagory::select('id', 'service_catagory_name', 'status',)->get();
    }
    public function headings(): array{
        return ["ID","Service Catagory Name","Status",];
    }   
    }

