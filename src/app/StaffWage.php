<?php

namespace Solunes\Staff\App;

use Illuminate\Database\Eloquent\Model;

class StaffWage extends Model {
	
	protected $table = 'staff_wages';
	public $timestamps = true;
    
    /* Creating rules */
    public static $rules_create_order = array(
        'product_id'=>'required',
        'status'=>'required',
        'quantity'=>'required',
        'currency_id'=>'required',
        'cost'=>'required',
        'partner_id'=>'required',
        'partner_transport_id'=>'required',
    );

	/* Creating rules */
	public static $rules_create = array(
        'product_id'=>'required',
        'status'=>'required',
        'quantity'=>'required',
        'currency_id'=>'required',
        'cost'=>'required',
        'partner_id'=>'required',
        'partner_transport_id'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
		'id'=>'required',
        'product_id'=>'required',
        'status'=>'required',
        'quantity'=>'required',
        'currency_id'=>'required',
        'cost'=>'required',
        'partner_id'=>'required',
        'partner_transport_id'=>'required',
	);
                        
    public function parent() {
        return $this->belongsTo('Solunes\Staff\App\Staff', 'parent_id');
    }
                        
    public function currency() {
        return $this->belongsTo('Solunes\Business\App\Currency');
    }

}