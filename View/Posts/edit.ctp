<?php

if (!empty($post['Forum']['Parent']['slug'])) {
	$this->Breadcrumb->add($post['Forum']['Parent']['title'], array('controller' => 'stations', 'action' => 'view', $post['Forum']['Parent']['slug']));
}

$this->Breadcrumb->add($post['Forum']['title'], array('controller' => 'stations', 'action' => 'view', $post['Forum']['slug']));
$this->Breadcrumb->add($post['Topic']['title'], array('controller' => 'topics', 'action' => 'view', $post['Topic']['slug']));
$this->Breadcrumb->add(__d('forum', 'Edit Post'), array('action' => 'edit', $post['Topic']['slug'])); ?>

<div class="title">
	<h2><?php echo __d('forum', 'Edit Post'); ?></h2>
</div>

<?php echo $this->Form->create('Post'); ?>

<div class="container">
	<div class="containerContent">
		<?php
		echo $this->Form->input('content', array(
			'type' => 'textarea',
			'rows' => 15,
			'after' => '<span class="inputText">[b], [u], [i], [s], [img], [url], [email], [color], [size], [left], [center], [right], [justify], [list], [olist], [li], [quote], [code]</span>',
			'label' => __d('forum', 'Content')));

		echo $this->element('markitup', array('textarea' => 'PostContent')); ?>
	</div>
</div>

<?php
echo $this->Form->submit(__d('forum', 'Update Post'), array('class' => 'button'));
echo $this->Form->end(); ?>