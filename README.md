# NAdmin Layout

Configurable admin UI shell for Nette Framework — sidebar menu, branding, and locale switcher driven by NEON config.

## Features

- 📋 **Dynamic Sidebar** — Define menu items, sections, icons, and permissions in NEON
- 🎨 **Branding** — Configurable icon and name
- 🌍 **Locale Switcher** — Languages with flags from config
- ⚙️ **DI Extension** — `AdminLayoutConfig` value object auto-populated

## Installation

```bash
composer require jansuchanek/nadmin-layout
```

## Configuration

```neon
extensions:
    nadminLayout: NAdminLayout\DI\NAdminLayoutExtension

nadminLayout:
    title: My Admin
    brand:
        icon: bi-shop
        name: MyApp
    menu:
        - { section: Navigation }
        - { label: Dashboard, icon: bi-grid, link: ":Admin:Dashboard:default" }
        - { label: Products, icon: bi-box-seam, link: ":Admin:Product:default" }
        - { section: Settings }
        - { label: Users, icon: bi-people, link: ":Admin:User:default", permission: "user.view" }
    locales:
        - { code: cs, flag: "🇨🇿", label: Česky }
        - { code: en, flag: "🇬🇧", label: English }
```

## Usage in Latte

```latte
{* Brand *}
<i class="bi {$adminConfig->getBrandIcon()}"></i> {$adminConfig->getBrandName()}

{* Menu *}
{foreach $adminConfig->getMenuItems() as $item}
    {if isset($item['section'])}
        <div class="nav-section">{$item['section']}</div>
    {else}
        <a href="{plink $item['link']}">{$item['label']}</a>
    {/if}
{/foreach}

{* Locales *}
{foreach $adminConfig->getLocales() as $loc}
    <a href="{link switchLocale! locale => $loc['code']}">{$loc['flag']} {$loc['label']}</a>
{/foreach}
```

## Requirements

- PHP >= 8.2
- Nette DI ^3.2

## License

MIT
