<?php

namespace App\Exports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiceExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
        public function collection()
    {
        return Service::select('id', 'service_name', 'service_rate', 'service_customer_id', 'status')->get();
    }
    public function headings(): array{
        return ["ID","Service Name","Service Rate","Service Customer ID","Status"];
    }
    }

