<?php
/* Copyright (c) 1998-2009 ILIAS open source, Extended GPL, see docs/LICENSE */

include_once("./Services/Cron/classes/class.ilCronHookPlugin.php");

/**
 * Viplab cron plugin
 * @author Stefan Meyer <smeyer.ilias@gmx.de>
 */
class ilViPLabCronPlugin extends ilCronHookPlugin
{
	private static $instance = null;

	const CTYPE = 'Services';
	const CNAME = 'Cron';
	const SLOT_ID = 'crnhk';
	const PNAME = 'ViPLabCron';

	/**
	 * Get singleton instance
	 * @global ilPluginAdmin $ilPluginAdmin
	 * @return \ilViPLabCronPlugin
	 */
	public static function getInstance()
	{
		global $ilPluginAdmin;

		if(self::$instance)
		{
			return self::$instance;
		}
		include_once './Services/Component/classes/class.ilPluginAdmin.php';
		return self::$instance = ilPluginAdmin::getPluginObject(
			self::CTYPE,
			self::CNAME,
			self::SLOT_ID,
			self::PNAME
		);
	}
	
	/**
	 * Get plugin name
	 * @return string
	 */
	public function getPluginName()
	{
		return self::PNAME;
	}
	
	/**
	 * Init auto load
	 */
	protected function init()
	{
		$this->initAutoLoad();
	}
		
	/**
	 * Init auto loader
	 * @return void
	 */
	protected function initAutoLoad()
	{
		spl_autoload_register(
			array($this,'autoLoad')
		);
	}

	/**
	 * Auto load implementation
	 *
	 * @param string class name
	 */
	private final function autoLoad($a_classname)
	{
		$class_file = $this->getClassesDirectory().'/class.'.$a_classname.'.php';
		if(@include_once($class_file))
		{
			return;
		}
	}

	/**
	 * Get cron job instance
	 * @param type $a_id
	 * @return \ilViPLabCronJob
	 */
	public function getCronJobInstance($a_id)
	{
		$job = new ilViPLabCronJob();
		return $job;
	}
	
	
	/**
	 * Get cron job instances
	 * @global type $ilLog
	 * @return \ilViPLabCronJob[]
	 */
	public function getCronJobInstances()
	{
		$job = new ilViPLabCronJob();
		return array($job);
	}
	
}
?>