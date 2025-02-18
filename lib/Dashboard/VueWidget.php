<?php

declare(strict_types=1);

namespace OCA\CatGifsDashboard\Dashboard;

use OCA\CatGifsDashboard\AppInfo\Application;
use OCA\CatGifsDashboard\Service\GifService;
use OCP\AppFramework\Services\IInitialState;
use OCP\Dashboard\IAPIWidget;
use OCP\IL10N;
use OCP\IURLGenerator;
use OCP\Util;

class VueWidget implements IAPIWidget {

	/** @var IL10N */
	private $l10n;
	/**
	 * @var GifService
	 */
	private $gifService;
	/**
	 * @var IInitialState
	 */
	private $initialStateService;
	/**
	 * @var string|null
	 */
	private $userId;

	public function __construct(IL10N $l10n,
								GifService $gifService,
								IInitialState $initialStateService,
								?string $userId) {
		$this->l10n = $l10n;
		$this->gifService = $gifService;
		$this->initialStateService = $initialStateService;
		$this->userId = $userId;
	}

	/**
	 * @inheritDoc
	 */
	public function getId(): string {
		return 'catgifsdashboard-vue-widget';
	}

	/**
	 * @inheritDoc
	 */
	public function getTitle(): string {
		return $this->l10n->t('Vue widget');
	}

	/**
	 * @inheritDoc
	 */
	public function getOrder(): int {
		return 10;
	}

	/**
	 * @inheritDoc
	 */
	public function getIconClass(): string {
		return 'icon-catgifsdashboard';
	}

	/**
	 * @inheritDoc
	 */
	public function getUrl(): ?string {
		return null;
	}

	/**
	 * @inheritDoc
	 */
	public function load(): void {
		if ($this->userId !== null) {
			$items = $this->getItems($this->userId);
			$this->initialStateService->provideInitialState('dashboard-widget-items', $items);
		}

		Util::addScript(Application::APP_ID, Application::APP_ID . '-dashboardVue');
		Util::addStyle(Application::APP_ID, 'dashboard');
	}

	/**
	 * @inheritDoc
	 */
	public function getItems(string $userId, ?string $since = null, int $limit = 7): array {
		return $this->gifService->getWidgetItems($userId);
	}
}
