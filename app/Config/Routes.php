    <?php

    use CodeIgniter\Router\RouteCollection;

    /**
     * @var RouteCollection $routes
     */
    $routes->get('/', 'Home::index');

    $routes->get('/users', "Users::index");
    $routes->post('/users/login', "Users::login");
    $routes->post('/users/createAdmin', "Users::createAdmin");
//Blog
    $routes->get('/blog', "Blog::index");
    $routes->get('/blog/(:num)', "Blog::show/$1");
    $routes->post('/blog', "Blog::create");
    $routes->post('/blog/(:num)', "Blog::edit/$1");
    $routes->delete('/blog/(:num)', "Blog::delete/$1");


