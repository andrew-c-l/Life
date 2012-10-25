<?php
/**
 * Lim Industries FramEwork. A lightweight PHP MVC Framework
 * @Author	Andrew Lim, Lim Industries <hello@andrew-lim.net>
 *
 * Copyright (c) 2012 Andrew Lim, Lim Industries. All rights reserved.
 * 
 * THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Life
{
	class Bootstrap
	{
		private $_controller;
		private $_action;
		private $_params;
		private $_request;
		
		private $_match;
		
		/**
		 * 
		 * The constructor sets the definiations for the app
		 */
		function __construct()
		{	
			define('MODULES',APPLICATION.'application/modules'.DIRECTORY_SEPARATOR);
			define('HELPERS',APPLICATION.'application/helpers'.DIRECTORY_SEPARATOR);
			define('MODELS',APPLICATION.'application/models'.DIRECTORY_SEPARATOR);
			define('LAYOUTS',APPLICATION.'application/layouts'.DIRECTORY_SEPARATOR);
			define('CONTROLLERS',APPLICATION.'application/controllers'.DIRECTORY_SEPARATOR);
			define('VIEWS',APPLICATION.'application/views/scripts'.DIRECTORY_SEPARATOR);
			define('CONFIGS',APPLICATION.'application/configs'.DIRECTORY_SEPARATOR);
			define('LIBRARY',APPLICATION.'library'.DIRECTORY_SEPARATOR);
			set_include_path(get_include_path() . PATH_SEPARATOR . LIBRARY);
		}
		
		/**
		 * 
		 * Sets up and runs the apllication. And Checks for errors along the way.
		 */
		public function run()
		{
			#
			$this->get_routes();
			
			#
			$this->validate_controller();
			$this->validate_action();
			
			#
			$this->register_vars();
			
			# Set controller and action vars
			$controller_name = $this->_controller . "Controller";
			$action_name = $this->_action . "Action";
			
			#
			require_once CONTROLLERS . $controller_name . '.php';
			$controller = New $controller_name();
			
			$controller->configure();
			$controller->$action_name();
			
			//echo "R: " . print_r($this->_request) . "<br>";
			//echo "C: {$this->_controller}<br>";
			//echo "A: {$this->_action}<br>";
			//echo "P: " . print_r($this->_params) . "<br>";
			
			#
			unset($this->_action);
			unset($this->_controller);
			unset($this->_params);
			unset($this->_request);
			unset($this->_match);
		}
		
		/**
		 * 
		 * Looks at the URL and retrieves routing variables from it.
		 */
		private function get_routes()
		{
			require_once LIBRARY . 'Router/AltoRouter.php';
			
			# route the application
			$router = new \AltoRouter();
			$router->setBasePath($this->get_base_path());
			$router->map('GET|POST','/[:controller]', NULL);
			$router->map('GET|POST','/[:controller]/', NULL);
			$router->map('GET|POST','/[:controller]?/[:action]/', NULL);
			$router->map('GET|POST','/[:controller]?/[:action]/[**:trailing]?', NULL);
			
			# match current request
			$this->_match = $router->match();
			//print_r($this->_match);
			
			$this->_controller = @$this->_match['params']['controller'];
			$this->_action = @$this->_match['params']['action'];
			$this->_params = explode("/", @$this->_match['params']['trailing']);
			$this->_request = "";
			if($_REQUEST)
			{
				$this->_request = $_REQUEST;
			}
			
			# Handle empty vars
			if(!$this->_controller)
				$this->_controller = "home";
			
			if(!$this->_action)
				$this->_action = "index";
		}
		
		/**
		 * 
		 * Get the current URL
		 * 
		 * @return String
		 */
		private function get_base_path()
		{
			//$folder = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")+1);
			$folder = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")); 
			
			return $folder;
		}
		
		/**
		 * 
		 * Checks if the Controller file exists. If no match can be found the Apllication is re-routed to the Error page.
		 */
		private function validate_controller()
		{
			# Set controller and action vars
			$controller_name = $this->_controller . "Controller";
			$action_name = $this->_action . "Action";
			
			# check if controller file exists
			if(!file_exists(APPLICATION . 'application/controllers/' . $controller_name . '.php'))
			{
				# If no controller file 
				$this->_controller = 'error';
				$this->_action = 'index';
			}
		}
		
		/**
		 * 
		 * Checks if the Action method exists in the controller. If no match can be found the Apllication is re-routed to the Error page.
		 */
		private function validate_action()
		{
			# Set controller and action vars
			$controller_name = $this->_controller . "Controller";
			$action_name = $this->_action . "Action";
			
			# Load controller
			require_once CONTROLLERS . $controller_name . '.php';
			$controller = New $controller_name();
			
			# check if action exists
			if(!method_exists($controller, $action_name))
			{
				# overwite controller
				$this->_controller = 'error';
				$this->_action = 'index';
			}
			
			unset($controller);
		}
		
		/**
		 * 
		 * Registers Application variables so that they can be accessed by other Classes.
		 */
		private function register_vars()
		{
			# register vars
			require_once LIBRARY . 'Zend/Registry.php';
			$registry = \Zend_Registry::getInstance();
			$registry->controller = $this->_controller;
			$registry->action = $this->_action;
			$registry->params = $this->_params;
			$registry->request = $this->_request;
		}
	}
}