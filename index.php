<?php

require_once('vendor/autoload.php');

use App\Controllers\UserController;
use Bramus\Router\Router;

$router = new Router;

# Routes examples:

$router->get("/welcome", function(){
    echo "welcome";
});

# /
$router->get("/", function(){
    include("./resources/views/home.php");
});

# /employee      employee?id=60
$router->get("/employee", function(){
    if(isset($_GET['id'])){
        echo "employee with id: ". $_GET['id'];
    }else{
        echo "employee";
    }
});


# /user
$router->get("/user", 'App\Controllers\UserController@index');

# /user/create
$router->get("/user/create", 'App\Controllers\UserController@create');

# /user/edit
$router->get("/user/edit/{user}", [UserController::class, 'edit']);

# /user/admin
$router->get("/user/{profile}", function($profile){
    echo "usuario: " . $profile;
});

# \d+ = One or more digits (0-9)
$router->get('/hello/(\d+)', function($name) {
    echo 'Hello ' . htmlentities($name);
});

# /movies/10/photos/1
$router->get('/movies/{movieId}/photos/{photoId}', function($movieId, $photoId) {
    echo 'Movie #' . $movieId . ', photo #' . $photoId;
});

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo "404 Nothing Here 😗";
});


$router->set404('/api(/.*)?', function() {
    header('HTTP/1.1 404 Not Found');
    header('Content-Type: application/json');

    $jsonArray = array();
    $jsonArray['status'] = "404";
    $jsonArray['status_text'] = "route not defined";

    echo json_encode($jsonArray);
});


$router->run();


?>