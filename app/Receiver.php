<?php

namespace App;

class Receiver {
	public static function send($data) {
		
		// send CURL post
		$data_string = json_encode ( $data );
		
		$url = env ( 'RECEIVER_URL', '' ) . '/save';
		$ch = curl_init ( $url );
		curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data_string );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
				'Content-Type: application/json',
				'Content-Length: ' . strlen ( $data_string ) 
		) );
		
		$result = curl_exec ( $ch );
		
		return $result;
	}
}