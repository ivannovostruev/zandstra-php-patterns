<?php

namespace patterns\Facade;

class Subsystem
{
    public function getProductFileLines(string $fileName): array
    {
        return file($fileName);
    }

    public function getProductObjectFromId(int $id, string $productName): Product
    {
        return new Product($id, $productName);
    }

    public function getNameFromLine(string $line): string
    {
        if (!preg_match("/.*-(.*)\s\d+/", $line, $matches)) {
            return '';
        }
        return mb_ereg_replace('_', ' ', $matches[1]);
    }

    public function getIdFromLine(string $line): int
    {
        if (!preg_match("/^(\d{1,3})-/", $line, $matches)) {
            return -1;
        }
        return (int) $matches[1];
    }
}
