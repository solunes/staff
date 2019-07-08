<?php

namespace Solunes\Staff\App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model {
	
	protected $table = 'staffs';
	public $timestamps = true;

	/* Creating rules */
	public static $rules_create = array(
		'agency_id'=>'required',
		'type'=>'required',
        'status'=>'required',
        'first_name'=>'required',
        'last_name'=>'required',
        'initial_date'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
		'id'=>'required',
        'agency_id'=>'required',
        'type'=>'required',
        'status'=>'required',
        'first_name'=>'required',
        'last_name'=>'required',
        'initial_date'=>'required',
	);
                        
    public function agency() {
        return $this->belongsTo('Solunes\Business\App\Agency');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function staff_category() {
        return $this->belongsTo('Solunes\Staff\App\StaffCategory');
    }

    public function staff_years() {
        return $this->hasMany('Solunes\Staff\App\StaffYear', 'parent_id');
    }

    public function staff_wages() {
        return $this->hasMany('Solunes\Staff\App\StaffWage', 'parent_id');
    }

    public function staff_schedules() {
        return $this->hasMany('Solunes\Staff\App\StaffSchedule', 'parent_id');
    }

    public function staff_vacations() {
        return $this->hasMany('Solunes\Staff\App\StaffVacation', 'parent_id');
    }

    public function staff_payments() {
        return $this->hasMany('Solunes\Staff\App\StaffPayment', 'parent_id');
    }

}