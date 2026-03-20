<?php

declare(strict_types=1);

namespace NAdminLayout;

/**
 * Holds admin layout configuration: menu items, branding, locales.
 *
 * Populated by NAdminLayoutExtension from NEON config.
 * Passed to the admin layout template by a Latte extension.
 */
final class AdminLayoutConfig
{
    /** @var list<array<string, mixed>> */
    private array $menuItems = [];

    private string $title = 'Admin';

    private string $brandIcon = 'bi-shop';

    private string $brandName = 'NAdmin';

    /** @var list<array{code: string, flag: string, label: string}> */
    private array $locales = [];


    public function getTitle(): string
    {
        return $this->title;
    }


    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    public function getBrandIcon(): string
    {
        return $this->brandIcon;
    }


    public function setBrandIcon(string $icon): void
    {
        $this->brandIcon = $icon;
    }


    public function getBrandName(): string
    {
        return $this->brandName;
    }


    public function setBrandName(string $name): void
    {
        $this->brandName = $name;
    }


    /**
     * @param list<array<string, mixed>> $items
     */
    public function setMenuItems(array $items): void
    {
        $this->menuItems = $items;
    }


    /**
     * @return list<array<string, mixed>>
     */
    public function getMenuItems(): array
    {
        return $this->menuItems;
    }


    /**
     * @param list<array{code: string, flag: string, label: string}> $locales
     */
    public function setLocales(array $locales): void
    {
        $this->locales = $locales;
    }


    /**
     * @return list<array{code: string, flag: string, label: string}>
     */
    public function getLocales(): array
    {
        return $this->locales;
    }
}
