<?php

/*
 * This file is part of Everest.
 *
 * (c) 2017 Philipp Steingrebe <philipp@steingrebe.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Everest\Container;

class Cache
{
	protected $cache = [];

	public function set(string $key, $value)
	{
			$this->cache[$key] = $value;
	}

	public function get(string $key)
	{
		return $this->cache[$key] ?? null;
	}

	public function has(string $key) : bool
	{
		return array_key_exists($key, $this->cache);
	}

	public function merge(Cache $cache, string $prefix = null)
	{
		if ($prefix) {
			$keys = array_keys($cache->cache);
			foreach ($keys as $index => $key) {
				$keys[$index] = $prefix . '/' . $key;
			}

			$cache = array_combine($keys, array_values($cache->cache));
		}
		else {
			$cache = $cache->cache;
		}
		
		$this->cache = array_merge($this->cache, $cache);
	}
}