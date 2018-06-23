<?php
namespace Solunes\Staff;

use Illuminate\Support\Facades\Facade;

class StaffFacade extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'staff';
	}
}