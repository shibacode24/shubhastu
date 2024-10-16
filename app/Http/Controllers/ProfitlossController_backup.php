<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\ExpenseEntry;
use App\Models\Promotor_Sale;
use App\Models\Year;

use App\Models\Addcompany;


class ProfitlossController extends Controller
{
    // public function index()
    // {
    //     $dataFromTable1 = DB::table('secondary__sales')->get();
    //     $dataFromTable2 = DB::table('promotor__sales')
    //     ->leftjoin('years','years.id','=','promotor__sales.year_id')
    //     ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')->select('promotor__sales.*','years.year','addcompanies.Name','promotor__sales.grand_total1 as grandtotal333')->get();
    //     $dataFromTable3 = DB::table('expense_entry1s')->get();
    //     // $dataFromTable4 = DB::table('expense_entries')->get();
    //     $combinedData = $dataFromTable1->concat($dataFromTable2)->concat($dataFromTable3);

    //     return view('profitloss', compact('combinedData'));
    // }

    public function index(Request $request){
        // // $dataFromTable1 = DB::table('secondary__sales')->get();
        //   $exp_entry = DB::table('expense_entries')
        // //   ->where('expense_entries.id','>=',240)->take(5)
        // //   ->where('secondary__sales.select_company_id','=','select_company_id')
        //   ->leftJoin('years','years.id','=','expense_entries.select_year')
        //   ->leftJoin('expense_entry1s','expense_entry1s.expense_entry_id','=','expense_entries.id')
        //   ->leftJoin('promotor__sales','promotor__sales.id','=','expense_entries.select_month')
        //   ->crossJoin('secondary__sales')
        //   ->leftJoin('addcompanies','addcompanies.id','=','expense_entries.select_company')
        //   ->select('expense_entries.*','years.year','promotor__sales.sale_of_month','addcompanies.Name','expense_entry1s.*','promotor__sales.grand_total1 as total','promotor__sales.grand_total2','secondary__sales.sale_value_total1','secondary__sales.grand_total1')
        //   ->whereColumn('secondary__sales.select_company_id', '=', 'expense_entries.select_company')
        //   ->whereColumn('secondary__sales.year_id', '=', 'expense_entries.select_year')
        // //   ->whereColumn('secondary__sales.sale_of_month', '=', 'expense_entries.select_month')
        //   ->whereColumn('secondary__sales.select_company_id', '=', 'promotor__sales.select_company_id')
        //   ->whereColumn('secondary__sales.year_id', '=', 'promotor__sales.year_id')
        //   ->whereColumn('secondary__sales.sale_of_month', '=', 'promotor__sales.sale_of_month');
        // //   ->whereRaw('MONTH(STR_TO_DATE(secondary__sales.sale_of_month, "%M")) = expense_entries.select_month')
        // // ->groupby('sale_value_total1');
        // if(isset($request->year) && $request->year!=null){
        //     $exp_entry=$exp_entry->where('expense_entries.select_year',$request->year);
        // }
        // if(isset($request->month) && $request->month!=null){
        //     $exp_entry=$exp_entry->where('expense_entries.select_month',$request->month);
        // }
        // if(isset($request->company) && $request->company!=null){
        //     $exp_entry=$exp_entry->where('expense_entries.select_company',$request->company);
        // }
        // $exp_entry=$exp_entry->get();

   
        // $exp_entry = ExpenseEntry::
        //     leftJoin('years','years.id','=','expense_entries.select_year')
        //     ->leftJoin('expense_entry1s','expense_entry1s.expense_entry_id','=','expense_entries.id')
        //     ->leftJoin('promotor__sales','promotor__sales.id','=','expense_entries.select_month')
        //     ->leftJoin('secondary__sales','secondary__sales.id','=','expense_entries.select_company')
        //     ->leftJoin('addcompanies','addcompanies.id','=','expense_entries.select_company')
        //     ->select('expense_entries.*','years.year','promotor__sales.sale_of_month','addcompanies.Name','expense_entry1s.*','promotor__sales.grand_total1','promotor__sales.grand_total2','secondary__sales.sale_value_total1','secondary__sales.grand_total1')
        //     ->get();
    
        $year = Year::all();
        $company = Addcompany::all();
    
        return view('profitloss', [
            'year' => $year,
            'company' => $company
        ]);
    }

    public function profit(Request $request)
    {

      $selected_month = \Carbon\Carbon::now()->format('F');


      if(isset($request->month))
      {
          $selected_month = $request->month;
      }
//dump($selected_month);
//exit();
      $profit = DB::table('secondary__sales')
      ->leftjoin('secondary_medicines', 'secondary_medicines.secondary__sales_id', '=', 'secondary__sales.id')
      ->leftjoin('years', 'years.id', '=', 'secondary__sales.year_id')
      ->leftjoin('addcompanies', 'addcompanies.id', '=', 'secondary__sales.select_company_id')
      ->select(
        'years.year',
        'addcompanies.Name',
        // 'secondary__sales.id',
        'secondary__sales.id as secondary__sales',
        'secondary__sales.year_id',
        'secondary__sales.sale_of_month',
        'secondary__sales.select_company_id',
        // 'secondary__sales.select_stokist_id',
        'secondary__sales.grand_total1',
        'secondary__sales.sale_value_total1',
        // 'secondary__sales.pdf',
        // 'secondary_medicines.*',
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.sale_value_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
        
      );
//   echo json_encode($selected_month);
    if(isset($request->year) && $request->year!=null){
      $profit=$profit->where('year_id',$request->year);
  }
 
 if(isset($request->month) && $request->month!=null){
     $profit=$profit->where('sale_of_month',$request->month);
 }

  if(isset($request->company) && $request->company!=null){
      $profit=$profit->where('select_company_id',$request->company);
  }

  $profit=$profit->get();

  // echo json_encode($profit);
  // exit();

  $tds = DB::table('tds')->select('tds')->first();

  $expense_sum = 0;

  if (!$profit->isEmpty()) {
      $expense = DB::table('expense_entries')
          ->where('select_year', $profit[0]->year_id)
          ->where('select_month', $profit[0]->sale_of_month)
          ->where('select_company', $profit[0]->select_company_id)
          ->join('expense_entry1s', 'expense_entry1s.expense_entry_id', '=', 'expense_entries.id')
          ->select('expense_entry1s.amount')
          ->get();

      $expense_sum = $expense->sum('amount');
  }
//   echo json_encode($sum);
  // echo json_encode($expense);
  // exit();

      return view('profit_loss.profit',compact('profit','tds','expense_sum'));
    }
    
}
