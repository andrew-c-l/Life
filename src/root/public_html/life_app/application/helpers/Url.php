<?php
class Url
{
	public function base_url()
	{
		$s = empty($_SERVER["HTTPS"]) ? ''
			: ($_SERVER["HTTPS"] == "on") ? "s"
			: "";
			
		$protocol = $this->strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
		
		$port = ($_SERVER["SERVER_PORT"] == "80") ? ""
			: (":".$_SERVER["SERVER_PORT"]);
			
		return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
	}
	
	public function base_path()
	{
		//$folder = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")+1);
		$folder = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")); 
		
		return $folder;
	}
	
	private function strleft($s1, $s2)
	{
		return substr($s1, 0, strpos($s1, $s2));
	}

//echo selfURL();
}