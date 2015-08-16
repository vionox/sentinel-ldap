<?php namespace VIONOX\Sentinel\Addons\Ldap\Laravel\Facades;


use Illuminate\Support\Facades\Facade;

class Ldap extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'sentinel.addons.ldap';
	}

}
