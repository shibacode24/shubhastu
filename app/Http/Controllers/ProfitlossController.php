<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Year;
use App\Models\Addcompany;
use Illuminate\Support\Carbon;

class ProfitlossController extends Controller
{
   

    // public function index(Request $request){
    
    //     $year = Year::all();
    //     $company = Addcompany::all();

    //     // $selected_month = \Carbon\Carbon::now()->format('F');
    //     $selected_month = \Carbon\Carbon::now()->subMonth()->format('F');


    //     if(isset($request->month))
    //     {
    //         $selected_month = $request->month;
    //     }
    //     $profit = DB::table('secondary__sales')
    //     ->leftjoin('secondary_medicines', 'secondary_medicines.secondary__sales_id', '=', 'secondary__sales.id')
    //     ->leftjoin('years', 'years.id', '=', 'secondary__sales.year_id')
    //     ->leftjoin('addcompanies', 'addcompanies.id', '=', 'secondary__sales.select_company_id')
    //      ->leftjoin('promotor__sales', 'promotor__sales.select_company_id', '=', 'addcompanies.id') // Added left join for promotor__sales
    //     ->leftjoin('expense_entries', 'expense_entries.select_company', '=', 'addcompanies.id')
    //      ->leftjoin('expense_entry1s', 'expense_entry1s.expense_entry_id', '=', 'expense_entries.id')

    //     ->select(
    //         'years.year',
    //         'addcompanies.Name',
    //         'secondary__sales.id as secondary__sales',
    //         'secondary__sales.year_id',
    //         'secondary__sales.sale_of_month',
    //         'secondary__sales.select_company_id',
    //         'secondary__sales.grand_total1',
    //         'secondary__sales.sale_value_total1',
    //         DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
    //         DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.sale_value_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
    //         DB::raw("(SELECT SUM(CASE WHEN pp.sale_of_month = '$selected_month' THEN pp.grand_total1 ELSE 0 END) FROM promotor__sales pp WHERE pp.select_company_id = addcompanies.id AND pp.year_id = years.id) as tds_sum"), // Sum of grand_total1 from promotor__sales
    //         DB::raw("(SELECT SUM(CASE WHEN ee.select_month = '$selected_month' THEN expense_entry1s.amount ELSE 0 END) FROM expense_entries ee
    //         LEFT JOIN expense_entry1s ON ee.id = expense_entry1s.expense_entry_id
    //         WHERE ee.select_company = addcompanies.id AND ee.select_year = years.id) as expense_sum"),
    
    //     )
    //     ->groupBy([
    //         'secondary__sales.sale_of_month',
    //         'secondary__sales.year_id',
    //         'secondary__sales.select_company_id',
    //     ]);
    
    // if(isset($request->year) && $request->year!=null){
    //     $profit = $profit->where('secondary__sales.year_id', $request->year);
    // }
    
    // $profit = $profit->where('secondary__sales.sale_of_month', $selected_month);
    
    // if(isset($request->company) && $request->company!=null){
    //     $profit = $profit->where('secondary__sales.select_company_id', $request->company);
    // }
    
    // $profit = $profit->get();
    
  
    // // echo json_encode($profit);
    // // exit();
  
    // $tds = DB::table('tds')->select('tds')->first();
  
    
   
    //     return view('profitloss',compact('year', 'company','profit','tds'));
    // }

    public function index(Request $request) {
        // Eager load necessary data
        $year = Year::orderby('id','desc')->get();
        $company = Addcompany::all();
    
        // Get selected month
        $selected_month = $request->input('month', Carbon::now()->subMonth()->format('F'));
    
        // Define subqueries for total calculations
        $total_grand_total1 = "(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id)";
        $total_grand_total2 = "(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.sale_value_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id)";
        $tds_sum = "(SELECT SUM(CASE WHEN pp.sale_of_month = '$selected_month' THEN pp.grand_total1 ELSE 0 END) FROM promotor__sales pp WHERE pp.select_company_id = addcompanies.id AND pp.year_id = years.id)";
        $expense_sum = "(SELECT SUM(CASE WHEN ee.select_month = '$selected_month' THEN expense_entry1s.amount ELSE 0 END) FROM expense_entries ee LEFT JOIN expense_entry1s ON ee.id = expense_entry1s.expense_entry_id WHERE ee.select_company = addcompanies.id AND ee.select_year = years.id)";
    
        // Base query
        $profit = DB::table('secondary__sales')
            ->leftJoin('secondary_medicines', 'secondary_medicines.secondary__sales_id', '=', 'secondary__sales.id')
            ->leftJoin('years', 'years.id', '=', 'secondary__sales.year_id')
            ->leftJoin('addcompanies', 'addcompanies.id', '=', 'secondary__sales.select_company_id')
            ->select(
                'years.year',
                'addcompanies.Name',
                'secondary__sales.id as secondary__sales',
                'secondary__sales.year_id',
                'secondary__sales.sale_of_month',
                'secondary__sales.select_company_id',
                'secondary__sales.grand_total1',
                'secondary__sales.sale_value_total1',
                DB::raw($total_grand_total1 . " as total_grand_total1"),
                DB::raw($total_grand_total2 . " as total_grand_total2"),
                DB::raw($tds_sum . " as tds_sum"),
                DB::raw($expense_sum . " as expense_sum")
            )
            ->groupBy([
                'secondary__sales.sale_of_month',
                'secondary__sales.year_id',
                'secondary__sales.select_company_id',
            ]);
    
        // Filter conditions
        if ($request->filled('year')) {
            $profit->where('secondary__sales.year_id', $request->year);
        }
    
        $profit->where('secondary__sales.sale_of_month', $selected_month);
    
        if ($request->filled('company')) {
            $profit->where('secondary__sales.select_company_id', $request->company);
        }
    
        // $profit = $profit->get();

        $profit = $profit->orderBy('year_id','desc')
        ->orderBy('sale_of_month', 'asc')
        ->get();
    
        $tds = DB::table('tds')->select('tds')->first();
    
        return view('profitloss', compact('profit','year', 'company',  'tds'));
    }
    

    public function profit(Request $request)
    {

      $selected_month = \Carbon\Carbon::now()->format('F');


      if(isset($request->month))
      {
          $selected_month = $request->month;
      }
      $profit = DB::table('secondary__sales')
      ->leftjoin('secondary_medicines', 'secondary_medicines.secondary__sales_id', '=', 'secondary__sales.id')
      ->leftjoin('years', 'years.id', '=', 'secondary__sales.year_id')
      ->leftjoin('addcompanies', 'addcompanies.id', '=', 'secondary__sales.select_company_id')
      ->select(
        'years.year',
        'addcompanies.Name',
        'secondary__sales.id as secondary__sales',
        'secondary__sales.year_id',
        'secondary__sales.sale_of_month',
        'secondary__sales.select_company_id',
        'secondary__sales.grand_total1',
        'secondary__sales.sale_value_total1',
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.sale_value_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
        
      );
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
$tds_sum = 0;
  $payble_amt_sum = 0;

  if (!$profit->isEmpty()) {
      $promotor_sales = DB::table('promotor__sales')
          ->where('year_id', $profit[0]->year_id)
          ->where('sale_of_month', $profit[0]->sale_of_month)
          ->where('select_company_id', $profit[0]->select_company_id)
          ->select('grand_total1','grand_total2')
          ->get();

      $tds_sum = $promotor_sales->sum('grand_total1');
      $payble_amt_sum = $promotor_sales->sum('grand_total2');
    
      
  }
    //  echo json_encode($expense_sum);
//   echo json_encode($payble_amt_sum);
//   exit();

      return view('profit_loss.profit',compact('profit','tds','expense_sum','tds_sum','payble_amt_sum'));
    }
    
    
}
