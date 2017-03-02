<?php

function pretty_json($data) {
    return json_encode($data, JSON_PRETTY_PRINT) . "\n";
}

function set_response_json_with_status($status) {
	set_response_header_json();
	set_response_status($status);
}

function set_response_header_json() {
	$app = \Slim\Slim::getInstance();
	$app->response->headers->set('Content-Type', 'application/json');
}

function set_response_status($status){
	$app = \Slim\Slim::getInstance();
	$app->response->setStatus($status);
}

function keyword_array_search($keyword, $array){
    foreach($array as $key => $arrayItem){
        if( stristr( $arrayItem, $keyword ) ){
            return true;
        }
    }
    return false;
}