<?php
class AdminAppController extends AppController
{
    public $twig;
    function __construct() {
        parent::__construct();

        $loader = new \Twig\Loader\FilesystemLoader(CORE_ROOT_PATH . 'templates');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => TMP_ROOT_PATH . 'twig/compilation_cache',
        ]);
    }
}