<?php

namespace Solunes\Staff\App;

use Illuminate\Database\Eloquent\Model;

class StaffCategory extends Model {
	
	protected $table = 'staff_categories';
	public $timestamps = true;

	/* Creating rules */
	public static $rules_create = array(
        'name'=>'required',
        'active'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
        'name'=>'required',
        'active'=>'required',
	);
                        
    public function staffs() {
        return $this->hasMany('Solunes\Staff\App\Staff');
    }
                        
}