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
	class Controller
	{
		public $controller;
		public $action;
		public $params;
		public $request;
		
		public $layout = "default";
		public $view;
		
		public $head_script;
		public $end_script;
		
		public $base_url;
		
		function __construct()
		{	
			# 
		}
		
		public function configure()
		{
			# Do not edit below...
			
			# Get page variables
			require_once LIBRARY . 'Zend/Registry.php';
			$this->controller = \Zend_Registry::get('controller');
			$this->action = \Zend_Registry::get('action');
			$this->params = \Zend_Registry::get('params');
			$this->request = \Zend_Registry::get('request');
			
			# Set view scripts
			# Main view
			$this->view = VIEWS . $this->controller . '/' . $this->action. '.phtml';
			# Head script. For Javascript and CSS code for the HTML head in the view.
			$this->head_script = VIEWS . $this->controller . '/' . $this->action. 'HeadScript.phtml';
			if(!file_exists($this->head_script))
			{
				$this->head_script = null;
			}
			# End script. For Javascript in the at end of the view HTML 
			$this->end_script = VIEWS . $this->controller . '/' . $this->action. 'EndScript.phtml';
			if(!file_exists($this->end_script))
			{
				$this->end_script = null;
			}
			
			#
			$this->init();
		}
		
		private function pre_dispatch()
		{
			
		}
		
		private function post_dispatch()
		{
			
		}
	}
}