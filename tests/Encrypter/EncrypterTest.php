<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Encrypter\Tests;

use Defuse\Crypto\Key;
use PHPUnit\Framework\TestCase;
use Spiral\Encrypter\Encrypter;

class EncryptionTest extends TestCase
{
    public function testImmutable()
    {
        $encrypter = new Encrypter($keyA = Key::CreateNewRandomKey()->saveToAsciiSafeString());
        $new = $encrypter->withKey($keyB = Key::CreateNewRandomKey()->saveToAsciiSafeString());

        $this->assertNotSame($encrypter, $new);

        $this->assertEquals($keyA, $encrypter->getKey());
        $this->assertEquals($keyB, $new->getKey());
    }

    /**
     * @covers \Spiral\Encrypter\Encrypter::encrypt
     */
    public function testEncryption()
    {
        $encrypter = new Encrypter(Key::CreateNewRandomKey()->saveToAsciiSafeString());

        $encrypted = $encrypter->encrypt('test string');
        $this->assertNotEquals('test string', $encrypted);
        $this->assertEquals('test string', $encrypter->decrypt($encrypted));

        $encrypter = $encrypter->withKey(Key::CreateNewRandomKey()->saveToAsciiSafeString());

        $encrypted = $encrypter->encrypt('test string');
        $this->assertNotEquals('test string', $encrypted);
        $this->assertEquals('test string', $encrypter->decrypt($encrypted));

        $encrypted = $encrypter->encrypt('test string');
        $this->assertNotEquals('test string', $encrypted);
        $this->assertEquals('test string', $encrypter->decrypt($encrypted));
    }

    /**
     * @expectedException \Spiral\Encrypter\Exception\DecryptException
     */
    public function testBadData()
    {
        $encrypter = new Encrypter(Key::CreateNewRandomKey()->saveToAsciiSafeString());

        $encrypted = $encrypter->encrypt('test string');
        $this->assertNotEquals('test string', $encrypted);
        $this->assertEquals('test string', $encrypter->decrypt($encrypted));

        $encrypter->decrypt('badData.' . $encrypted);
    }

    /**
     * @expectedException \Spiral\Encrypter\Exception\EncrypterException
     */
    public function testBadKey()
    {
        $encrypter = new Encrypter('bad-key');
    }

    /**
     * @expectedException \Spiral\Encrypter\Exception\EncrypterException
     */
    public function testBadWithKey()
    {
        $encrypter = new Encrypter(Key::CreateNewRandomKey()->saveToAsciiSafeString());
        $encrypter = $encrypter->withKey('bad-key');
    }
}