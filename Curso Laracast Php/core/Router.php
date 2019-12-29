<?php 

class Router {

	protected $routes = [];

	public function define($routes) {

		$this->routes = $routes;
		// print_r($this->routes);
		// echo "rogerio";

	}

	public function direct($uri) {

		//key que esta la no routes about/culture e o uri vme com este valor (routes define)

		// print_r($this->routes);
		// die(print_r($uri));

		if (array_key_exists($uri, $this->routes)) {

			return $this->routes[$uri];  //about/culture
		}

		throw new Exception("No route defined for this URI");
		

	}

}