# Bee Assesment


## Install the packages
```
composer install
```

## Run the code

```
php -S 127.0.0.1:8000 -t public
```

## Modify the bees
`src/Models/Bee/Queen.php`

```php
    /**
     * Bee Name
     * 
     * @var string 
     */
    public $name = 'Queen';

    /**
     * Property used to set a bee dead
     * 
     * @var string 
     */
    public $dead = false;

    /**
     * Property used to store the health level
     * 
     * @var int 
     */
    protected $health = 100; 
    
    /**
     * Health floating point
     * 
     * @var string
     */
    protected $health_point = 20; 
```

Adding new bees can be done by creating a class that extends `\Shiptheory\Models\BaseBee`

```php
namespace Shiptheory\Models\Bee;

/**
 * Queen Bee class
 */
class NewBee extends \Shiptheory\Models\BaseBee
{
    /**
     * Bee Name
     * 
     * @var string 
     */
    public $name = 'NewBee';

    /**
     * Property used to set a bee dead
     * 
     * @var string 
     */
    public $dead = false;

    /**
     * Property used to store the health level
     * 
     * @var int 
     */
    protected $health = 100;  

     /**
     * Health floating point
     * 
     * @var string
     */
    protected $health_point = 40; 
}
```


## API Routes
### Get all the bees 

**Request:**
```json
GET http://127.0.0.1:8000/bees HTTP/1.1
Accept: application/json
Content-Type: application/json
```
**Successful Response:**
```json
HTTP/1.1 200 OK
Host: localhost:8000
Content-Type: application/json

{
    "1": {
        "name": "Queen",
        "dead": true
    },
    "2": {
        "name": "Drone",
        "dead": true
    },
    "3": {
        "name": "Drone",
        "dead": true
    },
    "4": {
        "name": "Drone",
        "dead": true
    },
    "5": {
        "name": "Worker",
        "dead": true
    },
    "6": {
        "name": "Worker",
        "dead": true
    },
    "7": {
        "name": "Worker",
        "dead": false
    },
    "8": {
        "name": "Worker",
        "dead": false
    },
    "9": {
        "name": "Worker",
        "dead": false
    },
    "10": {
        "name": "Worker",
        "dead": false
    }
}
```


### Apply damage to a specific bee

**Request:**
```json
PATCH http://127.0.0.1:8000/bees/2/damage HTTP/1.1
Accept: application/json
Content-Type: application/json
{ "op": "substract", "path": "/health", "value": 20 }
```
**Successful Response:**
```json
HTTP/1.1 200 OK
Host: localhost:8000
Content-Type: application/json

{
    "2": {
        "name": "Drone",
        "dead": false
    }
}
```

## Running Tests
```
./vendor/bin/phpunit tests --debug
```