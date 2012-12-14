<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Overload extends Module
{
	public $version = '1.0.0';

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Overload'
			),
			'description' => array(
				'en' => 'Overload ANYTHING!'
			),
			'sections' => array(
				'overloads'	=> array(
					'name'	=> 'Overloads',
					'uri'	=> 'admin/overload',
					'shortcuts' => array(
						'create' => array(
							'name' 	=> 'overload:shortcuts:create',
							'uri' 	=> 'admin/overload/create',
							'class' => 'add'
						)
					)
				)
			),
			'frontend' => FALSE,
			'backend' => TRUE,
			'author' => 'Chris Harvey',
			'menu' => 'content'
		);

		return $info;
	}

	public function install()
	{
		$this->db->query("
			CREATE TABLE IF NOT EXISTS `" . $this->db->dbprefix('overload') . "` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `title` varchar(255) NOT NULL,
			  `route` varchar(255) DEFAULT NULL,
			  `module` varchar(100) DEFAULT NULL,
			  `class` varchar(100) DEFAULT NULL,
			  `method` varchar(100) DEFAULT NULL,
			  `enable_parser` tinyint(1) DEFAULT NULL,
			  `enable_parser_body` tinyint(1) DEFAULT NULL,
			  `enable_minify` tinyint(1) DEFAULT NULL,
			  `theme` varchar(50) DEFAULT NULL,
			  `layout` varchar(50) DEFAULT NULL,
			  `css` longtext,
			  `js` longtext,
			  `data` longtext,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
		");

		return TRUE;
	}

	public function uninstall()
	{
		$this->dbforge->drop_table('overload');

		return TRUE;
	}
	
	public function upgrade($old_version)
	{
		return TRUE;
	}

	public function help()
	{
		return 'Help';
	}

}