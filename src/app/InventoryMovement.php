<?php

namespace Solunes\Staff\App;

use Illuminate\Database\Eloquent\Model;

class StaffMovement extends Model {
	
	protected $table = 'staff_movements';
	public $timestamps = true;

	/* Creating rules */
	public static $rules_create = array(
		'product_id'=>'required',
		'place_id'=>'required',
		'type'=>'required',
		'name'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
		'id'=>'required',
		'product_id'=>'required',
		'place_id'=>'required',
		'type'=>'required',
		'name'=>'required',
	);
                        
    public function product() {
        return $this->belongsTo('Solunes\Staff\App\Product');
    }

    public function place() {
        return $this->belongsTo('Solunes\Staff\App\Place');
    }

}