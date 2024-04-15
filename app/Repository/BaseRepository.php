<?php

namespace App\Repository;

abstract class BaseRepository
{
  protected function isDeletedFalse()
  {
    return [
      ["is_deleted", "=", false]
    ];
  }
}
