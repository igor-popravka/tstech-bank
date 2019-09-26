<?php

namespace App\Interfaces;

/**
 * @author: igor.popravka
 * Date: 26.09.2019
 * Time: 15:00
 */
interface IViewer {
    public function __construct(string $template_folder);

    public function render(string $template_name, array $render_data = []);
}