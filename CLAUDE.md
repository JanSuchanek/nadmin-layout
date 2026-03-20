# nadmin-layout

Configurable admin UI shell — sidebar menu, branding, locale switcher driven by NEON config.

## Key Classes
- `AdminLayoutConfig` — reads menu items, brand settings, locales from NEON
- DI Extension: `NAdminLayoutExtension`
- Latte partials for sidebar, topbar rendering

## Conventions
- PHP 8.2+ with `declare(strict_types=1)`
- PSR-4 autoloading in `src/`
- Nette DI Extension for service registration
- PHPStan level 9
- Part of `jansuchanek/*` on Packagist
- GitHub: https://github.com/JanSuchanek/nadmin-layout
