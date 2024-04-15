<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Service\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct(
        protected MenuService $menuService
    ) {
    }

    public function saveMenu(Request $request)
    {
        $validData = $this->validateMenuRequest($request);
        return $this->menuService->saveMenu($validData);
    }

    public function updateMenu(Request $request)
    {
        $id = $this->getMenuId($request);
        $validData = $this->validateMenuRequest($request);
        return $this->menuService->updateMenu($id, $validData);
    }

    public function getMenuById(Request $request)
    {
        $id = $this->getMenuId($request);
        return $this->menuService->getMenuById($id);
    }

    public function getMenuWithPagination(Request $request)
    {
        $search = $this->getSearch($request);
        return $this->menuService->getMenuWithPagination($search);
    }

    public function getMenuWithoutPagination(Request $request)
    {
        $search = $this->getSearch($request);
        return $this->menuService->getMenuWithoutPagination($search);
    }

    public function deleteMenu(Request $request)
    {
        $id = $this->getMenuId($request);
        return $this->menuService->deleteMenu($id);
    }

    private function validateMenuRequest(Request $request)
    {
        return $request->validate(
            $this->getRules(),
            $this->getValidationMessage()
        );
    }

    private function getRules()
    {
        return [
            "name" => ["required"],
            "sequence" => ["required"],
            "icon" => ["required"],
            "url" => ["required"],
        ];
    }

    private function getValidationMessage()
    {
        return [
            "name.required" => config("message.NAME_IS_REQUIRED"),
            "sequence.required" => config("message.SEQUENCE_IS_REQUIRED"),
            "icon.required" => config("message.ICON_IS_REQUIRED"),
            "url.required" => config("message.URL_IS_REQUIRED"),
        ];
    }

    private function getMenuId(Request $request)
    {
        return Helper::getPathVariable($request->getRequestUri());
    }
}
