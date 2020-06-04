# FIA™ Framework
[![License](https://img.shields.io/badge/License-Apache%202.0-red.svg)](https://github.com/iamodao/fia/blob/master/LICENSE)
[![Version](https://img.shields.io/badge/Version-Evolving-yellow.svg)](https://github.com/iamodao/fia/releases/latest)
[![Generic badge](https://img.shields.io/badge/Wiki-Read-1abc9c.svg)](https://github.com/iamodao/fia/wiki)
[![Generic badge](https://img.shields.io/badge/Creator-OSAWERE™-green.svg)](https://www.osawere.com/)
[![Generic badge](https://img.shields.io/badge/LinkedIn-@iamodao-blue.svg)](https://www.linkedin.com/in/iamodao/)

**FIA™ Framework** is a micro framework for website, application and API development with PHP & MySQL built by [Anthony O. Osawere - @iamodao](https://www.twitter.com/iamodao)


#### NOTE:
If configuration [config.php OR/AND $initConfig array] is not created, FIA framework will assume certain defaults


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
