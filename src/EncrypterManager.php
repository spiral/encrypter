<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Encrypter;

use Defuse\Crypto\Exception\CryptoException;
use Defuse\Crypto\Key;
use Spiral\Core\Container\InjectorInterface;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Encrypter\Configs\EncrypterConfig;
use Spiral\Encrypter\Exceptions\EncrypterException;

/**
 * Only manages encrypter injections (factory).
 */
class EncrypterManager implements InjectorInterface, SingletonInterface
{
    /**
     * @var EncrypterConfig
     */
    protected $config = null;

    /**
     * @param EncrypterConfig $config
     */
    public function __construct(EncrypterConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Generate new random encryption key (binary format).
     *
     * @return string
     * @throws EncrypterException
     */
    public function generateKey(): string
    {
        try {
            return Key::createNewRandomKey()->saveToAsciiSafeString();
        } catch (CryptoException $e) {
            throw new EncrypterException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function createInjection(\ReflectionClass $class, string $context = null)
    {
        return $class->newInstance(base64_decode($this->config->getKey()));
    }
}