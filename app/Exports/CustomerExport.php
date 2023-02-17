<?php

namespace App\Exports;

use App\Models\Customer;
use App\Controllers\CustomerController;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::select('id', 'customer_name', 'customer_email', 'customer_address', 'customer_phonenumber','dob','customer_profession')->get();
    }
    public function headings(): array{
        return ["ID","Customer Name","Customer Email","Customer Phone Number","Customer Address","Date of Birth","Customer Profession"];
    }
}
