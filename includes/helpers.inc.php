<?php 
function html($text)
{
	return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');	
	}

function htmlout($text){
	echo html($text);
	}

function curFormat($cur){
	return sprintf('%0.2f', $cur); 
}
function ratFormat($rat){
	return sprintf('%0.3f', $rat);
}
