<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
 
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'blogs', 'action' => 'index'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

	Router::connect('/api/web/scrap', array('controller' => 'apicontent', 'action' => 'scrapdata'));

	Router::connect('/api/web/advancescrap', array('controller' => 'apicontent', 'action' => 'advancescrap'));
	
	Router::connect('/budget/manager/list', array('controller' => 'budgetmanager', 'action' => 'index'));
	
	Router::connect('/budget/manager/add', array('controller' => 'budgetmanager', 'action' => 'add'));
	
	Router::connect('/budget/manager/edit/:id', array('controller' => 'budgetmanager', 'action' => 'edit'), array('pass'=>array('id')));
	
	Router::connect('/budget/manager/remove/:id', array('controller' => 'budgetmanager', 'action' => 'remove'), array('pass'=>array('id')));
	
	Router::connect('/business/unit/add', array('controller' => 'businessunit', 'action' => 'add'));
	
	Router::connect('/business/unit/list', array('controller' => 'businessunit', 'action' => 'index'));
	
	Router::connect('/business/unit/edit/:id', array('controller' => 'businessunit', 'action' => 'edit'), array('pass'=>array('id')));
	
	Router::connect('/business/unit/remove/:id', array('controller' => 'businessunit', 'action' => 'remove'), array('pass'=>array('id')));
	
	Router::connect('/member/signup', array('controller' => 'member', 'action' => 'add'));

	Router::connect('/admin/category', array('controller' => 'category', 'action' => 'index'));

	Router::connect('/getdata', array('controller' => 'ajax', 'action' => 'index'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
