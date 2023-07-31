<?php

namespace core;

class Controller
{
    public function view(string $view, array $data = []): void
    {
        extract($data);

        require_once "resources/views/" . $view . ".php";
    }

    public function redirect(string $location): void
    {
        header("location: http://localhost/academy_library/" . $location);
        exit();
    }

    public function viewWithTemplate(string $template, string $content, array $data = []): void
    {
        extract($data);

        $contentTemplate = file_get_contents("resources/templates/" . $template . ".php");

        $contentView = file_get_contents("resources/views/" . $content . ".php");

        $view = str_replace("{{content}}", $contentView, $contentTemplate);

        eval(' ?>' . $view . '<?php ');
    }
}
