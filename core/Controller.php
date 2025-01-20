<?php

namespace PHPFramework;

abstract class Controller
{

    public string $layout = LAYOUT;

    public function render($view, $data = [], $layout = ''): string
    {
        if (false !== $layout) {
            $layout = $layout ?: app()->layout;
        }

        return app()->view->render($view, $data, $layout);
    }

	public function getCsrfToken(): string
	{
		if (!session()->has('csrf_token') || (time() - session()->get('csrf_token_time') > 1800)) {
			session()->set('csrf_token', md5(uniqid(mt_rand(), true)));
			session()->set('csrf_token_time', time());
		}
		return session()->get('csrf_token');
	}

}