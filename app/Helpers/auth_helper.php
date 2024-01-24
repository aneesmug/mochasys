<?php

	function loggedIn()
	{
		$user = session()->get('user');
		if ($user AND $user['isLoggedIn']) {
			return true;
		}
		return false;
	}

	function allowEdit($id)
	{
		$user = session()->get('user');
		if ($user AND $user['id'] === $id) {
			return true;
		}
		return false;
	}