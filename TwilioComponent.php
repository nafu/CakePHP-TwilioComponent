<?php
/**
 * TwilioComponent
 *  A component for Twilio
 *
 * @author Fumiya Nakamura <nakamurafumiya003@gmail.com>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class TwilioComponent extends Component {

/**
 * Twilio account sid
 *
 * @var string
 */
	public $sid = null;

/**
 * Twilio auth token
 *
 * @var string
 */
	public $token = null;

/**
 * Constructor. Will set properties of the correct Twilio class as defined in 'Configure::read('Twilio.sid')' and 'Configure::read('Twilio.token')'
 *
 * @see Component::__construct()
 * @throws CakeException when Twilio.sid or Twilio.token could not be loaded.
 */
	public function __construct() {
		$this->sid = Configure::read('Twilio.sid');
		$this->token = Configure::read('Twilio.token');
		if (empty($this->sid)) {
			throw new CakeException(__d('cake_dev', 'Twilio.sid is missing. Please set Twilio.sid in app/Config/bootstrap.php'));
		}
		if (empty($this->token)) {
			throw new CakeException(__d('cake_dev', 'Twilio.token is missing. Please set Twilio.token in app/Config/bootstrap.php'));
		}
	}

/**
 * Initializes TwilioComponent for use in the controller.
 *
 * @see Component::initialize()
 * @param Controller $controller A reference to the instantiating controller object
 * @return void*
 */
	public function initialize(Controller $controller) {
		// Calling Twilio library which is located in app/Vendor/Twilio
		if (file_exists(APP . 'Vendor' . DS . 'Twilio')) {
			include_once APP . 'Vendor' . DS . 'Twilio' . DS . 'Services' . DS . 'Twilio.php';
		} else {
			throw new CakeException(__d('cake_dev', 'app/Vendor/Twilio is missing. Please download it from https://github.com/twilio/twilio-php.git'));
		}
	}

/**
 * Startup TwilioComponent for use in the controller
 *
 * @param Controller $controller A reference to the instantiating controller object
 * @return void
 */
	public function startup(Controller $controller) {
		$this->controller = $controller;
	}

/**
 * Startup TwilioComponent for use in the controller
 *
 * @param $from a Twilio number in your account
 * @param $to any number
 * @param $message
 * @return void
 */
	public function sendSMS($from, $to, $message) {
		$client = new Services_Twilio($this->sid, $this->token);
		$message = $client->account->sms_messages->create(
			$from,	// From a valid Twilio number
			$to,	// Text this number
			$message
		);
	}
}