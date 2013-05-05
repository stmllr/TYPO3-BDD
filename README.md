# BDD with Behat/Mink for the TYPO3 Core

This is a basic approach to test features of the TYPO3 Backend using Behat/Mink.


## Getting started

1. Install Behat+Mink with composer
2. Setup a TYPO3 Instance
3. Configure URL of your TYPO3 instance in base_url of behat.yml
4. Setup a WebDriver Instance (see below)
5. Run bin/behat


## WebDriver Example Configuration

### Basic setup


Start instance
``
java -jar selenium-server-standalone-2.32.0.jar
``

### Grid setup

Start hub:
``
java -jar selenium-server-standalone-2.32.0.jar -role hub
``

Start node for Chrome:
``
java -jar selenium-server-standalone-2.32.0.jar -role node -port 5555 -browser browserName=chrome,version=26,maxInstances=1
``

Start node for Firefox:
``
java -jar selenium-server-standalone-2.32.0.jar -role node -port 5556 -browser browserName=firefox,version=20,maxInstances=1
``

Watch your grid setup at http://localhost:4444/grid/console
