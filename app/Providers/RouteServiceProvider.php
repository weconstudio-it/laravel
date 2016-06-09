<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Weconstudio\Misc\U;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        $files = scandir(__DIR__ . '/../Models');
        foreach($files as $file) {
            if(!is_dir(__DIR__ . '/../Models/' . $file) and !strpos($file, "Query")) {
                $name = str_replace(".php", "", $file);
                $router->bind(strtolower(U::stringFromCamelCase($name)), function($value) use($name) {
                    $name = "\\App\\Models\\" . $name;
                    $query = $name . "Query";
                    $obj = call_user_func([$query, 'create'])->findPk($value);
                    if(!($obj instanceof $name)) throw new NotFoundHttpException();
                    return $obj;
                });
            }
        }

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $this->mapWebRoutes($router);

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function mapWebRoutes(Router $router)
    {
        $router->group([
            'namespace' => $this->namespace, 'middleware' => 'web',
        ], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
