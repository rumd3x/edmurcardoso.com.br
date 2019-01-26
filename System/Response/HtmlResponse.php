<?php
namespace EasyRest\System\Response;

use EasyRest\System\Exceptions\InvalidFileException;
use Tightenco\Collect\Support\Collection;
use EasyRest\System\Exceptions\InvalidParameterException;

class HtmlResponse extends Response
{
    private $file;
    private $data;

    public function __construct(string $filename)
    {
        $this->file = $this->searchFile($filename);
        $this->data = [];
    }

    public function print()
    {
        return file_get_contents($this->file);
    }

    protected function send()
    {
        header('Content-Type: text/html; charset=utf-8');

        if (strtolower($this->getFileExtension($this->file)) === 'php') {
            extract($this->data);
            include $this->file;
            return;
        }

        parent::send();
    }

    /**
     * @param array $data
     * @return self
     */
    public function withData($data)
    {
        if ($data instanceof Collection) {
            $data = $data->all();
        }

        if (!is_array($data)) {
            throw new InvalidParameterException('data', 'Array or Collection');
        }

        $this->data = $data;
        return $this;
    }

    private function searchFile(string $filename)
    {
        if (is_file($filename)) {
            return $filename;
        }

        $viewDir = realpath(__DIR__.'/../../App/Views/');
        $filename = trim($filename, '/');
        if (is_file($viewDir.'/'.$filename)) {
            return $viewDir.'/'.$filename;
        }

        if (is_file($viewDir.'/'.$filename.'.php')) {
            return $viewDir.'/'.$filename.'.php';
        }

        if (is_file($viewDir.'/'.$filename.'.html')) {
            return $viewDir.'/'.$filename.'.html';
        }

        throw new InvalidFileException("Is not a valid View", $filename);
    }

    private function getFileExtension(string $filename)
    {
        $parts = explode('.', $filename);
        $partQty = count($parts);
        $lastPart = $parts[$partQty-1];
        return $lastPart;
    }
}
