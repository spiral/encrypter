<?php declare(strict_types=1);
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Encrypter;

use Spiral\Encrypter\Exception\EncrypterException;

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