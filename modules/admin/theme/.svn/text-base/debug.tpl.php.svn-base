<?php if(!empty($categories)):
	$this->addCSS('admin', "theme/css/debug.css");
	$this->addJS('admin', "theme/js/debug.js");
?>
<div id='agave-debug'>
	<div id='debug-background'>
	<span id='debug-button' class='debug-header'></span>
		<?php foreach($categories as $category=>$functions): ?>
		<div class='debug-category debug-box'>
			<h3><?php print $category?></h3><hr />
			<div class='debug-box'>
			<ul>
			<?php foreach($functions as $function=>$items): ?>
			<li class='debug-function'>
				<h4 class='debug-header debug-function-header'><em><?php print $function ?>()</em></h4>
				<div class='debug-box'>
				<ol>
				<?php foreach($items as $item): ?>
					<li class='debug-item'>
						<div class='debug-message'><?php print $item['message'] ?></div>
						<div class='debug-args'>
						<?php if($item['args']): ?>
							<ol>Arguments (in order):
								<li>
								<?php print implode("</li><li>", $item['args']) ?>
								</li>
							</ol>
						<?php else: ?>
							<em>No arguments passed to function</em>
						</div>
						<?php endif; ?>
						<div class='debug-footer'><small><?php print "Line <em><b>".$item['line']."</b></em> of <em>".$item['file']."</em>" ?></small></div>
					</li>
				<?php endforeach; ?>
				</ol>
				</div>
			</li>
			<?php endforeach; ?>
			</ul>
			</div>
		</div>
		<?php endforeach; ?>
		<hr />
		<h5>URL info</h5>
		<pre><?php print print_r($agave->uri, TRUE); ?></pre>
		<hr />
		<p>Format for debug call:<br />
		<code>$agave->debug($debugMessage, __METHOD__, $funcArgs, __LINE__, __FILE__, $this->debugFilter);</code></p>
		<p>Time to process: <?php print agave_timer_return() ?> seconds (approx).</p>
	</div>
</div>
<?php endif; ?>