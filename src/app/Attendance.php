<?php

namespace Solunes\Staff\App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model {
	
	protected $table = 'attendances';
	public $timestamps = true;

	/* Creating rules */
	public static $rules_create = array(
        'staff_id'=>'required',
        'staff_schedule_id'=>'required',
        'name'=>'required',
        'date'=>'required',
        'initial_time'=>'required',
        'end_time'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
        'staff_id'=>'required',
        'staff_schedule_id'=>'required',
        'name'=>'required',
        'date'=>'required',
        'initial_time'=>'required',
        'end_time'=>'required',
	);
                        
    public function staff() {
        return $this->belongsTo('Solunes\Staff\App\Staff');
    }
                        
    public function staff_schedule() {
        return $this->belongsTo('Solunes\Staff\App\StaffSchedule');
    }

}