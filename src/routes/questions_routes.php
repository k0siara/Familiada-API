<?php

$app->get('/question/:question', function($question) use($app) {

	try {

		if ($question < 1 || $question > 50) {
			throw new Exception();
		}

		$users = Users::all();
		$users = json_decode($users, true);

		$answerA = 0;
		$answerB = 0;
		$answerC = 0;
		$answerD = 0;
		$answerE = 0;
		$answerF = 0;

		foreach ($users as $user) {
			foreach ($user as $key => $value) {
				if ($key == 'q' . $question) {
					if (!is_null($value)) {
						if ($value == 'A') {
							$answerA++;
						} else if ($value == 'B') {
							$answerB++;
						} else if ($value == 'C') {
							$answerC++;
						} else if ($value == 'D') {
							$answerD++;
						} else if ($value == 'E') {
							$answerE++;
						} else if ($value == 'F') {
							$answerF++;
						}
					}
				}
			}
		}

		set_response_json_with_status(200);
		echo pretty_json(array('A' => $answerA, 'B' => $answerB, 'C' => $answerC, 'D' => $answerD, 'E' => $answerE, 'F' => $answerF));

		
	} catch (Exception $e) {
		set_response_json_with_status(404);
		echo pretty_json(array(
			'message' => 'Wrong question', 
			'documentation_url' => 'URL'
		));
	}

});