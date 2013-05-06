# Asterisk Log Monitor

The **Asterisk Log Monitor** _almon_ is a `php` based log monitor for the [Asterisk IP PBX system][asterisk].

> You may be asking yourself, "Why use PHP to parse server logs?"...

Normally, I would use [Fail2ban][] for this type of project; however, this is just a fun excercise and an excuse to show off test driven development in PHP.

## Installation

```
# TBD
```

## Using

```
# use PHP as an AWK replacement
% cat /var/log/asterisk/messages | php --process-file almon.php
```

## Scheduling

```
# TBD
```

## Executing Test Suite

```
% git clone https://github.com/wilmoore/almon.git
% cd almon
% curl -sS https://getcomposer.org/installer | php
% ./composer.phar install --dev
% make test
```

## TODO

- Implement Email reporter
- Implement IP index


[asterisk]:   http://www.asterisk.org/
[fail2ban]:   http://www.fail2ban.org/
