<?php

namespace App\Service;

use App\Dto\Search\CommonSearch;

interface MenuService
{
  public function saveMenu($validData);
  public function updateMenu($id, $validData);
  public function getMenuById($id);
  public function getMenuWithPagination(CommonSearch $search);
  public function getMenuWithoutPagination(CommonSearch $search);
  public function deleteMenu($id);
}
