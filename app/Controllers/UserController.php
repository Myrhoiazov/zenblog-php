<?php

namespace App\Controllers;

use App\Models\User;
use PHPFramework\Auth;
use Service\Email;

class UserController extends BaseController
{

    public string $layout = 'user';

    public function register()
    {

        if (request()->isPost()) {
            $model = new User();
            $model->loadData();
			
            if (isset($_FILES['avatar'])) {
                $model->attributes['avatar'] = $_FILES['avatar'];
            } else {
                $model->attributes['avatar'] = [];
            }

            if (!$model->validate()) {
                session()->set('form_data', $model->attributes);
                session()->set('form_errors', $model->getErrors());
                session()->setFlash('error', 'Validation errors');
                response()->redirect(base_url('/register'));
            }
			
            if ($model->saveUser()) {
				session()->setFlash('success', 'You have successfully registered');
                response()->redirect(LOGIN_PAGE);
            } else {
				session()->setFlash('error', 'Error registration');
            }
        }
        return view('users/register', ['title' => 'Register', 'errors' => session()->get('form_errors')]);
    }

    public function login()
    {
        if (request()->isPost()) {
            $model = new User();
            $model->loadData();
            if (!$model->validate($model->attributes, [
                'email' => ['required' => true],
                'password' => ['required' => true],
            ])) {
                echo json_encode(['status' => 'error', 'data' => $model->listErrors()]);
                die;
            }

            if ($model->auth()) {
                session()->setFlash('success', 'You have successfully logged');
                echo json_encode(['status' => 'success', 'data' => base_url('/')]);
            } else {
                echo json_encode(['status' => 'error', 'data' => 'Incorrect email or password']);
            }
			die;

            // /*$model = new User();
            // $model->loadData();
            // if (!$model->validate($model->attributes, [
            //     'email' => ['required' => true],
            //     'password' => ['required' => true],
            // ])) {
            //     return view('users/login', ['title' => 'Login', 'errors' => $model->getErrors()], 'user');
            // }

            // if ($model->auth()) {
            //     session()->setFlash('success', 'You have successfully logged');
            //     response()->redirect(base_url('/'));
            // } else {
            //     session()->setFlash('error', 'Incorrect email or password');
            //     response()->redirect(LOGIN_PAGE);
            // }*/
        }
        return view('users/login', ['title' => 'Login']);
    }
	
	public function auth()
    {
        $model = new User();
        $model->loadData();

        if (!$model->validate($model->attributes, [
            'required' => ['email', 'password'],
        ])) {
            echo json_encode(['status' => 'error', 'data' => $model->listErrors()]);
            die;
        }

        if (Auth::login([
            'email' => $model->attributes['email'],
            'password' => $model->attributes['password'],
        ])) {
            echo json_encode(['status' => 'success', 'data' => 'Success login', 'redirect' => base_url(LOGIN_PAGE)]);
        } else {
            echo json_encode(['status' => 'error', 'data' => 'Wrong email or password']);
        }
        die;
    }

    public function logout()
    {
        Auth::logout();
        response()->redirect(base_url('/'));
    }

	public function restorePassword()
	{
		$model = new User();
        $model->loadData();

		$email = $model->attributes['ressetPassword'] ?: '';

		if(empty($email)){
			session()->setFlash('error', 'Email cannot be empty');
            response()->redirect(LOGIN_PAGE);
		}

		$user = db()->query("SELECT * FROM users WHERE email = ? LIMIT 1", [$email])->getOne();

		if(!$user){
			session()->setFlash('error', 'You email not correct try again');
            response()->redirect(LOGIN_PAGE);
		}

		$token = md5(round(12));

		db()->query("UPDATE users SET verify_token = ? WHERE id = ? LIMIT 1", [$token, $user['id']]);


		if($email){

			(new Email)->send_mail([$email],
			'Resset your password',
			'admin/email/templates/ressetEmail',
			compact('name', 'token', 'email'));

			session()->setFlash('success', 'We sent you new password link');
		}

        return view('users/login', ['title' => 'Login']);
	}

	public function verifyToken()
	{

		if($_GET['token'] && $_GET['email']){
			$token = $_GET['token'] ?? null;
			$email = $_GET['email'] ?? null;
			// делаем логику достаем гыукы из юазы и сверяем его токин с тем что пришел
			session()->set('form_data', ['csrf_token_name' => $token]);
			response()->redirect(base_url('/update-password'));
		}

		return view('users/resset-password');

	}

	function update()
	{
		if(request()->isPost()){
			// do this
			$model = new User();
            $model->loadData();

			$attributes = $model->attributes;
			$token = $attributes['csrf_token_name'];

			$user = db()->query("SELECT * FROM users WHERE verify_token = ? LIMIT 1", [$token])->getOne();

			if(!is_array($user)){
				session()->setFlash('error', 'Try agane');
				session()->forget('csrf_token_name');
				return view('users/resset-password');
			}

			$newPassword = password_hash($model->attributes['password'], PASSWORD_DEFAULT);
        	unset($model->attributes['repassword']);

			db()->query("UPDATE users SET verify_token = ?, password = ? WHERE id = ?", [NULL, $newPassword, $user['id']]);

			session()->forget('csrf_token_name');
			session()->setFlash('success', 'Your password was update we will send on you email [add logic]');
			response()->redirect(LOGIN_PAGE);
		}

		return view('users/resset-password');
		
	}

}