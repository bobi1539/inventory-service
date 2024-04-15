<?php

namespace App\Repository;

use App\Dto\Search\CommonSearch;

interface MenuRepository
{
  public function saveMenu($menu);
  public function updateMenu($menu);
  public function getMenuById($id);
  public function getMenuBySequence($sequence);
  public function getMenuWithPagination(CommonSearch $search);
  public function getMenuWithoutPagination(CommonSearch $search);
}
