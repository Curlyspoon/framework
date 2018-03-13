<?php

namespace Curlyspoon\Framework\Http\Responses;

use Illuminate\Http\Response;
use Curlyspoon\Framework\Libs\Menu;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Curlyspoon\Framework\Contracts\ElementManager as ElementManagerContract;

class PageResponse extends Response
{
    protected $pageName;

    public function __construct(string $name, int $status = 200, array $headers = [])
    {
        $this->pageName = $name;

        app('view')->share([
            'response' => $this,
            'elements' => app(ElementManagerContract::class),
        ]);

        parent::__construct($this->render(), $status, $headers);
    }

    public function pageFileContent(string $filename): string
    {
        $filepath = $this->pagePath().'/'.$filename;

        if (! file_exists($filepath)) {
            $this->notFound(sprintf('file [%s] does not exist', $filepath));
        }
        if (! is_file($filepath)) {
            $this->notFound(sprintf('file [%s] is not a file', $filepath));
        }
        if (! is_readable($filepath)) {
            $this->notFound(sprintf('file [%s] is not readable', $filepath));
        }

        return file_get_contents($filepath);
    }

    protected function render(): View
    {
        $content = json_decode($this->pageFileContent('_content.json'), true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            $this->notFound('no valid content.json');
        }

        $menu = Menu::fromFile(resource_path('pages/menu.json'));

        return view('curlyspoon::page', [
            'title' => $menu->getCurrentLabel(),
            'menu' => $menu,
            'content' => $content,
        ]);
    }

    protected function pagePath(): string
    {
        $path = resource_path('pages/'.$this->pageName);

        if (! file_exists($path)) {
            $this->notFound('folder does not exist');
        }
        if (! is_dir($path)) {
            $this->notFound('folder is not a directory');
        }

        return $path;
    }

    protected function notFound(string $reason)
    {
        throw new NotFoundHttpException(sprintf('Page [%s] not found: %s.', $this->pageName, $reason));
    }
}
