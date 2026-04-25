<?php

namespace Database\Helpers;

use Database\MySQLWrapper;

class UrlHandler{
    public static function createBaseUrl(string $path, ?string $hostname = null): string{
        $hostname = $hostname??(new MySQLWrapper())->getDatabaseName();
        $uuid = bin2hex(random_bytes(2));
        return "http://{$hostname}/?path={$path}&id={$uuid}";
    }

    public static function extractUrl(string $url): array {
        var_dump(parse_url($url));
        if(parse_url($url) === false){
            throw new \InvalidArgumentException("The provided URL is not valid.");
        }
        return parse_url($url);
    }
}