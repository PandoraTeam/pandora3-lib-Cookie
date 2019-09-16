<?php
namespace Pandora3\Libs\Cookie;

class Cookies {

	/** @var Cookie[] $cookies */
	protected $cookies = [];

	/**
	 * @param Cookie $cookie
	 */
	public function set(Cookie $cookie): void {
		$this->cookies[$cookie->domain][$cookie->path][$cookie->name] = $cookie;
	}

	/**
	 * @param string $name
	 * @param string $path
	 * @param null|string $domain
	 */
	public function remove(string $name, string $path = '/', ?string $domain = null): void {
		unset($this->cookies[$domain][$path][$name]);
	}

	/**
	 * @param string $name
	 * @param string $path
	 * @param null|string $domain
	 * @param bool $isSecure
	 * @param bool $isHttpOnly
	 */
	public function clear(
		string $name, string $path = '/', ?string $domain = null,
		bool $isSecure = false, bool $isHttpOnly = true
	): void {
		$this->set(new Cookie($name, null, [
			'expire' => 1,
			'path' => $path,
			'domain' => $domain,
			'isSecure' => $isSecure,
			'isHttpOnly' => $isHttpOnly
		]));
	}

	/**
	 * @return array
	 */
	public function getCookies(): array {
		$cookies = [];
		foreach ($this->cookies as $domainCookies) {
			foreach ($domainCookies as $pathCookies) {
				foreach ($pathCookies as $cookie) {
					$cookies[] = $cookie;
				}
			}
		}
		return $cookies;
	}

}