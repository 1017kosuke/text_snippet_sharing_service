<?php


namespace Response\Render;

use Response\HTTPRenderer;

class HTMLRenderer implements HTTPRenderer {
    private string $viewFields;
    private array $data;

    public function __construct(string $viewFields, array $data) {
        $this->viewFields = $viewFields;
        $this->data = $data;
    }

    public function getFields(): array {
        return ['Content-Type' => 'text/html; charset=UTF-8'];
    }

    public function getContent(): string {
        $viewPath = $this-> getViewPath($this->viewFields);

        if(!file_exists($viewPath)) {
            throw new \Exception("View file not found: $viewPath");
        }

        ob_start();
        extract($this->data);
        require $viewPath;
        return $this-> getHeader(). ob_get_clean() .$this->getFooter();
    }

    public function getHeader(): string {
        ob_start();
        require $this->getViewPath('layout/header');
        return ob_get_clean();
    }

    public function getFooter():string {
        ob_start();
        require $this->getViewPath('layout/footer');
        return ob_get_clean();
    }

    public function getViewPath(string $viewFields): string {
        return __DIR__ . '/../../views/' . $viewFields . '.php';
    }
}