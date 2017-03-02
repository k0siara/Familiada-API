<?php

$app->get('/users', function() use($app) {

	$users = Users::all();
	$users = json_decode($users, true);

	$array = [];
	foreach ($users as $user) {
		foreach ($user as $key => $value) {
			if (is_null($value)) {
				unset($user[$key]);
			}
		}
		array_push($array, $user);
	}

	set_response_json_with_status(200);
	echo pretty_json($array);

});

$app->get('/user/:username', function($username) use($app) {

	try {
		$user = Users::where('username', '=', $username)
    				->firstOrFail();
    	$user = json_decode($user, true);

		foreach ($user as $key => $value) {
			if (is_null($value)) {
				unset($user[$key]);
			}
		}

	set_response_json_with_status(200);
	echo pretty_json($user);
		
	} catch (Exception $e) {
		set_response_json_with_status(404);
		echo pretty_json(array(
    	'message' => 'Not Found', 
    	'documentation_url' => 'URL'
   		));
	}

});