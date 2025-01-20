<?php

namespace App\Controllers\Admin;

use App\Models\Admin\User;
use PHPFramework\Pagination;

class UserController extends BaseController
{

    public function index()
    {
        $page = (int)request()->get('page', 1);
        $total = db()->count('users');
        $per_page = 10;
        $pagination = new Pagination($page, $per_page, $total);
        $start = $pagination->getStart();
        $users = db()->query("SELECT * FROM users ORDER BY id LIMIT $start, $per_page")->get();
        $title = "List of users" . ($page > 1 ? " - Page {$page}" : '');
        return view('admin/users/index', compact('title', 'users', 'pagination'));
    }

	public function edit()
    {
        $id = request()->get('id');
        $user = db()->findOrFail('users', $id);
        return view('admin/users/edit', ['title' => 'Edit user ', 'user' => $user, 'errors' => session()->get('form_errors')]);
    }

	public function update()
    {
		$id = request()->post('id');
        $user = db()->findOrFail('users', $id);

        $model = new User();
        $model->loadData();
        $model->attributes['id'] = $id;

		$model->attributes['role'] = $model->attributes['role'] == 'admin' ? 1 : 0;

		if (isset($_FILES['avatar'])) {
            $model->attributes['image'] = $_FILES['avatar'];
        } else {
            $model->attributes['image'] = [];
        }

		if (isset($_FILES['avatar'])) {
            $model->attributes['image'] = $_FILES['avatar'];
        } else {
            $model->attributes['image'] = [];
        }

		// if (!$model->validate($model->attributes, [
        //     'title' => ['required' => true, 'max' => 255],
        //     'slug' => ['required' => true, 'max' => 255, 'unique' => 'posts:slug,id'],
        //     'excerpt' => ['required' => true, 'max' => 255],
        //     'content' => ['required' => true],
        //     'category_id' => ['required' => true],
        //     'image' => ['ext' => 'jpg|png'],
        // ])) {
        //     session()->set('form_errors', $model->getErrors());
        //     session()->setFlash('error', 'Validation errors');
        //     response()->redirect(base_url("/admin/posts/edit?id={$id}"));
        // }

        if ($model->updateUser()) {
            session()->setFlash('success', 'Post updated');
        } else {
            session()->setFlash('error', 'Error updating post');
        }
        response()->redirect(base_url("/admin/users/edit?id={$id}"));
    }

	public function delete()
    {
        $id = request()->get('id');
		db()->findOrFail('users', $id);
		db()->query("DELETE FROM users WHERE id = ?", [$id]);

        session()->setFlash('success', "User deleted");
        response()->redirect(base_url('/admin/users'));
    }

}