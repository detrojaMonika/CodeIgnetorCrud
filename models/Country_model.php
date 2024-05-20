<?php
	class Country_model extends CI_model{
		function get_countries(){
			return $country = $this->db->get('country')->result_array();
		}

		function get_states_by_country($country_id) {
	        $query = $this->db->get_where('state', array('CountryId' => $country_id));
        	return $query->result();
	    }

	    function get_cities_by_state($state_id) {
	        $query = $this->db->get_where('city', array('StateId' => $state_id));
        	return $query->result();
	    }
	    
		// function get_states_by_country($country_id) {
	    //     $this->db->where('CountryId', $country_id);
	    //     $query = $this->db->get('state');
	    //     return  $query->result_array();
	    // }
	} 
?>