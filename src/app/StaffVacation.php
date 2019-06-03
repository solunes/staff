<?php

namespace Solunes\Staff\App;

use Illuminate\Database\Eloquent\Model;

class StaffVacation extends Model {
	
	protected $table = 'staff_vacations';
	public $timestamps = true;
    
	/* Creating rules */
	public static $rules_create = array(
        'parent_id'=>'required',
        'staff_year_id'=>'required',
        'initial_date'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
        'parent_id'=>'required',
        'staff_year_id'=>'required',
        'initial_date'=>'required',
	);
                        
    public function parent() {
        return $this->belongsTo('Solunes\Staff\App\Staff');
    }

    public function staff() {
        return $this->belongsTo('Solunes\Staff\App\Staff', 'parent_id');
    }

}