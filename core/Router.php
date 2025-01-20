<?php

namespace PHPFramework;

class Router
{

    public Request $request;
    public Response $response;
    protected array $routes = [];
    public array $route_params = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function add($path, $callback, $method): self
    {
        $path = trim($path, '/');
        if (is_array($method)) {
            $method = array_map('strtoupper', $method);
        } else {
            $method = [strtoupper($method)];
        }

        $this->routes[] = [
            'path' => "/{$path}",
            'callback' => $callback,
            'middleware' => null,
            'method' => $method,
            'needCsrfToken' => true,
        ];

        return $this;
    }

    public function get($path, $callback): self
    {
        return $this->add($path, $callback, 'GET');
    }

    public function post($path, $callback): self
    {
        return $this->add($path, $callback, 'POST');
    }

    public function dispatch(): mixed
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->matchRoute($method, $path);

        if (false === $callback) {
            abort();
        }
        if (is_array($callback['callback'])) {
            $callback['callback'][0] = new $callback['callback'][0];
            app()->layout = $callback['callback'][0]->layout ?? LAYOUT;
        }
        return call_user_func($callback['callback']);
    }

    protected function matchRoute($method, $path)
    {
        foreach ($this->routes as $route) {
            if ((preg_match("#^{$route['path']}$#", "/{$path}", $matches)) && (in_array($this->request->getMethod(), $route['method']))) {

                if ($route['middleware']) {
                    $middleware = MIDDLEWARE[$route['middleware']] ?? false;
                    if ($middleware) {
                        (new $middleware)->handle();
                    }
                }

				
				if (request()->isPost()) {
					if ($route['needCsrfToken'] && !$this->checkCsrfToken()) {
                        if (request()->isAjax()) {
                            echo json_encode([
                                'status' => 'error',
                                'data' => 'Security error',
								'body' => $_POST
                            ]);
                            die;
                        } else {
                            abort('Page expired', 419);
                        }
                    }
                }

                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $this->route_params[$k] = $v;
                    }
                }
                return $route;

            }
        }
        return false;
    }

    public function only($middleware): self
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $middleware;
        return $this;
    }

	public function checkCsrfToken(): bool
    {
        return request()->post('csrf_token') && (request()->post('csrf_token') == session()->get('csrf_token'));
    }

	public function withoutCsrfToken(): self
    {
        $this->routes[array_key_last($this->routes)]['needCsrfToken'] = false;
        return $this;
    }
}