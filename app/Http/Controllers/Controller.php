<?php

namespace App\Http\Controllers;

use App\Dto\Search\CommonSearch;
use Illuminate\Http\Request;

abstract class Controller
{
    protected function getSearch(Request $request)
    {
        $search = $this->getQueryParam($request, "search");
        $page = $this->getQueryParam($request, "page");
        $size = $this->getQueryParam($request, "size");

        return new CommonSearch($search, $page, $size);
    }

    protected function getQueryParam(Request $request, $paramName)
    {
        if ($request->has($paramName)) {
            return $request->get($paramName);
        }
        return "";
    }
}
