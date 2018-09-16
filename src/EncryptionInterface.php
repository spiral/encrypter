<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Encrypter;

use Spiral\Encrypter\Exceptions\EncrypterException;

interface EncryptionInterface
{
    /**
     * Generate new random encryption key (binary format).
     *
     * @return string
     *
     * @throws EncrypterException
     */
    public function generateKey(): string;

    /**
     * @return string
     *
     * @throws EncrypterException
     */
    public function getKey(): string;

    /**
     * @return EncrypterInterface
     */
    public function getEncrypter(): EncrypterInterface;
}