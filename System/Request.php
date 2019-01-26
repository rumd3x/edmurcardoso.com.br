<?php
namespace EasyRest\System;

use Josantonius\Url\Url;
use Tightenco\Collect\Support\Collection;

final class Request
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var Collection
     */
    public $route;

    /**
     * @var Collection
     */
    public $payload;

    /**
     * @var Collection
     */
    public $query;

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->route = collect(explode('/', Url::getUriMethods()))->filter(function ($value) {
            return $value !== '';
        });

        $this->payload = collect(array_diff($_REQUEST, $_GET));
        $this->query = collect([]);
        $url = parse_url($_SERVER['REQUEST_URI']);
        if (isset($url['query'])) {
            $result = [];
            parse_str($url['query'], $result);
            $this->query = collect($result);
        }
    }

    /**
     * Adds Access-Control-Allow-Origin header to Request
     *
     * @param string $domain
     * @return void
     */
    public function setAccessControlOriginDomain(string $domain)
    {
        header("Access-Control-Allow-Origin: $domain");
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return strtoupper($this->method);
    }

    /**
     * @return Collection
     */
    public function all()
    {
        $all = collect([]);
        $all = $all->merge($this->payload);
        $all = $all->merge($this->query);
        return $all;
    }
}
