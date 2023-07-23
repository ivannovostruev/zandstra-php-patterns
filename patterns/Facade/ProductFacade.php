<?php

namespace patterns\Facade;

class ProductFacade
{
    /**
     * @var Product[]
     */
    private array $products = [];

    public function __construct(
        private readonly string $fileName
    ){
        $this->compile();
    }

    private function compile(): void
    {
        $subSystem = new Subsystem();
        $lines = $subSystem->getProductFileLines($this->fileName);
        foreach ($lines as $line) {
            $id = $subSystem->getIdFromLine($line);
            $name = $subSystem->getNameFromLine($line);
            $this->products[$id] = $subSystem->getProductObjectFromId($id, $name);
        }
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getProduct(int $id): ?Product
    {
        return $this->products[$id] ?? null;
    }
}
