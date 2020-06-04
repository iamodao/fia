# FIA™ Framework
[![License](https://img.shields.io/badge/License-Apache%202.0-red.svg)](https://github.com/iamodao/fia/blob/master/LICENSE)
[![Version](https://img.shields.io/badge/Version-Evolving-yellow.svg)](https://github.com/iamodao/fia/releases/latest)
[![Generic badge](https://img.shields.io/badge/Wiki-Read-1abc9c.svg)](https://github.com/iamodao/fia/wiki)
[![Generic badge](https://img.shields.io/badge/Creator-OSAWERE™-green.svg)](https://www.osawere.com/)
[![Generic badge](https://img.shields.io/badge/LinkedIn-@iamodao-blue.svg)](https://www.linkedin.com/in/iamodao/)

**FIA™ Framework** is a micro framework for website, application and API development with PHP & MySQL built to be flexible and evolving by [Anthony O. Osawere](https://www.fb.com/iamodao). The framework is designed to help yet stay out of your way.

> Your project, your goals. Code your way! - _[@iamodao](https://www.twitter.com/iamodao)_

---

#### NOTE:
If configuration [config.php OR/AND $initConfig array] is not created, FIA framework will assume certain defaults

---

#### Example Code
```php
	<?php
		$demo = 'DEV5 SandBox';
		$fia->dump($demo);
	?>
```



### DIRECTORY STRUCTURE
_The basic directory structure of the framework_

*	_ignore
	*	dev5
		*	code
		*	docs
		*	index.php `[developer sandbox]`
	*	storage
* fia
* source
	*	asset
	*	drive
	*	layout
		*	bit
		*	skin
		*	view
	*	module
		*	api
		*	app
		*	site
	*	config.php
* .htaccess
* index.php
