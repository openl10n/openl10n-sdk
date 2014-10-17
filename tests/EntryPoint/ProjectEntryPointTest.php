<?php

namespace Openl10n\Sdk\Tests\EntryPoint;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Subscriber\Mock;
use Openl10n\Sdk\EntryPoint\ProjectEntryPoint;
use Openl10n\Sdk\Tests\TestCase;

class ProjectEntryPointTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->entryPoint = new ProjectEntryPoint();
        $this->entryPoint->setClient($this->client);
    }

    public function testGetProjectsList()
    {
        $projects = $this->entryPoint->findAll();

        $this->assertCount(2, $projects);
    }

    public function testGetProjectFoobar()
    {
        $project = $this->entryPoint->get('foobar');

        $expectedData = [
            'slug' => 'foobar',
            'name' => 'Foobar',
            'default_locale' => 'en',
        ];

        foreach ($expectedData as $key => $value) {
            $this->assertEquals($value, $project[$key]);
        }
    }

    public function testGetProjectNotFound()
    {
        try {
            $this->entryPoint->get('notfound');
        } catch (ClientException $e) {
            $this->assertEquals('404', $e->getResponse()->getStatusCode());
            return;
        }

        $this->fail('ClientException should have be thrown');
    }

    public function testCreateProject()
    {
        $data = [
            'slug' => 'openl10n',
            'name' => 'OpenLocalization',
            'default_locale' => 'en',
        ];

        $project = $this->entryPoint->create($data);

        foreach ($data as $key => $value) {
            $this->assertEquals($value, $project[$key]);
        }
    }

    public function testUpdateProject()
    {
        $this->markTestIncomplete('Find a way to mock PUT requests');
    }

    public function testDeleteProject()
    {
        $this->markTestIncomplete('Find a way to mock DELETE requests');
    }

    public function testGetLanguagesList()
    {
        $languages = $this->entryPoint->getLanguages('foobar');

        $this->assertCount(3, $languages);
        $this->assertContains(['locale' => 'en', 'name' => 'English'], $languages);
        $this->assertContains(['locale' => 'fr', 'name' => 'French'], $languages);
        $this->assertContains(['locale' => 'it', 'name' => 'Italian'], $languages);
    }

    public function testAddLanguage()
    {
        $this->markTestIncomplete('Find a way to mock POST requests');
    }

    public function testDeleteLanguage()
    {
        $this->markTestIncomplete('Find a way to mock DELETE requests');
    }
}
