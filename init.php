<?php
require_once("system/classes/site.php");

$templateData = $site;

require_once("system/classes/template.php");

require_once("system/classes/cache.php");

	if($cfg->enableCache == 1)
	{
		if($cache->checkCache() == 1)
		{
			$cache->getCache($cache->cachefile);
		}
		else
		{
			ob_start();
			$template->output($cfg->themeDir."/".$cfg->theme."/header.php");
			$template->output($cfg->themeDir."/".$cfg->theme.$_SERVER['SCRIPT_NAME']);
			$template->output($cfg->themeDir."/".$cfg->theme."/footer.php");
			$cache->writeCache();
			ob_end_flush();
		}
	}
	else
	{
		$template->output($cfg->themeDir."/".$cfg->theme."/header.php");
		$template->output($cfg->themeDir."/".$cfg->theme.$_SERVER['SCRIPT_NAME']);
		$template->output($cfg->themeDir."/".$cfg->theme."/footer.php");	
	}












