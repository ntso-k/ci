<?php

class MY_Loader extends CI_Loader {
	const VIEW_FILE_EXT = '.tpl.php';

	public function __construct()
	{
		parent::__construct();
		
		//$this->_ci_view_paths = array(APPPATH.'views/base/'	=> TRUE);
	}

	/**
	 * Load View
	 *
	 * This function is used to load a "view" file.  It has three parameters:
	 *
	 * 1. The name of the "view" file to be included.
	 * 2. An associative array of data to be extracted for use in the view.
	 * 3. TRUE/FALSE - whether to return the data or load it.  In
	 * some cases it's advantageous to be able to return data so that
	 * a developer can process it in some way.
	 *
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	void
	 */
	public function view($view, $vars = array(), $return = FALSE)
	{
		$_view_ext = pathinfo($view, PATHINFO_EXTENSION);
		$view = ($_view_ext == '') ? $view.self::VIEW_FILE_EXT : $view;

		return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
	}
}