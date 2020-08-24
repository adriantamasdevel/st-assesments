<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;
use Shiptheory\Storage\DB;

use Shiptheory\Models\Bee;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

// Add Error Handling Middleware
$app->addErrorMiddleware(true, false, false);

// set the parse vody as a middleware
$mw = function (Request $request, RequestHandler $handler) {
    $contentType = $request->getHeaderLine('Content-Type');

        if (strstr($contentType, 'application/json')) {
            $contents = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $request = $request->withParsedBody($contents);
            }
        }

        return $handler->handle($request);
};

//Load the Data from local storage
$bees = DB::load();

// if running for the first time then generate the data and save it 
if(empty($bees)) {
    $bees[1] = new Bee\Queen();
    $bees[2] = new Bee\Drone();
    $bees[3] = new Bee\Drone();
    $bees[4] = new Bee\Drone();
    $bees[5] = new Bee\Worker();
    $bees[6] = new Bee\Worker();
    $bees[7] = new Bee\Worker();
    $bees[8] = new Bee\Worker();
    $bees[9] = new Bee\Worker();
    $bees[10] = new Bee\Worker();

    // save the data
    DB::save($bees);
}
// Th healtcheck route
$app->get('/', function (Request $request, Response $response, $args) {
    $payload = json_encode(['health'=> 'ok'], JSON_PRETTY_PRINT);
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
});

// Returning the bees with their life status
$app->get('/bees', function (Request $request, Response $response, $args) use ($bees) {
    $payload = json_encode($bees, JSON_PRETTY_PRINT);
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
})->add($mw);

// Apply damage to a specific bee
$app->patch('/bees/{id}/damage', function (Request $request, Response $response, $args) use ($app, $bees) {
    
    // parse the request body
    $parsedBody = $request->getParsedBody();

    // assing the argument value for {id}
    $id = $args['id'];


    switch ($parsedBody['op']) {
        // if the request is for substract and the value is numeric 
        // then apply the damage
        case "substract": 
            if($parsedBody['path'] == '/health' && is_numeric($parsedBody['value'])) {
                
                // applied the damage
                $bees[$id]->damage($parsedBody['value']);
                
                // save the new data
                DB::save($bees);

                $payload = json_encode($bees[$id], JSON_PRETTY_PRINT);
                $response->getBody()->write($payload);
                return $response->withHeader('Content-Type', 'application/json');

            } else {
                // if the request is not valid then return an error 
                $payload = ['error' => 'Invalid request. Please check the request body.'];

                $response->getBody()->write(
                    json_encode($payload, JSON_PRETTY_PRINT)
                );
                return $response->withHeader('Content-Type', 'application/json')->withStatus((400));    
            }
            break;
        default:
            // handle the default request and return an error
            $payload = ['error' => 'Invalid request. Please check the request body.'];

            $response->getBody()->write(
                json_encode($payload, JSON_PRETTY_PRINT)
            );
            return $response->withHeader('Content-Type', 'application/json')->withStatus((400));    
            break;
    }

    
    
})->add($mw);

$app->run();