<?php

namespace Leogout\Bundle\SeoBundle\Exception;

/**
 * Description of InvalidSeoGeneratorException
 *
 * @author: leogout
 */
class InvalidSeoGeneratorException extends \InvalidArgumentException
{

    public function __construct($configurator, $expectedGenerator, $givenGenerator)
    {
        parent::__construct(
            sprintf(
                'Invalid seo generator passed to %s. Expected "%s", but got "%s".',
                $configurator,
                $expectedGenerator,
                $givenGenerator
            )
        );
    }
}
