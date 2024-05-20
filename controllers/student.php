<?php
	class Student extends CI_Controller{
		function index(){
			
			$this->load->model('Student_model');

			$data=array();
			$students = $this->Student_model->all();

			$data['students'] = $students;

			$this->load->view('select',$data);
		}
		function create(){
			$this->load->model('Student_model');
			$data=array();
			$this->load->model('Country_model');
			$data['countries'] = $this->Country_model->get_countries();

			$this->form_validation->set_rules('first_name', 'First Name', 'required');
	        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
	        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
	        $this->form_validation->set_rules('country', 'Country', 'required');
	        $this->form_validation->set_rules('state', 'State', 'required');
	        $this->form_validation->set_rules('city', 'City', 'required');

	        if ($this->form_validation->run() == FALSE) {
	        	$data['country'] = $this->input->post('country');
	        	$data['state'] = $this->input->post('state');
	        	$data['city'] = $this->input->post('city');
	            $this->load->view('create',$data);
	        }
	        else {
	            
	            $formArray=array();
	            $formArray['FirstName'] = $this->input->post('first_name');
	            $formArray['LastName'] = $this->input->post('last_name');
	            $formArray['Email'] = $this->input->post('email');
	            $formArray['Country'] = $this->input->post('country');
	            $formArray['State'] = $this->input->post('state');
	            $formArray['City'] = $this->input->post('city');

	            $this->Student_model->create($formArray);
	            $this->session->set_flashdata('success','Record Inserted Sucessfully');
	            redirect(base_url().'index.php/student/index');
	        }
		}

		function update($Id){
			
			$this->load->model('Student_model');
			$this->load->model('Country_model');
			$student = $this->Student_model->getStudent($Id);
			$countries = $this->Country_model->get_countries();
			$data = array();
			$data['student'] = $student;

			$data['countries'] = $countries;

			$this->form_validation->set_rules('first_name', 'First Name', 'required');
	        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
	        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
	        $this->form_validation->set_rules('country', 'Country', 'required');
	        $this->form_validation->set_rules('state', 'State', 'required');
	        $this->form_validation->set_rules('city', 'City', 'required');

	        if ($this->form_validation->run() == FALSE) {
	        	
	            $this->load->view('update',$data);
	        }
	        else {
	            
	            $formArray=array();
	            $formArray['FirstName'] = $this->input->post('first_name');
	            $formArray['LastName'] = $this->input->post('last_name');
	            $formArray['Email'] = $this->input->post('email');
	            $formArray['Country'] = $this->input->post('country');
	            $formArray['State'] = $this->input->post('state');
	            $formArray['City'] = $this->input->post('city');

	            $this->Student_model->update($Id,$formArray);
	            $this->session->set_flashdata('success','Record Updated Sucessfully');
	            redirect(base_url().'index.php/student/index');
	        }
		}

		function delete($Id){
			$this->load->model('Student_model');
			$getstudent = $this->Student_model->getStudent($Id);
			if(empty($getstudent)){
				$this->session->set_flashdata('failure','Record not found in database');
				redirect(base_url().'index.php/student/index');
			}
			
			$this->Student_model->delete($Id);
			$this->session->set_flashdata('success','Record deleted successfully');
			redirect(base_url().'index.php/student/index');
		}

		function get_states_by_country(){

			$this->load->model('Country_model');

	        $country_id = $this->input->post('country_id');
	        $states = $this->Country_model->get_states_by_country($country_id);

	        echo json_encode($states);
		}

		function get_cities_by_state(){
			$this->load->model('Country_model');

	        $state_id = $this->input->post('state_id');
	        $cities = $this->Country_model->get_cities_by_state($state_id);

	        echo json_encode($cities);
		}

		function get_students() {
			$this->load->model('Student_model');
	        $students = $this->Student_model->all();
	        echo json_encode(['data' => $students]);
	    }
	}
?>