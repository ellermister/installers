<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2016, iBenchu.org
 * @datetime 2016-12-03 13:55
 */
namespace Notadd\Installers\Composer\Installers;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

/**
 * Class Installer.
 */
class Installer extends LibraryInstaller
{
    /**
     * @param \Composer\Package\PackageInterface $package
     *
     * @return string
     */
    public function getInstallPath(PackageInterface $package) {
        return 'modules' . $package->getPrettyName();
    }

    /**
     * @param string $packageType
     *
     * @return bool
     */
    public function supports($packageType)
    {
        return $packageType === 'notadd-module';
    }
}
