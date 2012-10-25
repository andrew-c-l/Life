<?php
/**
 * Lim Industries FramEwork
 *  
 * @Author	Andrew Lim, Lim Industries <hello@andrew-lim.net>
 *
 * Copyright (c) 2012 Andrew Lim, Lim Industries. All rights reserved.
 * 
 * THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

# Set environment - Development, Testing, Production
define('ENVIRONMENT', "Development"); //Development, Testing, Production
if(ENVIRONMENT == "Development" || ENVIRONMENT == "Testing")
{
	define('DEBUG', true);
}
else
{
	define('DEBUG', false);
}

if(DEBUG)
{
    // set debug settings
    ini_set("display_errors", "1");
    // Report all PHP errors (see changelog)
    error_reporting(E_ALL);
    ini_set('error_reporting', E_ALL);
}
else
{
    // deactivate error messages, debug info etc..
    // set debug settings
    ini_set("display_errors", "0");
    // Report all PHP errors (see changelog)
    error_reporting(0);
    ini_set('error_reporting', 0);
}

# Application path
define('APPLICATION', 'life_app/');

# bootstrap
require_once APPLICATION . 'library/Life/bootstrap/Bootstrap.php';
$bootstrap = new \Life\Bootstrap();
$bootstrap->run();
?>