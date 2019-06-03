<?php

namespace Solunes\Staff\App;

use Illuminate\Database\Eloquent\Model;

class StaffSchedule extends Model {
	
	protected $table = 'staff_schedules';
	public $timestamps = true;
    
	/* Creating rules */
	public static $rules_create = array(
        'parent_id'=>'required',
        'name'=>'required',
        'day'=>'required',
        'initial_time'=>'required',
        'end_time'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
        'parent_id'=>'required',
        'name'=>'required',
        'day'=>'required',
        'initial_time'=>'required',
        'end_time'=>'required',
	);
                        
    public function parent() {
        return $this->belongsTo('Solunes\Staff\App\Staff');
    }

    public function staff() {
        return $this->belongsTo('Solunes\Staff\App\Staff', 'parent_id');
    }
}