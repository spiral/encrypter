<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Encrypter\Bootloaders;

use Spiral\Core\Bootloaders\Bootloader;
use Spiral\Encrypter\Encrypter;
use Spiral\Encrypter\EncrypterInterface;

class EncrypterBootloader extends Bootloader
{
    const BINDINGS = [
        EncrypterInterface::class => Encrypter::class
    ];
}