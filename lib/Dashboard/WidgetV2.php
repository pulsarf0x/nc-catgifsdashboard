<?php

declare(strict_types=1);

namespace OCA\CatGifsDashboard\Dashboard;

use OCA\CatGifsDashboard\Service\GifService;
use OCP\Dashboard\IIconWidget;
use OCP\Dashboard\IReloadableWidget;
use OCP\Dashboard\Model\WidgetItems;
use OCP\IL10N;
use OCP\IURLGenerator;

class WidgetV2 implements IIconWidget, IReloadableWidget {

	/** @var IL10N */
	private $l10n;
	/**
	 * @var GifService
	 */
	private $gifService;
	/**
	 * @var string|null
	 */
	private $userId;

	public function __construct(IL10N $l10n,
								GifService $gifService,
								IURLGenerator $urlGenerator,
								?string $userId) {
		$this->l10n = $l10n;
		$this->gifService = $gifService;
		$this->urlGenerator = $urlGenerator;
		$this->userId = $userId;
	}

	/**
	 * @inheritDoc
	 */
	public function getId(): string {
		return 'catgifsdashboard-widget-v2';
	}

	/**
	 * @inheritDoc
	 */
	public function getTitle(): string {
		return $this->l10n->t('Widget V2');
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
	public function getIconUrl(): string {
		return $this->urlGenerator->getAbsoluteURL(
			$this->urlGenerator->imagePath('catgifsdashboard', 'app-dark.svg')
		);
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
		// No need to provide initial state or inject javascript code anymore
	}

	/**
	 * @inheritDoc
	 */
	public function getItemsV2(string $userId, ?string $since = null, int $limit = 7): WidgetItems {
		$items = $this->gifService->getWidgetItems($userId);
		return new WidgetItems(
			$items,
			empty($items) ? $this->l10n->t('No gifs found') : '',
		);
	}

	/**
	 * @inheritDoc
	 */
	public function getReloadInterval(): int {
		// Reload data every minute
		return 60;
	}
}
