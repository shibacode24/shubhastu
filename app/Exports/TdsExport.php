<?php

namespace App\Exports;

use App\Models\Promotor_Sale;
use App\Models\Addcompany;
use App\Models\Marketing;
use App\Models\Doctor;
use App\Models\Year;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;


class TdsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $month;
    protected $stocmed;

    public function __construct($month, $stocmed)
    {
        $this->month = $month;
        $this->stocmed = $stocmed;
    }
    
        // Rest of the class...
    
    

    public function headings():array{
        return[
            'Id',
          
            'Month',
            'Doctor Name',
            'Promoter Name',
            'Company',
            'Ptr Total 1',
            'Mps Total 2',
             'Tds(mps)',
            'Payable Amount',
            'Created_at',
        ];
    } 
    public function collection()
    {
    //     $data=Promotor_Sale::query()
    //     // ->where(('promotor__sales.tds')/100*('promotor__sales.grand_total1'))
    //     ->select(
    //         'promotor__sales.id',
    //              'promotor__sales.sale_of_month',
    //            'promotor__sales.tds',
    //              'doctors.allotted_dr_name',
    //              'doctors.promoter_name',
    //              'addcompanies.Name',
    //              'promotor__sales.grand_total2',
    //              'promotor__sales.grand_total1',
    //              'promotor__sales.Created_at',
    //              'promotor__sales.Updated_at'
    //             )
                
    //     ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
       
    //     ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')
    // //   ->groupby('promotor__sales.sale_of_month')
    //     ->get();

    $months= ['January', 'February', 'March'];
    $select_company_id = 3;

        $data = Promotor_Sale::
        select('promotor__sales.id',
                     'promotor__sales.sale_of_month',
                   'promotor__sales.tds',
                     'doctors.allotted_dr_name',
                     'doctors.promoter_name',
                     'addcompanies.Name',
                     'promotor__sales.grand_total2',
                     'promotor__sales.grand_total1',
                     'promotor__sales.Created_at',
                     'promotor__sales.Updated_at')
       
        ->selectRaw('SUM(CASE WHEN select_company_id = ? AND sale_of_month = ? THEN tds ELSE 0 END) as quarter_total', [$select_company_id, $months[0]])
        ->selectRaw('SUM(CASE WHEN select_company_id = ? AND sale_of_month = ? THEN tds ELSE 0 END) as quarter_total', [$select_company_id, $months[1]])
        ->selectRaw('SUM(CASE WHEN select_company_id = ? AND sale_of_month = ? THEN tds ELSE 0 END) as quarter_total', [$select_company_id, $months[2]])
        ->selectRaw('SUM(CASE WHEN select_company_id = ? AND sale_of_month IN (?, ?, ?) THEN tds ELSE 0 END) as total', [$select_company_id, $months])
        ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
       
            ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')
        // ->groupBy('select_doctor_id')
        ->get();

        // public function collection()
        // {
            // $data = Promotor_Sale::query()
            //     ->select('promotor__sales.id', 'promotor__sales.sale_of_month', 'promotor__sales.tds',
            //         'doctors.allotted_dr_name', 'doctors.promoter_name', 'addcompanies.Name',
            //         'promotor__sales.grand_total2', 'promotor__sales.grand_total1', 'promotor__sales.Created_at')
            //     ->leftjoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
            //     ->leftjoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
            //     ->when($this->month, function ($query, $month) {
            //         return $query->whereIn('promotor__sales.sale_of_month', $month);
            //     })
            //     ->get();
    
// dd($this->month);
            // $filteredData = Promotor_Sale::query()
            // ->select('promotor__sales.id', 'promotor__sales.sale_of_month', 'promotor__sales.tds',
            //     'doctors.allotted_dr_name', 'doctors.promoter_name', 'addcompanies.Name',
            //     'promotor__sales.grand_total2', 'promotor__sales.grand_total1', 'promotor__sales.Created_at')
            // ->leftjoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
            // ->leftjoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
            // ->when(!empty($this->month), function ($query) {
            //     return $query->whereIn('promotor__sales.sale_of_month', $this->month);
            // })
            // ->get();

            // dd($filteredData->toSql());
            // $filteredData1 = $filteredData->get();
        
        // ... (rest of the code)
        
                    //  $this->data->whereIn('sale_of_month', $this->month);
                    // $filteredData = $this->stocmed;
                
                    $records = new Collection();
                
                    foreach ($data as $d) {
                        // Your existing logic to prepare the data...
                        // $record = [...];
                        // $records->push($record);
                
                



            // $records = new Collection();
    
            // foreach ($data as $d) {
                $record = [
                    'Id' => $d->id,
                    'Month' => $d->sale_of_month,
                    'Doctor Name' => $d->allotted_dr_name,
                    'Promoter Name' => $d->promoter_name,
                    'Company' => $d->Name,
                    'Ptr Total 1' => $d->grand_total1,
                    'Mps Total 2' => $d->grand_total2,
                    'Tds(mps)' => ((float) $d->tds / 100) * (float) $d->grand_total1,
                    'Payable Amount' => ((float) $d->grand_total1) - ((float) $d->tds / 100) * (float) $d->grand_total1,
                    'Created_at' => date('d-m-Y', strtotime($d->Created_at)),
                ];
                $records->push($record);
            }
    
            return $records;
        }
}
