<?php

namespace Solunes\Staff\App;

use Illuminate\Database\Eloquent\Model;

class StaffYear extends Model {
	
	protected $table = 'staff_years';
	public $timestamps = true;
    
	/* Creating rules */
	public static $rules_create = array(
        'parent_id'=>'required',
        'name'=>'required',
        'quantity'=>'required',
        'initial_date'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
        'parent_id'=>'required',
        'name'=>'required',
        'quantity'=>'required',
        'initial_date'=>'required',
	);
                        
    public function parent() {
        return $this->belongsTo('Solunes\Staff\App\Staff', 'parent_id');
    }

}