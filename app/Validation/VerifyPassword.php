<?php

	namespace App\Validation;


	use Config\Services;
	use CodeIgniter\HTTP\RequestInterface;
	use App\Models\UserModel;
	

	/**
	 * 
	 */
	class VerifyPassword 
	{
		private $request;

		public function __construct(RequestInterface $request = null)
		{
			if (is_null($request))
			{
				$request = Services::request();
			}
			$this->request = $request;
		}
		public function verify($password) 
		{	
			$userModel = new UserModel();
			$user = $userModel->find(session()->get('user')['id']);
			$verify = password_verify($password, $user['password']);
    		if (!$verify) {
    			// return ['id'=> $user->id,'username'=> $user->username,'email'=> $user->email,'isLoggedIn'=> true];
    			return false;
    		} 
    		// else {
    		// 	return false;
    		// }
		}
	}
