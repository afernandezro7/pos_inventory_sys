<?php

require_once "config/parameters.php";
require_once "models/connection.php";
require_once "models/category.model.php";
require_once "models/client.model.php";
require_once "models/product.model.php";
require_once "models/sell.model.php";
require_once "models/user.model.php";

require_once "helpers/helpers.php";

require_once "controllers/categories.controller.php";
require_once "controllers/clients.controller.php";
require_once "controllers/default.controller.php";
require_once "controllers/products.controller.php";
require_once "controllers/sells.controller.php";
require_once "controllers/users.controller.php";


DefaultController:: renderTemplate();