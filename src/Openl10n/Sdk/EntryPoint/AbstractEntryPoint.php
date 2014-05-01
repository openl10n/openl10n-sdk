<?php

namespace Openl10n\Sdk\EntryPoint;

use GuzzleHttp\Client;

abstract class AbstractEntryPoint implements EntryPointInterface
{
	private $client;

	/**
	 * {@inheritdoc}
	 */
	public function setClient(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * @return Client Client of the API
	 */
	protected function getClient()
	{
		return $this->client;
	}
}
