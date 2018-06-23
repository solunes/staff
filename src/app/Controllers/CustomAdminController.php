<?php

namespace Solunes\Staff\App\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Asset;

class CustomAdminController extends Controller {

	protected $request;
	protected $url;

	public function __construct(UrlGenerator $url) {
	  $this->middleware('auth');
	  $this->middleware('permission:dashboard');
	  $this->prev = $url->previous();
	  $this->module = 'admin';
	}

	public function getIndex() {
		$user = auth()->user();
		//$array['tasks'] = $user->active_staff_tasks;
		$array['tasks'] = \Solunes\Staff\App\StaffTask::limit(2)->get();
		$array['active_issues_staffs'] = \Solunes\Staff\App\Staff::has('active_staff_issues')->with('active_staff_issues')->get();
      	return view('staff::list.dashboard', $array);
	}

	/* Módulo de Proyectos */

	public function allStaffs() {
		$array['items'] = \Solunes\Staff\App\Staff::get();
      	return view('staff::list.staffs', $array);
	}

	public function findStaff($id, $tab = 'description') {
		if($item = \Solunes\Staff\App\Staff::find($id)){
			$array = ['item'=>$item, 'tab'=>$tab];
      		return view('staff::item.staff', $array);
		} else {
			return redirect($this->prev)->with('message_error', 'Item no encontrado');
		}
	}

	public function findStaffTask($id) {
		if($item = \Solunes\Staff\App\StaffTask::find($id)){
			$array = ['item'=>$item];
      		return view('staff::item.staff-task', $array);
		} else {
			return redirect($this->prev)->with('message_error', 'Item no encontrado');
		}
	}

	public function findProjecIssue($id) {
		if($item = \Solunes\Staff\App\StaffIssue::find($id)){
			$array = ['item'=>$item];
      		return view('staff::item.staff-issue', $array);
		} else {
			return redirect($this->prev)->with('message_error', 'Item no encontrado');
		}
	}

	public function allWikis($staff_type_id = NULL, $wiki_type_id = NULL) {
		$array['staff_type_id'] = $staff_type_id;
		$array['wiki_type_id'] = $wiki_type_id;
		if($staff_type_id&&$wiki_type_id){
			$array['items'] = \Solunes\Staff\App\Wiki::where('staff_type_id',$staff_type_id)->where('wiki_type_id',$wiki_type_id)->get();
		} else if($staff_type_id){
			$array['items'] = \Solunes\Staff\App\WikiType::get();
		} else {
			$array['items'] = \Solunes\Staff\App\StaffType::get();
		}
      	return view('staff::list.wikis', $array);
	}

	public function findWiki($id) {
		if($item = \Solunes\Staff\App\Wiki::find($id)){
			$array = ['item'=>$item];
      		return view('staff::item.wiki', $array);
		} else {
			return redirect($this->prev)->with('message_error', 'Item no encontrado');
		}
	}

}