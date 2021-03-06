
<div class="navigation">
	<div>
		<?php if(isSet($this->Time) && is_object($this->Time)) { echo $this->Time->nice(time(), $this->Common->timezone()); } ?>
	</div>

	<?php $links = array();

	if ($user) {


        /*switch($loginClient) {
            case 'facebook':
                $links[] = $this->Facebook->logout(array( 'label'=>__d('forum', 'Logout'), 'redirect'=>$config['routes']['logout']));
                //$links[] = $this->Html->link(__d('forum', 'Logout'), $config['routes']['logout']);
                break;

            default:*/
                $links[] = $this->Html->link(__d('forum', 'Logout'), $config['routes']['logout']);
                /*break;
        }*/

		//$links[] = $this->Html->link(__d('forum', 'View New Posts'), array('controller' => 'search', 'action' => 'index', 'new_posts', 'admin' => false));
		$links[] = $this->Html->link(__d('forum', 'Dashboard'), array('controller' => 'users', 'action' => 'dashboard', 'admin' => false));

	} else {
		if (!empty($config['routes']['forgotPass'])) {
			$links[] = $this->Html->link(__d('forum', 'Forgot Password'), $config['routes']['forgotPass']);
		}

		$links[] = $this->Html->link(__d('forum', 'Login'), $config['routes']['login']);

		if (!empty($config['routes']['signup'])) {
			$links[] = $this->Html->link(__d('forum', 'Sign Up'), $config['routes']['signup']);
		}
	}

	foreach ($links as $link) { ?>

		<div>
			<?php echo $link; ?>
		</div>

	<?php }

	if ($user) { ?>

		<div>
			<?php echo sprintf(__d('forum', 'Welcome %s'), $this->Html->link($user['User'][$config['userMap']['username']], array('controller' => 'users', 'action' => 'profile', $user['User']['id'], 'admin' => false))); ?>
		</div>

	<?php } ?>

	<span class="clear"></span>
</div>
