<?php

namespace Openl10n\Sdk\Tests\EntryPoint;

use GuzzleHttp\Subscriber\Mock;
use Openl10n\Sdk\EntryPoint\ResourceEntryPoint;
use Openl10n\Sdk\Tests\TestCase;

class ResourceEntryPointTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->entryPoint = new ResourceEntryPoint();
        $this->entryPoint->setClient($this->client);
    }

    public function testGetResourcesList()
    {
        $resources = $this->entryPoint->findByProject('foobar');

        $this->assertCount(2, $resources);
    }

    public function testGetResource1()
    {
        $resource = $this->entryPoint->get(1);

        $expectedData = [
            'id' => 1,
            'project' => 'foobar',
            'pathname' => 'app/Resources/translations/messages.en.yml',
        ];

        foreach ($expectedData as $key => $value) {
            $this->assertEquals($value, $resource[$key]);
        }
    }

    public function testGetResourceNotFound()
    {
        try {
            $this->entryPoint->get(9999);
            $this->fail('Http exception should be thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf('GuzzleHttp\Exception\ClientException', $e);
        }
    }

    public function testCreateResource()
    {
        $this->markTestIncomplete('Find a way to mock POST requests');
    }

    public function testUpdateResource()
    {
        $this->markTestIncomplete('Find a way to mock PUT requests');
    }

    public function testDeleteResource()
    {
        $this->markTestIncomplete('Find a way to mock DELETE requests');
    }

    public function testUploadFile()
    {
        $this->markTestIncomplete('Find a way to mock POST requests');
    }

    public function testDownloadFile()
    {
        $this->markTestIncomplete('Find a way to mock requests with different formats');
    }
}
