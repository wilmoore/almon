<?php

/**
 * @copyright Copyright(c) 2013 Wil Moore III <wil.moore@wilmoore.com>
 * @license   MIT Licensed
 */

class Store {

  const SELECT_QUERY = "SELECT COUNT(ip) FROM failures WHERE ip = :ip";

  /**
   * PDO Connection Object
   *
   * @var PDO
   */

  private $db;

  /**
   * Initialize a SQLite database connection
   */

  function __construct() {
    $this->db = new PDO('sqlite:/tmp/asterisk.sqlite3');

    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // create table if it does not yet exist
    $this->db->exec('CREATE TABLE IF NOT EXISTS failures (ip TEXT PRIMARY KEY)');
  }

  /**
   * Insert an IP address if it does not currently exist
   *
   * @param String $ip
   * IP address to insert
   */

  function insert($ip) {
    // bail out if the IP address already exists
    if ($this->exists($ip)) { return; }

    // insert IP address
    $statement = $this->db->prepare('INSERT INTO failures (ip) VALUES (:ip)');

    $statement->bindParam(':ip', $ip);

    $statement->execute();
  }

  /**
   * Whether a specific IP address has previously been stored
   *
   * @param String $ip
   * IP address to locate
   */

  function exists($ip) {
    $query = $this->db->prepare(self::SELECT_QUERY);
    $query->execute(compact('ip'));

    // return boolean answer
    return !!$query->fetchColumn();
  }

}
