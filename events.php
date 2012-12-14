<?php defined('BASEPATH') or exit('No direct script access allowed');

class Events_Overload
{
	protected $ci;

	public function __construct()
	{
		Events::register('public_controller', array($this, 'public_controller'));
	}

	public function public_controller()
	{
		$this->ci =& get_instance();
		$this->ci->load->helper('url');

		$module = $this->ci->router->fetch_module();
		$class  = $this->ci->router->fetch_class();
		$method = $this->ci->router->fetch_method();
		$uri    = uri_string();

		// Get the overload records and check
		$query = $this->ci->db->get('overload');

		foreach ($query->result() as $overload)
		{
			if ($overload->route)
			{
				// Convert wild-cards to RegEx
				$route = str_replace(array(':any', ':num'), array('.+', '[0-9]+'), $overload->route);

				// Does the RegEx match?
				if ( ! preg_match('#^'.$route.'$#', $uri))
					continue;
			}

			// Check if we have a match
			if ($overload->module AND $overload->module != $module)
				continue;

			if ($overload->class AND $overload->class != $class)
				continue;

			if ($overload->method AND $overload->method != $method)
				continue;

			// Now lets append to the template
			$this->ci->template->set(unserialize($overload->data));
			
			if ($overload->js)
				$this->ci->template->append_metadata('<script type="text/javascript">' . $overload->js . '</script>');

			if ($overload->css)
				$this->ci->template->append_metadata('<style type="text/css">' . $overload->css . '</style>');
		}
	}
}