<?php 

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json =    json_decode($requestBody);


	$response = new \stdClass();
	// $response->speech = $speech;
	//$response->displayText = $speech;
	$response->source = "webhook";
	//$response->messages =json_decode('[{"type": 2,"platform": "facebook", "title": "What is your Water?","replies": ["Boiled","Filtered","Branded"]},{"type": 0,"speech": ""}]', false);
	//$response->fulfillmentMessages =json_decode('[{"quickReplies": {"title": "Please which type of water do you use?","quickReplies": ["Boiled Water","Filtered Water","Branded Water"]}}]', false);

    $checkParams=findParam($json);
    if( $checkParams->index!="-1")
    {
       switch ($checkParams->params[Count($checkParams->params)-1]) {	
           case 'city':
               # code...
               $response->messages =json_decode('[{"type": 2,"platform": "facebook", "title": "Please select your city?","replies": ["Karachi","Hyderabad"]},{"type": 0,"speech": ""}]', false);
               break;
           
           case 'waterType':
               # code...
               $response->messages =json_decode('[{"type": 2,"platform": "facebook", "title": "What type of water do you use?","replies": ["Boiled","Filtered","Branded"]},{"type": 0,"speech": ""}]', false);
               break;
           
           default:
               # code...
               break;
       }

    };
   
    echo json_encode($response);
    //print_r(findParam($json));
   
  //  $search_value=""
  //  echo(array_search($search_value, array_column($list, 'column_name'));)
}
else
{
	echo "Method not allowed";
}
function filter_by_key($array, $member, $value) {
    $filtered = array();
    foreach($array as $k => $v) {
       if($v->$member != $value)
          $filtered[$k] = $v;
    }
    return $filtered;
 }             
function findParam($nData)
{
    $contexts=$nData->result->contexts;
    foreach($contexts as $k => $v)
    {
    $splited=explode("_", $contexts[$k]->name);
   // echo $k;
    if($splited[Count($splited)-2]=="params")
    {
        $returnObject=new \stdClass();
        $returnObject->index=$k;
         $returnObject->params=$splited;
        
       //print_r($returnObject);
       return $returnObject;
    }

    $returnObject=new \stdClass();
    $returnObject->index="-1";
    }

    return $returnObject;
    //	print_r($contexts[0]->name);
    //print_r($splited[Count($splited)-2]==params);


}
?>
