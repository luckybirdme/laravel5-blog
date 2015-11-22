<?php


if (! function_exists('translang')) {
	
	function translang($text){
		if(strpos($text, '.') === false){
			$beforetrans = 'common.'.$text;
		}else{
			$beforetrans = $text;
		}

		$aftertrans = trans($beforetrans);

		if($aftertrans == $beforetrans){
			$array = explode('.',$aftertrans);
			if(count($array) > 1 && $array[1] == $text){
				$aftertrans = $text;
			}
		}
		
		return $aftertrans;
	}
}
