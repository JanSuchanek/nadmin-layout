<?php

declare(strict_types=1);

namespace NAdminLayout\DI;

use NAdminLayout\AdminLayoutConfig;
use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;

/**
 * DI extension for nadmin-layout.
 *
 * Configuration example:
 *   nadminLayout:
 *       title: "My Admin Panel"
 *       brand:
 *           icon: bi-shop
 *           name: MyApp
 *       menu:
 *           - section: Navigation
 *           - { label: Dashboard, icon: bi-grid, link: ":Admin:Dashboard:default" }
 *           - section: Catalog
 *           - { label: Products, icon: bi-box-seam, link: ":Admin:Product:default" }
 *       locales:
 *           - { code: cs, flag: "🇨🇿", label: Česky }
 *           - { code: en, flag: "🇬🇧", label: English }
 */
final class NAdminLayoutExtension extends CompilerExtension
{
    public function getConfigSchema(): Schema
    {
        return Expect::structure([
            'title' => Expect::string('Admin'),
            'brand' => Expect::structure([
                'icon' => Expect::string('bi-shop'),
                'name' => Expect::string('NAdmin'),
            ]),
            'menu' => Expect::listOf(
                Expect::anyOf(
                    Expect::structure([
                        'section' => Expect::string()->required(),
                    ])->castTo('array'),
                    Expect::structure([
                        'label' => Expect::string()->required(),
                        'icon' => Expect::string()->required(),
                        'link' => Expect::string()->required(),
                        'permission' => Expect::string(),
                    ])->castTo('array'),
                ),
            ),
            'locales' => Expect::listOf(
                Expect::structure([
                    'code' => Expect::string()->required(),
                    'flag' => Expect::string(''),
                    'label' => Expect::string()->required(),
                ])->castTo('array'),
            ),
        ]);
    }


    public function loadConfiguration(): void
    {
        $builder = $this->getContainerBuilder();
        /** @var \stdClass $config */
        $config = $this->getConfig();

        $def = $builder->addDefinition($this->prefix('config'))
            ->setFactory(AdminLayoutConfig::class)
            ->addSetup('setTitle', [$config->title])
            ->addSetup('setBrandIcon', [$config->brand->icon])
            ->addSetup('setBrandName', [$config->brand->name]);

        if (!empty($config->menu)) {
            $def->addSetup('setMenuItems', [$config->menu]);
        }

        if (!empty($config->locales)) {
            $def->addSetup('setLocales', [$config->locales]);
        }
    }
}
