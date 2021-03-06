<?php

namespace Solunes\Staff\App;

use Illuminate\Database\Eloquent\Model;

class StaffPayment extends Model {
	
	protected $table = 'staff_payments';
	public $timestamps = true;

	/* Creating rules */
	public static $rules_create = array(
        'parent_id'=>'required',
        'currency_id'=>'required',
        'name'=>'required',
        'status'=>'required',
        'amount'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
        'parent_id'=>'required',
        'currency_id'=>'required',
        'name'=>'required',
        'status'=>'required',
        'amount'=>'required',
	);
    
    public function parent() {
        return $this->belongsTo('Solunes\Staff\App\Staff');
    }

    public function staff() {
        return $this->belongsTo('Solunes\Staff\App\Staff', 'parent_id');
    }
                        
    public function currency() {
        return $this->belongsTo('Solunes\Business\App\Currency');
    }

}