<?php

namespace Openl10n\Sdk\EntryPoint;

use Openl10n\Sdk\Model\Translation;

class TranslationEntryPoint extends AbstractEntryPoint
{
	public function getName()
	{
		return 'translation';
	}

	public function findBy()
	{
		throw new \BadMethodCallException('Not implemented yet!');
	}

	public function get($id)
	{
		throw new \BadMethodCallException('Not implemented yet!');
	}

	public function create(Translation $translation)
	{
		throw new \BadMethodCallException('Not implemented yet!');
	}

	public function update(Translation $translation)
	{
		throw new \BadMethodCallException('Not implemented yet!');
	}

	public function delete(Translation $translation)
	{
		throw new \BadMethodCallException('Not implemented yet!');
	}
}
