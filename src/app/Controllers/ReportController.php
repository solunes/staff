<?php

namespace Solunes\Staff\App\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Asset;

class ReportController extends Controller {

	protected $request;
	protected $url;

	public function __construct(UrlGenerator $url) {
    $this->middleware('auth');
    $this->middleware('permission:dashboard');
	  $this->prev = $url->previous();
	}

  public function getSalesReport() {
    $model = \Solunes\Staff\App\Sale::where('status','!=','holding');
    $array = \Staff::check_report_header($model);
    $array['show_place'] = true;

    $codes_array = ['income_sale', 'income_sale_credit', 'expense_refund'];
    $account_array = \Solunes\Staff\App\Account::whereIn('code', $codes_array)->lists('id')->toArray();
    $accounts = \Solunes\Staff\App\PlaceAccountability::whereIn('account_id', $account_array)->where('created_at', '>=', $array['i_date'])->where('created_at', '<=', $array['e_date']);
    if($array['place']!='all'){
      $accounts = $accounts->where('parent_id', $array['place']);
    }
    $accounts = $accounts->get();
    $staff = 0;
    $cash = 0;
    $pos = 0;
    $web = 0;
    $online = 0;
    $pending_total = 0;
    $sales_total = 0;
    $refund_total = 0;
    $currency = \Solunes\Staff\App\Currency::find(1);
    foreach($accounts as $item){
      $new_total = \Staff::calculate_currency($item->amount, $array['currency'], $item->currency);
      if($item->account->code=='expense_refund'){
        $refund_total -= $new_total;
      } else if($item->account->code=='income_sale_credit') {
        $pending_total += $new_total;
      } else {
        $staff += $new_total;
        $sales_total += $new_total;
        foreach($item->other_accounts as $other){
          $other_amount = \Staff::calculate_currency($other->real_amount, $array['currency'], $currency);
          if($other->account->concept->code=='asset_cash'){
            $cash += $other_amount;
          } else if($other->account->concept->code=='asset_bank'){
            $pos += $other_amount;
          }
        }
        /*if($item->type=='normal'){
          $staff += $paid;
          if($item->pos_bob>0){
            $new_total -= $item->pos_bob;
            $paid -= $item->pos_bob;
            $pos += $item->pos_bob;
          } 
          $cash += $paid;
        } else if($item->type=='web'){
          $web += $paid;
        } else if($item->type=='online'){
          $online += $paid;
        }*/
      }
    }
    $array = $array + ['total'=>$sales_total, 'staff'=>$staff, 'cash'=>$cash,'pos'=>$pos, 'web'=>$web, 'online'=>$online, 'pending'=>$pending_total, 'refund_total'=>$refund_total];
    // Gráficos
    $type_items = [['type'=>'paid','total'=>round($staff)], ['type'=>'web','total'=>round($web)], ['type'=>'online','total'=>round($online)], ['type'=>'pending','total'=>round($pending_total)]];
    $type_items = json_decode(json_encode($type_items));
    $type_field_names = ['paid'=>'Ventas en Tienda '.$array['currency']->name, 'web'=>'Ventas Web '.$array['currency']->name, 'online'=>'Ventas Online '.$array['currency']->name, 'pending'=>'Ventas no Cobradas '.$array['currency']->name];
    $array['graphs']['type'] = ['type'=>'pie', 'graph_name'=>'type', 'name'=>'type', 'label'=>'Tipo de Ventas', 'items'=>$type_items, 'subitems'=>[], 'field_names'=>$type_field_names];
    return \Staff::check_report_view('staff::list.sales-report', $array);
  }

}