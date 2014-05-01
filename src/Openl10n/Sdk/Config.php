<?php

namespace Openl10n\Sdk;

class Config
{
	protected $hostname;
	protected $useSsl;
	protected $login;
	protected $password;

	public function __construct($hostname, $useSsl = false)
	{
		$this->hostname = (string) $hostname;
		$this->useSsl = (bool) $useSsl;
	}

	public function setAuth($login, $password)
	{
		$this->login = $login;
		$this->password = $password;

		return $this;
	}

	public function getHostname()
	{
		return $this->hostname;
	}

	public function getUseSsl()
	{
		return $this->useSsl;
	}

	public function getLogin()
	{
		return $this->login;
	}

	public function getPassword	()
	{
		return $this->password;
	}
}
