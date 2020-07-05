<?php
class AdminTopController extends AdminAppController
{
    public function index() {
        echo "admin top page.";

        $loader = new \Twig\Loader\FilesystemLoader(APP_ROOT_PATH . 'templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => TMP_ROOT_PATH . 'twig/compilation_cache',
        ]);
        $template = $twig->load('admin/sample.html.twig');
        $data = array(
            'title' => 'sample',
            'message'  => 'My Webpage1!',
        );
        echo $template->render($data);
    }
}