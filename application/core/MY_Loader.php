<?php
/**
 * Created by PhpStorm.
 * User: zide
 * Date: 14-4-12
 * Time: 下午3:04
 */
class MY_Loader extends CI_Loader {
	const VIEW_FILE_EXT = '.view.php';

	public function __construct()
	{
		parent::__construct();
		
		//$this->_ci_view_paths = array(APPPATH.'views/base/'	=> TRUE);
	}
}