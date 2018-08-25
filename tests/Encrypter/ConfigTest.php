<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Encrypter\Tests;

use PHPUnit\Framework\TestCase;
use Spiral\Encrypter\Configs\EncrypterConfig;

class ConfigTest extends TestCase
{
    public function testKey()
    {
        $config = new EncrypterConfig([
            'key' => 'abc'
        ]);

        $this->assertSame('abc', $config->getKey());
    }
}