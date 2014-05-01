<?php

namespace Openl10n\Sdk\Model;

class Language
{
    protected $locale;
    protected $name;

    public function __construct($locale, $name)
    {
        $this->locale = $locale;
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function __toString()
    {
        return sprintf('%s (%s)', $this->name, $this->locale);
    }
}
