<?php

/**
 * @copyright Copyright(c) 2013 Wil Moore III <wil.moore@wilmoore.com>
 * @license   MIT Licensed
 */

use PHPUnit_Framework_TestCase as TestCase;
use Line as Line;

class LineTest extends TestCase {

  /**
   * Log Lines - data provider
   *
   * fields:
   *  - [log_line]  input log line
   *  - [ip]        expected ip address
   *
   * @return  array
   */

  public function provider_log_lines() {
    $data[] = [ "[2011-05-04 17:05:53] NOTICE[23697] chan_sip.c: Registration from '\"01\"<sip:01@207.38.104.211>' failed for '118.97.164.147' - Peer is not supposed to register", '118.97.164.147' ];
    $data[] = [ "[2011-05-04 07:28:08] NOTICE[11223] pbx_spool.c: Call failed to go through, reason (5) Remote end is Busy", ''];
    $data[] = [ "[2011-05-04 07:38:02] VERBOSE[11275] logger.c:     -- Attempting call on SIP/13056333258@vitel-outbound for s@nx-send-fax:1 (Retry 1)", ''];
    $data[] = [ "[2011-05-04 16:47:29] NOTICE[23697] chan_sip.c: Registration from '\"01\"<sip:01@207.38.104.211>' failed for '109.101.89.45' - Peer is not supposed to register", '109.101.89.45'];
    $data[] = [ "[2011-05-04 16:47:29] NOTICE[23697] chan_sip.c: Registration from '\"16\"<sip:16@207.38.104.211>' failed for '118.97.164.147' - No matching peer found", ''];
    $data[] = [ "[2011-05-04 16:47:29] NOTICE[23697] chan_sip.c: Registration from '\"21\"<sip:21@207.38.104.211>' failed for '118.97.164.147' - No matching peer found", ''];
    $data[] = [ "[2011-05-04 16:49:19] NOTICE[23697] chan_sip.c: Registration from '\"01\" <sip:01@207.38.104.211>' failed for '177.175.120.112' - Peer is not supposed to register", '177.175.120.112'];
    $data[] = [ "[2011-05-04 16:49:19] ERROR[23697] chan_sip.c: Peer '01' is trying to register, but not configured as host=dynamic", ''];
    $data[] = [ "[2011-05-04 16:49:19] NOTICE[23697] chan_sip.c: Registration from '\"01\" <sip:01@207.38.104.211>' failed for '219.2.250.25' - Peer is not supposed to register", '219.2.250.25'];
    $data[] = [ "[2011-05-04 16:50:59] VERBOSE[16463] logger.c:   == Spawn extension (nx-listen, normal-listen, 1) exited non-zero on 'SIP/5060-b5f76198'", ''];
    $data[] = [ "[2011-05-04 16:50:59] VERBOSE[16463] logger.c:     -- Executing [h@nx-listen:1]", ''];
    $data[] = [ "[2011-05-04 16:51:25] NOTICE[23697] chan_sip.c: Registration from '\"01\" <sip:01@207.38.104.211>' failed for '120.52.37.13' - Peer is not supposed to register", '120.52.37.13'];

    return $data;
  }

  /**
   * @test
   * @dataProvider provider_log_lines
   */

  public function IP_Matches($input, $expected) {
    $line = new Line($input);

    $this->assertEquals($expected, $line->ip);
  }

}
