<?php

namespace App\Http\Controllers;

use \App\Http\Controllers\Controller;
use App\Menu;
use App\Order;
use App\OrderItem;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Theme;
use App\Sample;
use PDF;
use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
    public function cashierPage(){

        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('cashier.cashier')->render();
    }

    public function paidOrders(){

        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('cashier.paidorder')->render();
    }


    public function transactionPage(Request $request){

        $theme = Theme::uses('default')->layout('default')->setTitle('');

        $data = Order::where('id',$request->id)->first();

        $view = array(
            'transaction' =>$data
        );


        return $theme->scope('cashier.transaction',$view)->render();

    }

    public function changeToPaid(Request $request){
        $id = $request->id;
        $table_number = $request->table_number;

        $order = Order::where('id',$id)->update(['order_status'=>3]);
		
		//update table
		
		$updateTable = DB::table('restaurant_table')->where('id',$table_number)->update(['status'=>0]);
    }

    public function loadajaxPage(){
        return view('cashier-list');
    }

    public function loadajaxPagePaid(){
        return view('paidorder-list');
    }

    public function pdf(Request $request){
        $transaction_details = Order::where('id',$request->id)->first();
        $transaction_details['transac'] = $transaction_details;
        $customPaper = array(0,0,300,360);
        $pdf      = PDF::loadView('pdf.'.'transaction',$transaction_details);

        $pdf->setPaper($customPaper);
        return @$pdf->stream();
    }

}
