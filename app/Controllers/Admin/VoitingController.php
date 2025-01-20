<?php

namespace App\Controllers\Admin;

class VoitingController extends BaseController
{

	
	public function index()
    {
		$ip_client = $_SERVER['REMOTE_ADDR'];
		$this->title = 'Voiting page';

		$query = "SELECT users.name, users.avatar, users.id, voiting.status, voiting.voutes, voiting.ip_address
		FROM users 
		LEFT JOIN voiting ON users.id = voiting.user_id ORDER BY voiting.voutes DESC";

        $users = db()->query($query)->get();
		$newUsers = [];

		if($users){
			foreach ($users as $i => $user) {
				$user['class'] = $user['ip_address'] == $ip_client ? 'active' : '';
				$newUsers[] = $user;
			}

		} else{
			$users = [];
		}

        return view('admin/voiting/index',
			['title' => $this->title,
				'users' => $newUsers,
				'styles' => [ ], 
				'footer_scripts' => []]);
    }
    public function update()
    {
		$gid = $_POST['gid'];
		$ip_client = $_SERVER['REMOTE_ADDR'];

		$query = "SELECT * FROM voiting WHERE voiting.ip_address = ?";
        $user = db()->query($query, [$ip_client])->getOne();

		if($user){
			session()->setFlash('error', 'You already did it');
			return $this->index();
		} else{
			$query = "SELECT users.id, voiting.status, voiting.voutes, voiting.ip_address 
			FROM users JOIN voiting ON users.id = voiting.user_id WHERE users.id = ?;";

			$currentUser = db()->query($query, [$gid])->getOne();

			if($currentUser){
				$voutes = $currentUser['voutes'] ? $currentUser['voutes'] + 1 : 1;
				db()->query("INSERT INTO voiting (voutes, status, user_id, ip_address) VALUES (?,?,?,?)", [$voutes, 1, $gid, $ip_client]);

			} else{
				db()->query("INSERT INTO voiting (voutes, status, user_id, ip_address) VALUES (?,?,?,?)", [1, 1, $gid, $ip_client]);
			}
			
		}
		
		return $this->index();
	}
}