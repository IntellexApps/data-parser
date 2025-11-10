<?php declare(strict_types = 1);

namespace Intellex\DataParser\Exceptions;

use Throwable;

/**
 * Class could not be built as it is missing a property.
 */
class NoValueForClassProperty extends AbstractDataParserException {

	/**
	 * @param class-string $className    The name of the class for which there is no data.
	 * @param string       $propertyName The name of the property for which there is no data
	 * @param array<mixed> $sourceData   The data that does not have the value for teh requested property.
	 */
	public function __construct(
		public readonly string $className,
		public readonly string $propertyName,
		public readonly array $sourceData,
		?Throwable $previous = null,
	) {
		parent::__construct(
			"Data set does not have value for {$className}::{$propertyName}",
			$previous
		);
	}
}
