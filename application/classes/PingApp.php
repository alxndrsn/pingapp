<?php defined('SYSPATH') or die('No direct script access');

final class PingApp {
	
	/**
	 * Name of the SMS provider
	 * @var string
	 */
	public static $sms_provider = NULL;
	
	/**
	 * Phone number to use for outgoing messages
	 * @var string
	 */
	public static $sms_sender = NULL;
	
	/**
	 * Additional options for the SMS provider
	 * @var array
	 */
	public static $sms_provider_options = array();
	
	/**
	 * Initializes Pingapp, setting the default applications options
	 */
	public static function init()
	{
		$sms_config = Kohana::$config->load('sms')->as_array();
		
		try
		{
			// SMS provider
			self::$sms_provider = $sms_config['provider'];
		
			// Sender number
			self::$sms_sender = $sms_config['sender_number'];
		
			// Additional 
			self::$sms_provider_options = $sms_config['options'];
		}
		catch (ErrorException $e)
		{
			// There is an error in the config
			Kohana::$log->add(Log::ERROR,
			    __("Error in the configuration of the SMS provider. :error", array(":errror" => $e->getMessage())));
			
			// Unset the SMS provider
			self::$sms_provider = NULL;
		}
	}
}