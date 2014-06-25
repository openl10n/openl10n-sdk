<?php

namespace Openl10n\Sdk;

class Config
{
    protected $hostname;
    protected $useSsl;
    protected $login;
    protected $password;
    protected $port;

    public function __construct($hostname, $useSsl = false, $port = null)
    {
        $this->hostname = (string) $hostname;
        $this->useSsl = (bool) $useSsl;

        if ($port === null) {
            $this->port = $this->useSsl ? 443 : 80;
        } else {
            $this->port = $port;
        }
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

    public function getPassword()
    {
        return $this->password;
    }

    public function getPort()
    {
        return $this->port;
    }
}
