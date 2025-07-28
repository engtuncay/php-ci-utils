<?php

namespace Engtuncay\PhpCiUtils\FiCiDb;

use CodeIgniter\Database\BaseConnection;
use Engtuncay\Phputils8\FiDto\Fdr;
use Engtuncay\Phputils8\Pdo\FiQuery;

class FiCiDb
{

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

  public function sqlExecute(FiQuery $fiQuery): Fdr  //string $sql, ?array $fkbParams = null
  {
    $fdr = new Fdr();
    $fkbParams = $fiQuery->getFkbParams();

    //$stmt = $this->prepare($fiQuery->getSql());;
    //$boExec = null;

    $sql = $fiQuery->getSql();

    $query = $this->getDb()->query($sql, $fkbParams->getArr());

    // Query çalıştırma
    //$query = $db->query("SELECT * FROM users WHERE id = ?", [$userId]);

    // Hata kontrolü
    if ($query === false) {
      // Hata var
      $error = $this->getDb()->error();
      log_message('error', 'Database error: ' . $error['message']);
      $fdr->setBoExec(false);
      //$fdr->setBoResult(false);
      return $fdr;
    }

    // Sonuçları alma
    // $results = $query->getResult();        // Object array
    $results = $query->getResultArray();   // Associative array
    // $row = $query->getRow();              // Tek satır object
    // $rowArray = $query->getRowArray(); 

    //

    // if ($fkbParams != null) {
    //   $boExec = $stmt->execute($fkbParams->getParams());
    // } else {
    //   $boExec = $stmt->execute();
    // }

    $fdr->setBoExec(true);
    $fdr->setBoResult(true);
    // $fkbResult = FiKeybean::bui($stmt->fetch(PDO::FETCH_ASSOC));
    $fdr->setRefValue($results);
    // $fdr->setRefValue($fkbResult);

    return $fdr;
  }
}
