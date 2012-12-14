<?php

class Admin extends Admin_Controller
{
	public $section = 'overloads';

	private $validation_rules = array(
		array(
			'field' => 'title',
			'label' => 'title',
			'rules' => 'required'
		),
		array(
			'field' => 'module',
			'label' => 'module',
			'rules' => 'callback__valid_module'
		),
	);

	public function __construct()
	{
		parent::__construct();

		$this->load->model('overload_m');
		$this->lang->load('overload');
	}

	public function index()
	{
		$data['records'] = $this->overload_m->records();

		$this->template->build('table', $data);
	}

	public function create()
	{
		$this->edit();
	}

	public function edit($id = FALSE)
	{
		$this->form_validation->set_rules($this->validation_rules);

		if ($this->form_validation->run())
		{
			if ($this->overload_m->insert_update($id))
			{
				$this->session->set_flashdata('success', 'Overload added/edited successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'There was an error inserting/updating your overload');
			}

			redirect('admin/overload');
		}
		else
		{
			$modules[''] = '-- Any module --';

			foreach ($this->overload_m->modules() as $module)
			{
				$modules[$module->slug] = $module->name;
			}

			$record = $id ? $this->overload_m->get($id) : array();

			$this->template->append_css('module::overload.css')
						   ->append_js('module::overload.js')
						   ->set('modules_list', $modules)
						   ->build('form', $record);
		}
	}

	public function _valid_module($value)
	{
		$count = $this->db->where('slug', $value)
						  ->where('enabled', 1)
						  ->where('installed', 1)
						  ->count_all_results('modules');
		if ($count)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('_valid_module', 'Invalid module specified');
		}
		
	}

	public function delete($id = FALSE)
	{
		if ( ! $id AND $this->input->post('action_to'))
		{
			foreach ($this->input->post('action_to') as $id)
			{
				$this->delete($id);
			}

			$this->session->set_flashdata('success', 'The selected overloads were deleted successfully');
		}
		else
		{
			$this->db->delete('overload', array(
				'id' => $id
			));

			$this->session->set_flashdata('success', 'Overload deleted successfully');
		}

		redirect('admin/overload');
	}
}