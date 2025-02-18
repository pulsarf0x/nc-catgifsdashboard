<?php

declare(strict_types=1);

namespace OCA\CatGifsDashboard\AppInfo;

use OCA\CatGifsDashboard\Dashboard\VueWidget;
use OCA\CatGifsDashboard\Dashboard\WidgetV2;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;

class Application extends App implements IBootstrap {
	public const APP_ID = 'catgifsdashboard';

	public function __construct(array $urlParams = []) {
		parent::__construct(self::APP_ID, $urlParams);
	}

	public function register(IRegistrationContext $context): void {
		$context->registerDashboardWidget(VueWidget::class);
		$context->registerDashboardWidget(WidgetV2::class);
	}

	public function boot(IBootContext $context): void {
	}
}
