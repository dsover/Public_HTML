<?php 
function html($text)
{
	return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');	
	}

function htmlout($text){
	echo html($text);
	}

function curFormat($cur){
return number_format ( $cur , 2 , '.' , ',' );

//	return sprintf('%0.2f', $cur); 
}
function ratFormat($rat){
	return sprintf('%0.3f', $rat);
}

function getbgc($trcount)
{

$blue="\"background-color: #EEFAF6;\"";
$green="\"background-color: #D4F7EB;\"";
$odd=$trcount%2;
    if($odd==1){return $blue;}
    else{return $green;}    
}
