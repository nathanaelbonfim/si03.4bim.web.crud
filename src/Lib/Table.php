<?php

namespace PHPhademic\Lib;

interface Table
{
    public function create(Entity $entity): Entity;

    public function get(int $id): Entity;

    public function find(array $parameters): array;

    public function update(Entity $entity): bool;

    public function delete(int $id): bool;
}