<?php

namespace Solunes\Staff\App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model {
	
	protected $table = 'staffs';
	public $timestamps = true;

	/* Creating rules */
	public static $rules_create = array(
		'place_id'=>'required',
		'currency_id'=>'required',
        'name'=>'required',
        'type'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
		'id'=>'required',
		'place_id'=>'required',
        'currency_id'=>'required',
        'name'=>'required',
        'type'=>'required',
	);
                        
    public function place() {
        return $this->belongsTo('Solunes\Business\App\Place');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function currency() {
        return $this->belongsTo('Solunes\Business\App\Currency');
    }

    public function staff_wages() {
        return $this->hasMany('Solunes\Staff\App\StaffWage', 'parent_id');
    }

    public function staff_payments() {
        return $this->hasMany('Solunes\Staff\App\StaffPayment', 'parent_id');
    }

}