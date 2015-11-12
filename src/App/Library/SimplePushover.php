<?php

namespace App\Library;

/**
 * SimplePushover
 */
class SimplePushover
{
	/**
	 * @var int
	 */
	const STATUS_OK = 1;

	/**
	 * @var int
	 */
	const STATUS_ERROR = 0;

	/**
	 * @var string|null
	 */
	protected $apiToken = null;

	/**
	 * @var string|null
	 */
	protected $apiUser = null;

	/**
	 * Constructor
	 * 
	 * @param string $apiToken
	 * @param string $apiUser
	 */
	public function __construct($apiToken, $apiUser)
	{
		$this->apiToken = $apiToken;
		$this->apiUser = $apiUser;
	}

	/**
	 * Send Pushover message
	 * 
	 * @param  string $message
	 * @param  string $title
	 * @param  string $url
	 * @param  string $urlTitle
	 * @return SimplePushover
	 */
	public function sendMessage($message, $title = null, $url = null, $urlTitle = null)
	{
		$params = array(
			"token" => $this->apiToken,
			"user" => $this->apiUser,
			"message" => $message,
		);

		if ($title !== null)
		{
			$params['title'] = $title;
		}

		if ($url !== null)
		{
			$params['url'] = $url;
		}

		if ($urlTitle !== null)
		{
			$params['url_title'] = $urlTitle;
		}

		curl_setopt_array($ch = curl_init(), array(
			CURLOPT_URL            => "https://api.pushover.net/1/messages.json",
			CURLOPT_POSTFIELDS     => $params,
			CURLOPT_HEADER         => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SAFE_UPLOAD    => true,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_SSL_VERIFYPEER => false,
		));

		$response = curl_exec($ch);

		if(curl_errno($ch) || $response === false)
		{
			throw new \Exception("Pushover response error: " . curl_error($ch));
		}

		$info = curl_getinfo($ch);

		curl_close($ch);

		if (empty($info['http_code']))
		{
            throw new \Exception("No HTTP code was returned");
        }

        $responseData = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE)
        {
            throw new \Exception('Invalid Pushover response: ' . $response);
        }

        $return = [
        	'status'    => self::STATUS_ERROR,
        	'http_code' => intval($info['http_code']),
        ];

        if (is_array($responseData))
        {
        	$return = array_merge($return, $responseData);
        }

		return $return;
	}
}