<?php namespace VIONOX\Sentinel\Addons\Ldap\Laravel;

use VIONOX\Sentinel\Addons\Ldap\Manager;

class LdapServiceProvider extends \Illuminate\Support\ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	protected $defer = true;

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
        $this->setupConfig();
	}

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../../config/config.php');

        $this->publishes([$source => config_path('ldap.php')]);

        $this->mergeConfigFrom($source, 'ldap');
    }

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{

		$this->registerSentinelLdap();
	}


	/**
	 * Registers Sentinel LDAP.
	 *
	 * @return void
	 */
	protected function registerSentinelLdap()
	{
		$this->app['sentinel.addons.ldap'] = $this->app->share(function($app)
		{
			$manager = new Manager(
				$app['sentinel'],
				$app['events']
			);

			return $manager;
		});

		$this->app->alias('sentinel.addons.ldap', 'VIONOX\Sentinel\Addons\Ldap\Manager');
	}

	/**
	 * {@inheritDoc}
	 */
	public function provides()
	{
		return [
			'sentinel.addons.ldap',
		];
	}

}
