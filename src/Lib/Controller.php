<?php

namespace Phphademic\Lib;

class Controller
{
    protected Table $table;

    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    public function getJson(Request $request): \Response
    {
        $id = $request->get('id');
        $entity = $this->table->get($id);

        return new Response($entity->toJson());
    }
}