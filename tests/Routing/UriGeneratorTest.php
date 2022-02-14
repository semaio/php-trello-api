<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Routing;

use PHPUnit\Framework\TestCase;
use Semaio\TrelloApi\Configuration\Configuration;
use Semaio\TrelloApi\Routing\UriGenerator;

/**
 * Class UriGeneratorTest.
 */
class UriGeneratorTest extends TestCase
{
    /**
     * @test
     */
    public function itCanGenerateUrl(): void
    {
        $uriGenerator = new UriGenerator(Configuration::create('KEY', 'TOKEN'));

        static::assertEquals(
            'https://api.trello.com/1/path?query1=value1&query2=value2&key=KEY&token=TOKEN',
            $uriGenerator->generate(
                'path',
                [
                    'query1' => 'value1',
                    'query2' => 'value2',
                ]
            )
        );
    }
}
