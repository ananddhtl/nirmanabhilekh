<?php

namespace App\Exports;


use App\Models\ServiceBillingAmount;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiceBillAmountExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
  
    
        public function collection()
        {
            return ServiceBillingAmount::select('id' , 'billDate', 'customer_id','totalamount','discount','alltotalamount')->get();
        }
        public function headings(): array{
            return ["ID","Date","Customer Name"," Total Amount","Discount","ll Total Amount",];
        }
    }

