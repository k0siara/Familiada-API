<?php

$app->post('/user/:username/vote/question/:question/answer/:answer', function($username, $question, $answer) use($app) {

	try {

		$user = Users::where('username', '=', $username)
    				->get();
    	$user = json_decode($user);

    	if (empty($user)) {
    		throw new ArrayException(404, array(
				'message' => 'User Not Found', 
				'documentation_url' => 'URL'
			));
    	}

    	if ($user[0]->voted == true) {
			throw new ArrayException(403, array(
				'message' => 'User Has Already Voted', 
				'documentation_url' => 'URL'
			));
    	}

    	$answeredQuestions = 0;
    	foreach ($user[0] as $key => $value) {
    		if (strpos($key, 'q')) {
    			if (is_null($value)) {
    				$answeredQuestions++;
    			}
    		}
    	}

    	if ($answeredQuestions == 10) {

    		Users::where('username', $username)->update([$voted => true]);

    		throw new ArrayException(403, array(
				'message' => 'User Has Already Voted', 
				'documentation_url' => 'URL'
			));
    	}

    	if ($answer != 'A' && $answer != 'B' && $answer != 'C' && $answer != 'D' && $answer != 'E' && $answer != 'F') {
    		throw new ArrayException(403, array(
				'message' => 'Wrong Answer', 
				'documentation_url' => 'URL'
			));
    	}

    	$key = 'q' . $question;
    	if (!is_null($user[0]->$key)) {
    		throw new ArrayException(403, array(
				'message' => 'Question Already Answered', 
				'documentation_url' => 'URL'
			));
    	}

    	Users::where('username', '=', $username)->update([$key => $answer]);
    	
		
	} catch (ArrayException $e) {
		set_response_json_with_status($e->getCode());
		echo pretty_json($e->getArrayMessage());
	}

});