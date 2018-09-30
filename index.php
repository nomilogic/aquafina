<?php 

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$text = $json->result->parameters->text;

	switch ($text) {
		case 'hi':
			$speech = "Hey  h r u";
		break;

		case 'bye':
			$speech = "Bye, good night";
			break;

		case 'anything':
			$speech = "Yes, you can type anything here.";
			break;
		
		default:
			$speech = "Sorry, I didnt get that. Please ask me something else.";
			break;
	}

	$response = new \stdClass();
	//$response->speech = $speech;
	//$response->displayText = $speech;
	$response->source = "webhook";
	//$response->messages =json_decode('[{"type": 2,"platform": "facebook", "title": "What is your Water?","replies": ["Boiled","Filtered"]},{"type": 0,"speech": ""}]', false);
	echo json_encode($response);
}
else
{
	echo "Method not allowed";
}

?>
