<?php 
	/**
	* HuyNV
	*/
	class Warehouse_model extends MY_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        $this->table = 'warehouses';
	    }
	}
 ?>