<?php

namespace App\Service\Impl;

use App\Dto\Search\CommonSearch;
use App\Exceptions\BusinessException;
use App\Repository\MenuRepository;
use App\Service\BaseService;
use App\Service\MenuService;
use Carbon\Carbon;

class MenuServiceImpl extends BaseService implements MenuService
{
  public function __construct(
    protected MenuRepository $menuRepository
  ) {
  }

  public function saveMenu($validData)
  {
    $this->validateSequenceMenu($validData["sequence"]);
    $menu = $this->getCreatedData();
    $menu["name"] = $validData["name"];
    $menu["sequence"] = $validData["sequence"];
    $menu["icon"] = $validData["icon"];
    $menu["url"] = $validData["url"];
    $menuSaved = $this->menuRepository->saveMenu($menu);
    return $this->buildSuccessResponse($menuSaved);
  }

  public function updateMenu($id, $validData)
  {
    $user = $this->getUserFromToken();
    $menu = $this->findMenuById($id);
    if ($menu["sequence"] !== $validData["sequence"]) {
      $this->validateSequenceMenu($validData["sequence"]);
    }
    $menu["name"] = $validData["name"];
    $menu["sequence"] = $validData["sequence"];
    $menu["icon"] = $validData["icon"];
    $menu["url"] = $validData["url"];
    $menu["updated_at"] = Carbon::now()->toDateTimeString();
    $menu["updated_by"] = $user["id"];
    $menu["updated_by_name"] = $user["name"];
    $this->menuRepository->updateMenu($menu);
    return $this->buildSuccessResponse($menu);
  }

  public function getMenuById($id)
  {
    return $this->buildSuccessResponse($this->findMenuById($id));
  }

  public function getMenuWithPagination(CommonSearch $search)
  {
    $menus = $this->menuRepository->getMenuWithPagination($search);
    return $this->buildSuccessResponse($menus);
  }

  public function getMenuWithoutPagination(CommonSearch $search)
  {
    $menus = $this->menuRepository->getMenuWithoutPagination($search);
    return $this->buildSuccessResponse($menus);
  }

  public function deleteMenu($id)
  {
    $user = $this->getUserFromToken();
    $menu = $this->findMenuById($id);
    $menu["id"] = $id;
    $menu["is_deleted"] = true;
    $menu["updated_at"] = Carbon::now()->toDateTimeString();
    $menu["updated_by"] = $user["id"];
    $menu["updated_by_name"] = $user["name"];
    $this->menuRepository->updateMenu($menu);
    return $this->buildSuccessResponse();
  }

  private function findMenuById($id)
  {
    $menu = $this->menuRepository->getMenuById($id);
    if ($menu === null) {
      throw new BusinessException(config("message.DATA_NOT_FOUND"), 400);
    }
    return $menu->getAttributes();
  }

  private function findMenuBySequence($sequence)
  {
    $menu = $this->menuRepository->getMenuBySequence($sequence);
    if ($menu === null) {
      return null;
    }
    return $menu->getAttributes();
  }

  private function validateSequenceMenu($sequence)
  {
    $menu = $this->findMenuBySequence($sequence);
    if ($menu !== null) {
      throw new BusinessException(config("message.MENU_WITH_SEQUENCE_ALREADY_EXIST"), 400);
    }
  }
}
