<?php

namespace App;

use App\Console\Command\NotificationSendCommand;
use Symfony\Component\Console\Application as ConsoleApplication;

/**
 * Main application bootstrapper
 */
class Application
{
	const APPLICATION_CODE_NAME = 'pharover';

	/**
	 * @var \Symfony\Component\Console\Application|null
	 */
	protected $consoleApplication = null;

	/**
	 * Constructor
	 */
	public function __construct($applicationDir)
	{
		// Init console application
		$this->consoleApplication = new ConsoleApplication();
		
		// Adding commands
		$commandNotificationSendCommand = new NotificationSendCommand($applicationDir);

		$this->consoleApplication->add($commandNotificationSendCommand);
		$this->consoleApplication->setDefaultCommand($commandNotificationSendCommand->getName());
	}

	/**
	 * Run the application
	 * 
	 * @return \App\Application
	 */
	public function run()
	{
		$this->consoleApplication->run();

		return $this;
	}
}