CakePHP-TwilioComponent
=======================

TwilioComponent for CakePHP 2.x

#Installation

1.	Download and extract Twilio PHP library from [twilio-php](https://github.com/twilio/twilio-php) to app/Vendor/Twilio
2.	Download and extract [CakePHP-TwilioComponent](https://github.com/nafu/CakePHP-TwilioComponent) to app/Controller/Component/
3.	Set variables in app/Config/bootstrap.php

		// Twilio.sid - Your Twilio account sid
		// Twilio.token - Your Twilio auth token
		Configure::write(
    		'Twilio',
    		array(
        		'sid' =>  'ACXXXXXX',
        		'token' => 'YYYYYY'
    		)
		);

# Usage

1.	Call the component in controller
		
		class ExampleController extends AppController {
			public $name = 'Example';
			
			public $components = array(
				'TwilioComponent'
			);

			public function send() {
				$this->Twilio->sendSMS(
					'+14085551234', // From a Twilio number in your account
					'+12125551234', // Text any number
					"Hello monkey!"
				);
			}
		}