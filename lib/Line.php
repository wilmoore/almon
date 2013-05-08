<?php

/**
 * @copyright Copyright(c) 2013 Wil Moore III <wil.moore@wilmoore.com>
 * @license   MIT Licensed
 */

class Line {

  /**
   * Regular expression to identify failure attempts
   */

  const FAILURE_PATTERN = "/NOTICE.+chan_sip.+: Registration from .+ failed for '(?<ip>.+)' - Peer is not supposed to register/i"; 

  /**
   * Peer IP address
   *
   * @var string
   */

  public $ip;

  /**
   * Extract applicable attributes from asterisk log line
   *
   * @param string $line
   * Asterisk log line
   */

  function __construct($line = '') {
    // extract attributes from log line

    preg_match(self::FAILURE_PATTERN, $line, $out);

    // set peer IP address

    $this->ip = empty($out['ip'])
              ? null
              : $out['ip'];
  }

}
