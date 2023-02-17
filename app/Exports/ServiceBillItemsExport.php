<?php

namespace App\Exports;

use App\Models\ServiceBillItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiceBillItemsExport implements FromCollection  , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
        public function collection()
        {
            return ServiceBillItem::select('id', 'service_id', 'quantity', 'service_rate','tCode')->get();
        }
        public function headings(): array{
            return ['Id', 'ServiceId',  'Quantity', 'ServiceRate','TicketCode'];
        }
    }

