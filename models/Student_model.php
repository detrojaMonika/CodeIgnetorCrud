<?php
	class Student_model extends CI_model{
		function create($fromArray){
			$this->db->insert('student',$fromArray);
		}
		function all(){
			$this->db->select('student.*, country.CountryName, state.StateName, city.CityName');
		    $this->db->from('student');
		    $this->db->join('country', 'country.CountryId = student.Country');
		    $this->db->join('state', 'state.StateId = student.State');
		    $this->db->join('city', 'city.CityId = student.City');
		    $this->db->order_by('Id', 'ASC');
    		$students = $this->db->get();
    
    		return $students->result_array();
		}
		
		function getStudent($Id){
			$this->db->where('Id',$Id);
			return $student = $this->db->get('student')->row_array();
		}
		function delete($Id){
			$this->db->where('Id',$Id);
			$this->db->delete('student');
		}
		function update($Id,$formArray){
			$this->db->where('Id',$Id);
			$this->db->update('student',$formArray);
		}
	}
?>