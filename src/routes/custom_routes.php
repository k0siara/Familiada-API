<?php

$app->get('/', function() use($app) {

	set_response_json_with_status(200);
	echo pretty_json(array(
		'message' => 'Hoffamiliada REST API made with Slim Framework 2 by Patryk Kosieradzki', 
		'authors' => ['Michalina Oleksiuk', 'Gabrysia Maciejewska', 'Ania Bucka', 'Patryk Kosieradzki', 'Maciej Sawczuk', 'Jakub Dymowski', 'Kacper Celmer'],
		'documentation_url' => 'URL'
	));
});

$app->notFound(function () use ($app) {

    set_response_json_with_status(404);
    echo pretty_json(array(
    	'message' => 'Not Found', 
    	'documentation_url' => 'URL'
    ));
});