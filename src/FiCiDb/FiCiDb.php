<?php
namespace Engtuncay\PhpCiUtils\FiCiDb;

use CodeIgniter\Database\BaseConnection;

class FiCiDb {

  /**
   * @var BaseConnection|null
   */
  public ?BaseConnection $db = null;

  public function __construct(?BaseConnection $db = null)
  {
    if ($db !== null) {
      $this->db = $db;
    } else {
      // Database connection will be set when needed
      // Use setDb() method or CodeIgniter's database service
    }
  }

  /**
   * Set database connection
   */
  public function setDb(BaseConnection $db): self
  {
    $this->db = $db;
    return $this;
  }

  /**
   * Get database connection
   */
  public function getDb(): ?BaseConnection
  {
    return $this->db;
  }


}


?>