<?php

namespace App\Repository\Impl;

use App\Dto\Search\CommonSearch;
use App\Models\Menu;
use App\Repository\BaseRepository;
use App\Repository\MenuRepository;

class MenuRepositoryImpl extends BaseRepository implements MenuRepository
{
  public function saveMenu($menu)
  {
    return Menu::create($menu);
  }

  public function updateMenu($menu)
  {
    return Menu::where("id", $menu["id"])
      ->update($menu);
  }

  public function getMenuById($id)
  {
    return Menu::where([
      ["id", "=", $id],
      ["is_deleted", "=", false]
    ])->first();
  }

  public function getMenuBySequence($sequence)
  {
    return Menu::where([
      ["sequence", "=", $sequence],
      ["is_deleted", "=", false]
    ])->first();
  }

  public function getMenuWithPagination(CommonSearch $search)
  {
    return Menu::where($this->isDeletedFalse())
      ->whereAny(
        ["name"],
        "like",
        "%" . $search->getSearch() . "%"
      )
      ->paginate($search->getSize())
      ->withQueryString();
  }

  public function getMenuWithoutPagination(CommonSearch $search)
  {
    return Menu::where($this->isDeletedFalse())
      ->whereAny(
        ["name"],
        "like",
        "%" . $search->getSearch() . "%"
      )->get();
  }
}
