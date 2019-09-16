<?php
namespace Pandora3\Libs\Cookie\Middlewares;

use Pandora3\Core\Interfaces\RequestHandlerInterface;
use Pandora3\Core\Interfaces\RequestInterface;
use Pandora3\Core\Interfaces\ResponseInterface;
use Pandora3\Core\Middleware\Interfaces\MiddlewareInterface;
use Pandora3\Libs\Cookie\Cookies;

/**
 * Class SaveCookieMiddleware
 * @package Pandora3\Libs\Cookie\Middlewares
 */
class SaveCookiesMiddleware implements MiddlewareInterface {

	/** @var Cookies $cookies */
	protected $cookies;

	public function __construct(Cookies $cookies) {
		$this->cookies = $cookies;
	}
	
	/**
	 * {@inheritdoc}
	 */
	function process(RequestInterface $request, array $arguments, RequestHandlerInterface $handler): ResponseInterface {
		$response = $handler->handle($request, $arguments);
		foreach ($this->cookies->getCookies() as $cookie) {
			$response->setCookie($cookie);
		}
		return $response;
	}

}