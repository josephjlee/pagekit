<?php

namespace Pagekit\Hello\Controller;

use Pagekit\Application as App;

/**
 * @Route("/")
 */
class SiteController
{
    /**
     * @Route("/", name="@hello/world")
     * @Route("/{name}", name="@hello/name")
     */
    public function indexAction($name = "World")
    {
        $names = explode(',', $name);

        return [
            '$view' => [
                'title' => __('Hello %name%', ['%name%' => $names[0]]),
                'name'  => 'hello:views/index.php'
            ],
            'names' => $names
        ];
    }

    /**
     * @Route("/greet", name="@hello/greet/world")
     * @Route("/greet/{name}", name="@hello/greet/name")
     */
    public function greetAction($name = 'World')
    {
        $names = explode(',', $name);

        return [
            '$view' => [
                'title' => __('Hello %name%', ['%name%' => $names[0]]),
                'name'  => 'hello:views/index.php'
            ],
            'names' => $names
        ];
    }

    public function redirectAction()
    {
        return App::response()->redirect('@hello/greet/name', ['name' => 'Someone']);
    }

    public function jsonAction()
    {
        $data = ['error' => true, 'message' => 'There is nothing here. Move along.'];

        return App::response()->json($data);
    }

    public function downloadAction()
    {
        return App::response()->download('extensions/hello/extension.svg');
    }

    function forbiddenAction()
    {
        return App::response(__('Permission denied.'), 401);
    }
}
