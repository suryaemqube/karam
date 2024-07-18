<?php 
namespace Emqube\Singlesign\Api;
 
 
interface CartInfoInterface {


	/**
	 * GET for Post api
	 * @param string $param
	 * @return string
	 */
	
	public function getCart($id);
}