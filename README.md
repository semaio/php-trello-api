PHP Trello API v1 client
========================

![tests](https://github.com/semaio/php-trello-api/workflows/run-tests/badge.svg?branch=master)

This library is based on the great [php-trello-api](https://github.com/cdaguerre/php-trello-api/) but updated and modernized for usage with PHP 8.2+ and a modern version of Guzzle.

**Important:** Not all components have been thoroughly tested, especially the webhook behaviour.

## Installation

The recommended way is using [composer](http://getcomposer.org):

```bash
$ composer require semaio/php-trello-api
```

## Usage

Basic example for card creation:

```
namespace MyProject;
use Semaio\TrelloApi;

require 'vendor/autoload.php';


$client_builder = new TrelloApi\ClientBuilder();
$client         = $client_builder->build( $trello_api_key, $trello_api_token ); // Change $trello_api_key and $trello_api_token
$card = array(
    'name'   => 'Card subject',
    'desc'   => 'Card content',
    'pos'    => '1',
    'idList' => $list_id, // Set a list ID
    'labels' => array( $label ),
);
$client->getCardApi()->create( $card );
```

## Support

If you encounter any problems or bugs, please create an issue on [GitHub](https://github.com/semaio/php-trello-api/issues).

## Contribution

Any contribution to the development of `php-trello-api` is highly welcome. The best possibility to provide any code is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).

## License

[MIT License](https://opensource.org/licenses/mit). See the [LICENSE.txt](LICENSE.txt) file for more details.
