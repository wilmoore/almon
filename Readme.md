# Asterisk Log Monitor

The **Asterisk Log Monitor** _almon_ is a `php` based log monitor for the [Asterisk IP PBX system][asterisk].

## Installation

```
% mkdir -p ~/.local/almon
% cd ~/.local/almon
% curl -#L https://github.com/wilmoore/almon/archive/master.tar.gz | tar xvz --strip 1
% php composer.phar install
```

## Configuration

User configuration (recommended)

```
% cp .almon.ini.dist ~/.almon.ini
```

System/Global configuration

```
% cp .almon.ini.dist ./.almon.ini
```

## Example Usage

Monitor an asterisk log file

```
# use PHP as an AWK replacement
% cat /var/log/asterisk/messages | php --process-file ~/.local/almon/almon.php
```

To ignore `SKIPPING` messages, just pipe to `STDERR`.

```
% cat /var/log/asterisk/messages | php --process-file ~/.local/almon/almon.php 2> /dev/null
```
Open IP address store

```
% sqlite3 /tmp/asterisk.sqlite3
```

Review entries

```
sqlite> SELECT * FROM failures;
```

Truncate failures table

```
sqlite> DELETE FROM failures;
```

## Scheduling

Install user crontab

```
crontab -u $USER crontab
```

List user crontab

```
crontab -u $USER -l
```

Remove user crontab

```
crontab -u $USER -r
```

## Executing Test Suite

```
% git clone https://github.com/wilmoore/almon.git
% cd almon
% php composer.phar install --dev
% make test
```

## Troubleshooting

> I'm getting some weird PDO error on Ubuntu...

```
% apt-get install php5-cli
```

## FAQ

> Why use PHP to parse a server log instead of something more appropriate like [Fail2ban][]?

Normally, I would use [Fail2ban][] for this type of project; however, this is a fun excercise and an excuse to show off test driven development and multi-paradigm (class-based and procedural) development in PHP.

> Why did you use raw PDO instead of an ORM or higher-level database abstraction layer?

Because this project is extremely self-contained; thus, raw PDO was good enough for the task at hand.

> In that case, why use a mailer library? Why not use the raw PHP `mail` function?

Because the PHP mail interface is extremely low-level and this is very apparent when it comes to authenticating with an external SMTP server.  In this case, there is a lot of value added in introducing a mature, stable and well-tested library.

> I see tests coverage for `lib/Line`; however, what about everything else under `lib`?

Diminishing returns...

> Why not distribute this as a phar archive?

I considered it; however, given this is an internal-use tool and not delivered to a client, there was little incentive. That being said, we could always look at it as a future enhancement.

> Why does this not work on windows?

It is possible that it will work on windows (see `getenv('HOME')`); however, this script is currently only tested on unix-like (i.e. POSIX) systems such as Linux, *BSD. This means, it will definitely work on your macbook. Sorry...time trade-off.


[asterisk]:   http://www.asterisk.org/
[fail2ban]:   http://www.fail2ban.org/

