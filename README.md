# BDD with Behat/Mink for the TYPO3 Core

This is a basic approach to test features of the TYPO3 Backend using Behat/Mink.


## Getting started

* Fetch this git repository:

		git clone git://github.com/t3node/TYPO3-BDD.git

* Install Behat+Mink with composer:

		curl http://getcomposer.org/installer | php
		php composer.phar install

* Setup a TYPO3 Instance
* Set the URL of your TYPO3 instance in `base_url` of behat.yml
* Install PhantomJS from http://phantomjs.org/download.html if you want full headless support
* Setup a WebDriver instance (see below)
* Run `bin/behat` on the command line. For alternative test setups, use one of the following profiles:

		bin/behat --profile firefox-via-webdriver
		bin/behat --profile chrome-via-webdriver
		bin/behat --profile phantomjs-via-webdriver
		bin/behat --profile ci

## Selenium server example configurations

Download and install Selenium Server (WebDriver) from http://docs.seleniumhq.org/download/

### Basic setup

Start a basic instance
```
java -jar selenium-server-standalone-2.32.0.jar
```

### Alternative grid setup

Start hub:
```
java -jar selenium-server-standalone-2.32.0.jar -role hub
```

Start node for Chrome:
```
java -jar selenium-server-standalone-2.32.0.jar -role node -port 5555 -browser browserName=chrome,version=26,maxInstances=1
```

Start node for Firefox:
```
java -jar selenium-server-standalone-2.32.0.jar -role node -port 5556 -browser browserName=firefox,version=20,maxInstances=1
```

Start node for PhantomJS:
```
path/to/bin/phantomjs --webdriver=127.0.0.1:8910 --webdriver-selenium-grid-hub=http://127.0.0.1:4444
```

Watch your grid setup at http://localhost:4444/grid/console
