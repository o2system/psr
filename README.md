# O2System PHP Standards Recommendations (PSR)

O2System PSR it's build based on [PHP Framework Interop Group (PHP-FIG)](http://php-fig.org) standards recommendations and is edited and added by some standards recommendations for O2System PHP Framework.
This repository contains a collection of PHP classes, abstract classes and interfaces classes based on the PSR-3, PSR-4, PSR-6 and PSR-7.

| Based | Title | &nbsp; |
| :-------------: |:-------------|:-----|
| PSR-3 | Logger Interface | http://www.php-fig.org/psr/psr-3/ |
| PSR-4 | Autoloading Standard | http://www.php-fig.org/psr/psr-4/ |
| PSR-6 | Caching Interface | http://www.php-fig.org/psr/psr-6/ |
| PSR-7 | HTTP Message Interface | http://www.php-fig.org/psr/psr-7/ |

Installation
------------
The best way to install [O2System PSR](https://packagist.org/packages/o2system/psr) is to use [Composer](http://getcomposer.org)
```
composer require o2system/psr
```

Usage Example
-------------
```php
namespace O2System\Gears;

use O2System\Psr\Log\LoggerInterface;

class Logger implements LoggerInterface
{

}
```

Ideas and Suggestions
---------------------
Please kindly mail us at [o2system.framework@gmail.com](mailto:o2system.framework@gmail.com).

Bugs and Issues
---------------
Please kindly submit your [issues at Github](http://github.com/o2system/psr/issues) so we can track all the issues along development.

System Requirements
-------------------
- PHP 5.4+
- [Composer](http://getcomposer.org)

Credits
-------
* Founder and Lead Projects: [Steeven Andrian Salim (steevenz.com)](http://steevenz.com)
* Github Pages Designer and Writer: [Teguh Rianto](http://teguhrianto.tk)