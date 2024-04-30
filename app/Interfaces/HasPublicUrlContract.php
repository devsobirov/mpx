<?php


namespace App\Interfaces;


interface HasPublicUrlContract
{
    public function getUrlParams(): array;

    public function getFullUrl(...$args): string;
}
