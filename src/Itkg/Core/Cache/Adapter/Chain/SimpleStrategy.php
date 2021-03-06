<?php

/*
 * This file is part of the Itkg\Core package.
 *
 * (c) Interakting - Business & Decision
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Itkg\Core\Cache\Adapter\Chain;

use Itkg\Core\Cache\AdapterInterface;
use Itkg\Core\CacheableInterface;

class SimpleStrategy implements CachingStrategyInterface
{
    /**
     * @param array $adapters
     * @param CacheableInterface $item
     * @return mixed
     */
    public function get(array $adapters, CacheableInterface $item)
    {
        /**
         * @fixme : Change silent catch
         */
        foreach ($adapters as $adapter) {
            try {
                return $adapter->get($item);
            } catch(\Exception $e) {
                continue;
            }
        }

        return false;
    }

    /**
     * @param array $adapters
     * @param CacheableInterface $item
     * @return void
     */
    public function set(array $adapters, CacheableInterface $item)
    {
        /**
         * @fixme : Change silent catch
         */
        foreach ($adapters as $adapter) {
            try {
                $adapter->set($item);
                break;
            } catch(\Exception $e) {
                continue;
            }
        }
    }

    /**
     * @param array $adapters
     * @param CacheableInterface $item
     * @return void
     */
    public function remove(array $adapters, CacheableInterface $item)
    {
        foreach ($adapters as $adapter) {
            $adapter->remove();
        }
    }

    /**
     * @param array $adapters
     * @return void
     */
    public function removeAll(array $adapters)
    {
        foreach ($adapters as $adapter) {
            $adapter->removeAll();
        }
    }
}