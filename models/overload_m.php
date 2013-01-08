<?php

class Overload_m extends MY_Model
{
	public function records()
	{
		$query = $this->db->get('overload');

		if ($query->num_rows())
		{
			return $query->result_array();
		}

		return array();
	}

	public function get($id)
	{
		$query = $this->db->get_where('overload', array(
			'id' => $id
		));

		if ($query->num_rows())
		{
			$data = $query->row_array();

			$data['meta'] = unserialize($data['meta']);
			$data['data'] = unserialize($data['data']);

			return $data;
		}

		return FALSE;
	}

	public function insert_update($overload_id = FALSE)
	{
		$data = array();

		foreach (array('meta', 'data') as $process)
		{
			$$process = array();

			$values[$process] = $this->input->post("{$process}_value");

			foreach ($this->input->post("{$process}_key") as $id => $key)
			{
				if ( ! empty($key))
					${$process}[$key] = $values[$process][$id];
			}
		}

		$insert_data = array(
			'title'  => $this->input->post('title'),
			'route'  => $this->input->post('route'),
			'module' => $this->input->post('module'),
			'class'  => $this->input->post('class'),
			'method' => $this->input->post('method'),

			'enable_parser'      => $this->input->post('enable_parser'),
			'enable_parser_body' => $this->input->post('enable_parser_body'),
			'enable_minify'      => $this->input->post('enable_minify'),

			'theme'  => $this->input->post('theme'),
			'layout' => $this->input->post('layout'),
			'css'    => html_entity_decode($this->input->post('css', FALSE)),
			'js'     => html_entity_decode($this->input->post('js', FALSE)),
			'meta'   => serialize($meta),
			'data'   => serialize($data)
		);

		if ($overload_id)
		{
			return $this->db->update('overload', $insert_data, array(
				'id' => $overload_id
			));
		}
		else
		{
			return $this->db->insert('overload', $insert_data);
		}
	}

	public function modules()
	{
		$query = $this->db->select('name, slug')->get_where('modules', array(
			'enabled'     => 1,
			'installed'   => 1
		));	

		if ($query->num_rows())
		{
			$modules = $query->result();

			foreach ($modules as &$module)
			{
				$name = unserialize($module->name);

				$module->name = isset($name[CURRENT_LANGUAGE]) ? $name[CURRENT_LANGUAGE] : $name['en'];
			}

			return $modules;
		}
	}
}