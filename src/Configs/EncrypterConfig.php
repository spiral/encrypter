<?php
/**
 * Spiral Framework.
 *
 * @license MIT
 * @author  Anton Titov (Wolfy-J)
 */

namespace Spiral\Encrypter\Configs;

use Spiral\Core\InjectableConfig;

/**
 * Encrypter configuration.
 */
class EncrypterConfig extends InjectableConfig
{
    /**
     * Configuration section.
     */
    const CONFIG = 'encrypter';

    /**
     * @var array
     */
    protected $config = [
        'key' => ''
    ];

    /**
     * Encryption key in BASE64 format.
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->config['key'];
    }
}