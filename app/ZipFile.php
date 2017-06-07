<?php

namespace App;

class Zipfile {
	public static function getFiles($fileName) {
		$zip = new \ZipArchive ();
		$zipList = array ();
		if ($zip->open ( $fileName ) === true) {
			for($i = 0; $i < $zip->numFiles; $i ++) {
				$zipList [] = $zip->getNameIndex ( $i );
			}
		} else {
			echo 'Error reading zip archive';
		}
		return $zipList;
	}
	public static function encyptFileNames($fileNames) {
		$newFileNames = [ ];
		
		foreach ( $fileNames as $fileName ) {
			$newFileNames [] = self::encrypt ( $fileName, env ( 'FILE_ENCRYPTION_KEY', '' ) );
		}
		
		return $newFileNames;
	}
	public static function encrypt($value, $key) {
		return base64_encode ( $value ) . $key;
	}
}