<?php

namespace App\Http\Controllers;

use DummyFullModelClass;
use App\CategoryMenu;

class CategoryMenusController extends Controller
{
    public function getMenu($id)
    {
        $resp = $this->defaultGetRelationResult(CategoryMenu::class, $id, 'menu');

        return response()->json($resp->getData(), $resp->getCode());
    }

    public function getCategory($id)
    {
        $resp = $this->defaultGetRelationResult(CategoryMenu::class, $id, 'category');

        return response()->json($resp->getData(), $resp->getCode());
    }
}
