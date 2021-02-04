<?php

require_once("config.php");

class Cache extends Config
{	
	
	private  $url;
	private  $file;
	public  $cachefile;
	
	public function __construct()
	{
		$this->parseINI("system/config/config.ini");
		
		$this->url = Explode('/', $_SERVER["SCRIPT_NAME"]);
		$this->file = $this->url[count($this->url) - 1];
		$this->cachefile = $this->sysDir."/".$this->dataDir."/".$this->cacheDir."/".md5(substr_replace($this->file ,"",-4));	
		
		
	}
	
	public function writeCache()
	{
		$cached = fopen($this->cachefile, 'w');
		fwrite($cached, ob_get_contents());
		fclose($cached);
	
	}
	
	public function getCache($page)
	{
		file_get_contents($this->cachefile);
		exit;
	}
	
	public function checkCache()
	{
		if(file_exists($this->cachefile) && time() - $this->cacheTTL < filemtime($this->cachefile)) {
			$this->getCache($this->cachefile);
			exit;
		}		
	}
	
	public function deleteCache($param)
	{
		switch($param)
		{
			case "all":
				{
					$files = glob($this->sysDir."/".$this->dataDir."/*"); // get all file names
					foreach($files as $file){ // iterate files
					  if(is_file($file)) {
						unlink($file); // delete file
					  }
					}
				}
			case "page":
				{
					unlink($this->cachefile);
				}
		}
	}
}

$cache = new Cache;


?>

