<?php

class Template
{
	private $openTag = "{";
	private $closeTag = "}";
	public  $templateData;
	
	public function __construct($templateData)
	{
		$this->templateData = $templateData;
	}
	
    public function output($file) 
	{
        $html = file_get_contents($file);
        foreach ($this->templateData as $key => $value) 
		{
            $html = str_replace($this->openTag . $key . $this->closeTag, $value, $html);
        }
        echo $html;	
		
	}
}
$template = new Template($data);










