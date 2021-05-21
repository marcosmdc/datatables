<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function getDatos()
	{
		$this->load->database();
		$this->load->model('Datatable_model');
		$list = $this->Datatable_model->getDatos();
                $datas = array();
                foreach ($list as $data) {
                    $row = array();
            
					$row[] = $data->id_producto;
                    $row[] = $data->id_producto;
                    $row[] = $data->descripcion;
					$row[] = $data->id_producto * 5;
                    $datas[] = $row;
                }

				$output = array(
                    "draw" =>  $_POST['draw'],
                    "recordsTotal" => $this->Datatable_model->count_all(),
                    "recordsFiltered" => $this->Datatable_model->count_filtered(),
                    "data" => $datas,
                );

                echo json_encode($output);
		}
}
