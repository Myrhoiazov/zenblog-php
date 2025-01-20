<?php

namespace App\Controllers\Admin;

use App\Models\Admin\Email;

class TasksController extends BaseController
{

    public function index()
    {
        return view('admin/tasks/index', 
			['title' => 'Tasks page', 
				'styles' => [ base_url('/assets/css/drag-n-drop.css') ], 
				'footer_scripts' => [ base_url('/assets/js/drag-n-drop.js')]]);
    }
}