<?php

use OCP\AppFramework\App;
use OC\Security\CSP\ContentSecurityPolicy;

$app = new App('terminal');
$container = $app->getContainer();

$container->query('OCP\INavigationManager')->add(function () use ($container) {
	$urlGenerator = $container->query('OCP\IURLGenerator');
	$l10n = $container->query('OCP\IL10N');
	return [
		// the string under which your app will be referenced in Nextcloud
		'id' => 'terminal',

		// sorting weight for the navigation. The higher the number, the higher
		// will it be listed in the navigation
		'order' => 10,

		// the route that will be shown on startup
		'href' => $urlGenerator->linkToRoute('terminal.page.index'),

		// the icon that will be shown in the navigation
		// this file needs to exist in img/
		'icon' => $urlGenerator->imagePath('terminal', 'app.svg'),

		// the title of your application. This will be used in the
		// navigation or on the settings page of your app
		'name' => $l10n->t('Terminal'),
	];
});


// Whitelist the websocket URL for iframes, required for Firefox
// Copied from richdocuments
$manager = \OC::$server->getContentSecurityPolicyManager();
$policy = new ContentSecurityPolicy();
// $policy->addAllowedFrameDomain('https://felho.sfv.udvari.org');
// $policy->addAllowedChildSrcDomain('wss://felho.sfv.udvari.org');
$policy->addAllowedConnectDomain('wss://felho.sfv.udvari.org');
$manager->addDefaultPolicy($policy);
