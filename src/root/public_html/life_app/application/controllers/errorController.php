<?php
require_once LIBRARY .'Life/controller/Controller.php';
use \Life;
class ErrorController extends Life\Controller
{	
	public function init()
	{
		# 
		
		# Get base URL
		require_once APPLICATION . 'application/helpers/Url.php';
		$url = New Url();
		$this->base_url = $url->base_path();
	}
	
	public function indexAction()
	{
		# 
		
		# Do not edit below. Call layout.
		require_once APPLICATION . 'application/layouts/' . $this->layout . '.phtml';
	}
}