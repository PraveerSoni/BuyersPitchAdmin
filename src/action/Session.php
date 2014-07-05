<?php
interface Session {
	
	function putIntoSession($attributeName, $attributeValue);
	
	function getFromSessionByAttributeName($attributeName);
	
	function getAllFromSession();
}
?>