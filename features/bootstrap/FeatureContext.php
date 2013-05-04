<?php

use Behat\Behat\Context\ClosuredContextInterface,
	Behat\Behat\Context\TranslatedContextInterface,
	Behat\Behat\Context\BehatContext,
	Behat\Behat\Context\Step,
	Behat\Behat\Exception\PendingException,
	Behat\Behat\Event\ScenarioEvent;

use Behat\Gherkin\Node\PyStringNode,
	Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;


/**
 * Features context.
 */
class FeatureContext extends MinkContext {

	/**
	 * URL paths
	 *
	 * @var array
	 */
	public $paths = array();

	/**
	 * Initializes context.
	 * Every scenario gets it's own context object.
	 *
	 * @param array $parameters context parameters from behat.yml
	 */
	public function __construct(array $parameters) {
		if ($parameters['paths']) {
			foreach ($parameters['paths'] as $key => $path) {
				$this->paths[$key] = $path;
			}
		}
	}

	/**
	 * @Given /^I am on the backend login page$/
	 */
	public function iAmOnTheBackendLoginPage() {
		return array(
			new Step\When('I am on "' . $this->paths['backend'] . '"')
		);
	}

	/**
	 * Take screenshot when step fails. Works only with Selenium2Driver.
	 * Screenshot is saved at [Date]/[Feature]/[Scenario]/[Step].jpg
	 *
	 * @TODO Add a check if WebDriver Session fully works.
	 *
	 * @AfterStep @javascript
	 */
	public function takeScreenshotAfterFailedStep(Behat\Behat\Event\StepEvent $event) {
		if ($event->getResult() === Behat\Behat\Event\StepEvent::FAILED) {
			$driver = $this->getSession()->getDriver();
			if ($driver instanceof Behat\Mink\Driver\Selenium2Driver) {
				$step = $event->getStep();
				$path = array(
					'date' => date("Ymd-Hi"),
					'feature' => $step->getParent()->getFeature()->getTitle(),
					'scenario' => $step->getParent()->getTitle(),
					'step' => $step->getType() . ' ' . $step->getText()
				);
				$path = preg_replace('/[^\-\.\w]/', '_', $path);
				$filename = '/tmp/behat-screenshots/' .  implode('/', $path) . '.jpg';

				// Create directories if needed
				if (!@is_dir(dirname($filename))) {
					@mkdir(dirname($filename), 0775, TRUE);
				}

				file_put_contents($filename, $driver->getScreenshot());
				#echo sprintf('[NOTICE] A screenshot was saved to %s %s', $filename, PHP_EOL);
			}
		}
	}
}
