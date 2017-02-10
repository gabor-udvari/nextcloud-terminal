<?php
script('terminal', 'vendor/socket.io-client/dist/socket.io');
script('terminal', 'vendor/xterm.js/xterm');
script('terminal', 'vendor/xterm.js/addons/fit/fit');
script('terminal', 'main');
style('terminal', 'vendor/xterm.js/xterm');
style('terminal', 'style');
?>

<div id="app">
	<div id="app-navigation">
		<?php print_unescaped($this->inc('navigation/index')); ?>
		<?php print_unescaped($this->inc('settings/index')); ?>
	</div>

	<div id="app-content">
		<div id="app-content-wrapper">
			<?php print_unescaped($this->inc('content/index')); ?>
		</div>
	</div>
</div>

