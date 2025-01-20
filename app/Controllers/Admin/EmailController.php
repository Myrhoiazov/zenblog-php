<?php

namespace App\Controllers\Admin;

use App\Models\Admin\Email;

class EmailController extends BaseController
{

    public function index()
    {
        return view('admin/email/index', 
			['title' => 'Emails page', 
				'styles' => [ base_url('/assets/css/email.css') ], 
				'footer_scripts' => [ base_url('/assets/js/email.js'), "https://cdn.jsdelivr.net/npm/sweetalert2@11" ]]);
    }

    public function store()
    {

		$model = new Email();
        $model->loadData();

		if (isset($_FILES['attachment'])) {
            $model->attributes['image'] = $_FILES['attachment'];
        } else {
			$model->attributes['image'] = [];
        }

		$file_path = $model->saveImage(false, true);
		$attachments = [];

		if($file_path){
			$attachments[] = $file_path;
		}

		if (request()->isAjax()) {

            // if (!$model->validate()) {
            //     echo json_encode(['status' => 'error', 'data' => $model->listErrors()]);
            //     die;
            // }

			$attributes = $model->attributes;
			extract($attributes);

			if($email){
				send_mail([$email],
				'test email Ajax post form',
				'admin/email/templates/test',
				compact('name', 'message'),
				$attachments);

				echo json_encode(['status' => 'success', 'data' => $attributes]);
				die;
			}

        }

		$attributes = $model->attributes;
		extract($attributes);

		if($email){
			$sent = send_mail([$email],
				'test email php post form',
				'admin/email/templates/test',
				compact('name', 'message'),
				$attachments);

				if($sent){
					session()->setFlash('success', "Email created");
				}
		}

        return view('admin/email/index', ['title' => 'Emails page', 
					'styles' => [ base_url('/assets/css/email.css') ], 
					'footer_scripts' => [ base_url('/assets/js/email.js', "https://cdn.jsdelivr.net/npm/sweetalert2@11") ]]);
    }
}