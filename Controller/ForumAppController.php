<?php
/**
 * ForumAppController
 *
 * @author      Miles Johnson - http://milesj.me
 * @copyright   Copyright 2006-2011, Miles Johnson, Inc.
 * @license     http://opensource.org/licenses/mit-license.php - Licensed under The MIT License
 * @link        http://milesj.me/code/cakephp/forum
 */

if (!defined('FORUM_USER')) {
	define('FORUM_USER', Configure::read('Forum.userModel'));
}
App::uses('ClassRegistry', 'Utility');
Configure::write('Forum.settings', ClassRegistry::init('Forum.Setting')->getSettings());

class ForumAppController extends AppController {

	/**
	 * Remove parent models.
	 *
	 * @access public
	 * @var array
	 */
	public $uses = array();

	/**
	 * Components.
	 *
	 * @access public
	 * @var array
	 */
	public $components = array('Session', 'Security', 'Cookie', 'Auth'=>array('loginAction'=>array('controller'=>'Accounts','action'=>'login')), 'Forum.ForumToolbar'/*, 'Forum.AutoLogin'*/);

	/**
	 * Helpers.
	 *
	 * @access public
	 * @var array
	 */
	public $helpers = array('Html', 'Session', 'Form', 'Time', 'Text', 'Forum.Common', 'Utility.Breadcrumb', 'Utility.OpenGraph');

	/**
	 * Plugin configuration.
	 *
	 * @access public
	 * @var array
	 */
	public $config = array();

	/**
	 * Database forum settings.
	 *
	 * @access public
	 * @var array
	 */
	public $settings = array();

	/**
	 * Run auto login logic.
	 *
	 * @access public
	 * @param array $user
	 * @return void
	 */
	/*public function _autoLogin($user) {
		ClassRegistry::init('Forum.Profile')->login($user['User']['id']);

		$this->Session->delete('Forum');
	}*/

	/**
	 * Before filter.
	 */
	public function beforeFilter() {
		parent::beforeFilter();

		$this->set('menuTab', '');

		// Admin
		if (isset($this->request->params['admin'])) {
			$this->ForumToolbar->verifyAdmin();
			$this->layout = 'admin';
		}

		// Settings
		$this->config = Configure::read('Forum');
		$this->settings = Configure::read('Forum.settings');

		// Localization
        /*$locale = $this->settings['default_locale'];
        if($this->Session->read('Config.locate')) {
            Configure::write('Config.language', $this->Session->read('Config.locate'));
            $locale = $this->Session->read('Config.locate');
        }*/

		/*$locale = $this->Auth->user('locale') ? $this->Auth->user('locale') : $this->settings['default_locale'];
		Configure::write('Config.language', $locale);
		setlocale(LC_ALL, $locale .'UTF8', $locale .'UTF-8', $locale, 'eng.UTF8', 'eng.UTF-8', 'eng', 'en_US'); */

        /*// Authorization
          $referer = $this->referer();
          $routes = $this->config['routes'];

          if (empty($referer) || $referer == '/forum/users/login' || $referer == '/admin/forum/users/login') {
              $referer = array('plugin' => 'forum', 'controller' => 'forum', 'action' => 'index');
          }

          $this->Auth->loginAction = $routes['login'];
          $this->Auth->autoRedirect = false;
          $this->Auth->loginRedirect = $referer;
          $this->Auth->logoutRedirect = $referer;*/

		// AutoLogin
		/*$this->AutoLogin->settings = array(
			'model' => 'User',
			'username' => $this->config['userMap']['username'],
			'password' => $this->config['userMap']['password'],
			'plugin' => $routes['login']['plugin'],
			'controller' => $routes['login']['controller'],
			'loginAction' => $routes['login']['action'],
			'logoutAction' => $routes['logout']['action']
		);*/

		// Initialize
		$this->ForumToolbar->initForum();
	}

	/**
	 * Before render.
	 */
	public function beforeRender() {
		$user = $this->Auth->user();

		if ($user) {
			$user = array('User' => $user);
		}

		$this->set('user', $user);
		$this->set('config', $this->config);
		$this->set('settings', $this->settings);
	}

}
