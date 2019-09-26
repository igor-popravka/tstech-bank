<?php

namespace App;

use App\Interfaces\IViewer;

/**
 * @author: igor.popravka
 * Date: 26.09.2019
 * Time: 15:03
 */
class HTTPViewer implements IViewer {
    private $template_folder;
    private $render_data;

    public function __construct(string $template_folder) {
        $this->template_folder = $template_folder;
    }

    public function render(string $template_name, array $render_data = []) {
        $template_path = $this->template_folder . $template_name . '.php';

        $this->render_data = $render_data;

        ob_start();

        include_once $this->template_folder . 'layers/header.php';

        if (file_exists($template_path)) {
            include_once $template_path;
        } else {
            include_once $this->template_folder . 'error.php';
        }

        include_once $this->template_folder . 'layers/footer.php';

        ob_end_flush();
    }

    public function __get($name) {
        if (isset($this->render_data[$name])) {
            return $this->render_data[$name];
        }
        return null;
    }
}