<?php

namespace Openl10n\Sdk\EntryPoint;

use GuzzleHttp\Client;

interface EntryPointInterface
{
	/**
	 * @param Client Guzzle client of the API
	 */
	public function setClient(Client $client);

	/**
	 * @return string Name of the entry point
	 */
	public function getName();
}
