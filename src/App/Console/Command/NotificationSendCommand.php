<?php

namespace App\Console\Command;

/**
 * Composer library
 * Based on Example library (https://github.com/shakahl/skeleton-composer-project)
 *
 * Copyright (c) 2015 Soma Szélpál
 * Soma Szélpál, http://shakahl.com
 *
 * MIT Licensed
 * 
 * @category  Example\Console\Command
 * @package   Example\Console\Command
 * @author    Soma Szélpál <szelpalsoma@gmail.com>
 * @license   MIT Open Source License http://opensource.org/osi3.0/licenses/mit-license.php
 * @version @package-version@
 */

use App\Exception\PharoverException;
use App\Library\SimplePushover;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Dummy command controller
 */
class NotificationSendCommand extends Command
{
    /**
     * Pushover API user key
     * 
     * @var string|null
     */
    protected $apiUserKey = null;

    /**
     * Pushover API token key
     * 
     * @var string|null
     */
    protected $apiTokenKey = null;

    /**
     * Pushover API token key
     * 
     * @var string|null
     */
    protected $applicationDir = null;

    /**
     * Constructor.
     *
     * @param string $applicationDir
     * @param string|null $name The name of the command; passing null means it must be set in configure()
     *
     * @throws \Symfony\Component\Console\Exception\LogicException When the command name is empty
     */
    public function __construct($applicationDir)
    {
        parent::__construct();

        $this->applicationDir = $applicationDir;
    }

    /**
     * Set up command
     * 
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('notification:send')
            ->setDescription('Send notification')
            ->addArgument(
                'message',
                InputArgument::REQUIRED,
                'Notification message'
            )
            ->addOption('title', 't', InputOption::VALUE_OPTIONAL, 'Notification title', null)
            ->addOption('url', 'u', InputOption::VALUE_OPTIONAL, 'Notification URL', null)
            ->addOption('url-title', 'l', InputOption::VALUE_OPTIONAL, 'Notification URL title', null)
            ->addOption('user-key', 'k', InputOption::VALUE_OPTIONAL, 'Api user key')
            ->addOption('token-key', 'o', InputOption::VALUE_OPTIONAL, 'Api token key')
        ;
    }
    
    /**
     * Execute the command
     * 
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * Initialization
         */
        $formatter = $this->getHelper('formatter');

        $params = [
            'title'     => null,
            'url'       => null,
            'url-title' => null,
            'message'   => null,
            'user-key'  => null,
            'token-key' => null,
        ];

        /**
         * Load the configurations
         */
        $config = $this->loadConfiguration();

        $params = array_merge($params, $config);

        /**
         * Process the arguments and options
         */
        $params['message'] = $input->getArgument('message');

        if ($input->hasOption('title'))
        {
            $params['title'] = $input->getOption('title');
        }

        if ($input->hasOption('url'))
        {
            $params['url'] = $input->getOption('url');
        }

        if ($input->hasOption('url-title'))
        {
            $params['url-title'] = $input->getOption('url-title');
        }

        if ($input->getOption('user-key'))
        {
            $params['user-key'] = $input->getOption('user-key');
        }

        if ($input->getOption('token-key'))
        {
            $params['token-key'] = $input->getOption('token-key');
        }

        /**
         * Validation
         */
        if (empty($params['user-key']) || strlen($params['user-key']) != 30)
        {
            throw new PharoverException('Invalid or empty Pushover api user key specified (user-key)');
        }

        if (empty($params['token-key']) || strlen($params['token-key']) != 30)
        {
            throw new PharoverException('Invalid or empty Pushover api token key specified (token-key)');
        }

        /**
         * Sending
         */
        try
        {
            $pushover = new SimplePushover($params['token-key'], $params['user-key']);
            $result = $pushover->sendMessage($params['message'], $params['title'], $params['url'], $params['url-title']);

            if ($result['http_code'] != 200 || $result['status'] != SimplePushover::STATUS_OK)
            {
                throw new PharoverException('Pushover API error!');
            }

            $output->writeln($formatter->formatSection('success', ($params['title'] ? $params['title'] . ' ' : '') . $params['message'], 'info'));
        }
        catch (\Exception $e)
        {
            $output->writeln($formatter->formatSection('error', 'The message was not sent!', 'error'));

            throw $e;
        }

        exit(0);
    }

    /**
     * Load configuration file.
     * 
     * @return array
     */
    protected function loadConfiguration()
    {
        $config = [
            'user-key'  => null,
            'token-key' => null,
        ];

        $directories = [
            $this->applicationDir,
            getcwd(),
            getenv("HOME"),
        ];

        foreach ($directories as $dir)
        {
            $configFile = $dir . '/.pharorver.json';

            if (!file_exists($configFile))
            {
                continue;
            }

            $content = file_get_contents($configFile);
            $content = utf8_encode($content); 
            $configArray = json_decode($content, true);

            if (json_last_error() !== JSON_ERROR_NONE)
            {
                throw new PharoverException($configFile . ': ' . json_last_error_msg());
            }

            if ($configArray !== null && is_array($configArray))
            {
                // $config = array_merge_recursive($config, $configArray);

                if (empty($config['user-key']) && array_key_exists('user-key', $configArray))
                {
                    $config['user-key'] = $configArray['user-key'];
                }

                if (empty($config['token-key']) && array_key_exists('token-key', $configArray))
                {
                    $config['token-key'] = $configArray['token-key'];
                }
            }
        }

        return $config;
    }
}

