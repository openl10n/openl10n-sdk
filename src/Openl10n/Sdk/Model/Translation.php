<?php

namespace Openl10n\Sdk\Model;

class Translation
{
    protected $id;

    protected $resourceId;

    protected $identifier;

    public function __construct($identifier, $resourceId)
    {
        $this->identifier = $identifier;
        $this->resourceId = $resourceId;
    }

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of identifier.
     *
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Sets the value of identifier.
     *
     * @param mixed $identifier the identifier
     *
     * @return self
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Gets the value of resourceId.
     *
     * @return mixed
     */
    public function getResourceId()
    {
        return $this->resourceId;
    }

    /**
     * Sets the value of resourceId.
     *
     * @param mixed $resourceId the resource id
     *
     * @return self
     */
    protected function setResourceId($resourceId)
    {
        $this->resourceId = $resourceId;

        return $this;
    }
}
