<?php

namespace Engtuncay\PhpCiUtils\FiCiDb;

use CodeIgniter\Database\BaseConnection;

abstract class AbsRepoCi
{
  protected ?string $connProfile = null;

  protected ?BaseConnection $db = null;

  public function __construct(string $connProfile = null)
  {
    $this->connProfile = $connProfile;

    $this->db =  $this->getDbObject();
  }

  function getDbObject(): ?BaseConnection
  {
    // You should implement the logic to return a BaseConnection instance.
    // For now, return null or throw an exception if not implemented.
    return null;
  }
}
