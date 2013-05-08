<?php
/**
 * @copyright Copyright(c) 2013 Wil Moore III <wil.moore@wilmoore.com>
 * @license   MIT Licensed
 */

class Mailer {

  /**
   * Mailer object to delegate to
   *
   * @var Swift_Mailer
   */
  private $mailer;

  /**
   * Build a transport and mailer object to prepare for SMTP sending
   *
   * @param Array $options
   * SMTP options
   */
  function __construct($options) {
    // Create the Transport
    $transport = Swift_SmtpTransport::newInstance($options['host'], $options['port']);

    if (! empty($options['user'])) {
      $transport->setUsername($options['user']);
    }

    if (! empty($options['pass'])) {
      $transport->setPassword($options['pass']);
    }

    // Create the Mailer using your created Transport
    $this->mailer = Swift_Mailer::newInstance($transport);
  }

  function __invoke($ip, $to) {
    $message = Swift_Message::newInstance('Asterisk Log Monitor');

    // set sender
    $message->setFrom(array('almon@example.com' => 'Asterisk Log monitor'));

    // set recipient
    $message->setTo(array($to));

    // set body text
    $message->setBody(
      sprintf("IP address %s is trying to register on host %s.", $ip, gethostname())
    );

    $this->mailer->send($message);
  }

}
