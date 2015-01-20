<?php

class Error_log{

	private $content;

	public function __construct($error_content = null)
	{
		$this->content = $error_content;
		if ($this->content != null) {
            //	$this->write_content();
        }
	}

	private function get_filename()
	{
		$file_path = $_SERVER['PHP_SELF'];
		return $file_path;
	}

	private function get_date()
	{
		$date =	date('r');
		return $date;
	}

	private function write_content()
	{
		// code..
		$content = $this->get_date()."\r\n";
		$content = $content."".$this->get_filename().":".$this->content."\r\n \r\n \r\n \r\n";
//		$file = fopen("error.log", "a+");
//		fwrite($file, $content);
//		fclose($file);
	}

}
?>
