<?php 

	namespace App\Libraries;
	use Config\Services;

	class Permission1
	{    
		protected $permission;
		protected $module; 
		protected $redirect = "dashboard";
		protected $ci;
		protected $session = null;

		public function __construct()
		{
			$this->module = '';
			// $this->ci =& get_instance();
			$this->session = Services::session();
		}

	 
		public function access()
		{
			return $this->permission;
		}

		// public function redirect()
		// {  
		// 	if ($this->permission) { 
		// 		return $this->permission;
		// 	} else {
		// 		$this->session->setFlashData('error', "You do not have permission to access. Please contact with administrator.");
		// 		redirect($this->redirect);
		// 	}
		// }
		public function authorize($module)
		{
	    	return $module == "1" ? TRUE : FALSE;
		}

		public function module($module = null)
		{

			$module = (($module!=null)?strtolower($module):$this->ci->uri->segment(1));

			$this->module = $module;

			if ($this->checkModule($module)) {
				$this->permission = true;
			} else {
				$this->permission = false;
			} 
			return $this; 
		}

		public function method($module = null, $method = null)
		{
			$module = (($module!=null)?$module:$this->ci->uri->segment(1));
			// $module = (($module!=null)?strtolower($module):$this->ci->uri->segment(1));
			$method = strtolower($method);

			if ($this->checkMethod($module, $method)) {
				$this->permission = true;
			} else {
				$this->permission = false;
			} 
			return $this;
		}	

		public function create()
		{

			if ($this->checkMethod($this->module, 'create')) {
				$this->permission = true;
			} else {
				$this->permission = false;
			} 
			return $this;
		}
	 

		public function read()
		{   
			if ($this->checkMethod($this->module, 'read')) {
				$this->permission = true;
			} else {
				$this->permission = false;
			} 
			return $this;
		}

		public function update()
		{   
			if ($this->checkMethod($this->module, 'update')) {
				$this->permission = true;
			} else {
				$this->permission = false;
			} 
			return $this;
		}
	 
		public function delete()
		{   
			if ($this->checkMethod($this->module, 'delete')) {
				$this->permission = true;
			} else {
				$this->permission = false;
			} 
			return $this;
		}
		 
		protected function checkModule($module = null)
		{ 
			/*$permission = $this->ci->session->userdata('permission');
			$isAdmin    = $this->ci->session->userdata('isAdmin');
			$isLogIn    = $this->ci->session->userdata('isLogIn');*/
			$permission = session()->get('user')['permission'];
			$isAdmin 	= session()->get('user')['isAdmin'];
			$isLogIn 	= session()->get('user')['isLoggedIn'];

			if ($isLogIn && $isAdmin) { 
				return true;
			} else if($isLogIn) { 
				if (($permission!=null)) {
					$permission = json_decode($permission, true);
					//module list
					$modules = array_keys($permission);
					//check current module permission
					if ( in_array($module, $modules) ) {
						return true;  
					} else {
						return false;
					} 
				} else {
					return false;
				} 
			} else {
				return false;
			} 
		}


		protected function checkMethod($module = null, $method = null)
		{ 
			/*$permission = $this->ci->session->userdata('permission');
			$isAdmin    = $this->ci->session->userdata('isAdmin');
			$isLogIn    = $this->ci->session->userdata('isLogIn');*/

			$permission = session()->get('user')['permission'];
			$isAdmin 	= session()->get('user')['isAdmin'];
			$isLogIn 	= session()->get('user')['isLoggedIn'];

			if ($isLogIn && $isAdmin) {
				//action of administrator
				return true;
			} else if($isLogIn) {

				if (($permission!=null)) {
					$permission = json_decode($permission, true);
					// $permission = $permission;
					//module list
					$modules = array_keys($permission);
					//check current module permission
					if ( in_array($module, $modules) ) {

						//convert method to asoc
						$methodList = $permission[$module]; 
						$methods = array_keys($permission[$module]);

						//check for each input
						if (in_array(strtolower($method), $methods)) {
							if ($methodList[$method] == 1) {
								return true;
							} else {
								return false;
							}	

						} else {
							return false;
						} 

					} else {
						return false;
					} 
				} else {
					return false;
				}

			} else {
				return false;
			} 
		}
	}