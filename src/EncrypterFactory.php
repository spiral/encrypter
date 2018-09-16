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
class EncrypterFactory implements InjectorInterface, EncryptionInterface, SingletonInterface
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
     * @inheritdoc
     * @codeCoverageIgnore
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
     * @inheritdoc
     */
    public function getKey(): string
    {
        return $this->config->getKey();
    }

    /**
     * @return EncrypterInterface
     */
    public function getEncrypter(): EncrypterInterface
    {
        return new Encrypter($this->config->getKey());
    }

    /**
     * {@inheritdoc}
     */
    public function createInjection(\ReflectionClass $class, string $context = null)
    {
        return $this->getEncrypter();
    }
}