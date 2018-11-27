Перенос бэкапов на ftp сервер

## Install

  * Use composer: _require_ `nicolab/php-ftp-client`

  * Or use GIT clone command: `git clone git@github.com:Nicolab/php-ftp-client.git`

  * Or download the library, configure your autoloader or include the 3 files of `php-ftp-client/src/FtpClient` directory.


## Getting Started

Connect to a server FTP :

```php
$ftp = new \FtpClient\FtpClient();
$ftp->connect($host);
$ftp->login($login, $password);
```

OR

Connect to a server FTP via SSL (on port 990 or another port) :

```php
$ftp = new \FtpClient\FtpClient();
$ftp->connect($host, true, 990);
$ftp->login($login, $password);
```

Note: The connection is implicitly closed at the end of script execution (when the object is destroyed). Therefore it is unnecessary to call `$ftp->close()`, except for an explicit re-connection.
