<?php

namespace Openl10n\Sdk\Model;

class Resource
{
    protected $id;
    protected $projectSlug;
    protected $pathname;

    public function __construct($projectSlug)
    {
        $this->projectSlug = $projectSlug;
    }

    public function getProjectSlug()
    {
        return $this->projectSlug;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPathname()
    {
        return $this->pathname;
    }

    public function setPathname($pathname)
    {
        $this->pathname = $pathname;

        return $this;
    }
}
