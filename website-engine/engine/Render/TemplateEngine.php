<?php

declare(strict_types=1);

namespace Engine\Render;

final class TemplateEngine
{
    public function __construct(private readonly string $templatesPath)
    {
    }

    public function renderLayout(string $layout, array $data): string
    {
        return $this->renderFile("{$this->templatesPath}/layouts/{$layout}.php", $data);
    }

    public function renderComponent(string $name, array $data): string
    {
        return $this->renderFile("{$this->templatesPath}/components/{$name}.php", $data);
    }

    private function renderFile(string $path, array $data): string
    {
        if (!is_file($path)) {
            return '';
        }

        extract($data, EXTR_SKIP);
        $engine = $this;

        ob_start();
        include $path;

        return (string) ob_get_clean();
    }
}
