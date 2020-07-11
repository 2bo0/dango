<?php
class AdminTopController extends AdminAppController
{
    public function index() {
        echo "admin top page.";

        $template = $this->twig->load('admin/sample.html.twig');
        $data = array(
            'title' => 'sample',
            'message'  => 'My Webpage11!',
        );
        echo $template->render($data);
    }
}