<?php 
	
	namespace App\Filters;

	use CodeIgniter\Filters\FilterInterface;
	use CodeIgniter\HTTP\RequestInterface;
	use CodeIgniter\HTTP\ResponseInterface;
	// use Config\Services;

	class LoggedIn implements FilterInterface
	{
		public function before(RequestInterface $request, $arguments = null)
		{
			// $user = Services::session()->get('user');
			$user = session()->get('user');
	    	if (!$user OR !$user['isLoggedIn']) {
		    	session()->setFlashData('message',' You are not LoggedIn');
				return redirect()->to(base_url('/login'));
	    	}
		}

		public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
		{

		}

	}
	

