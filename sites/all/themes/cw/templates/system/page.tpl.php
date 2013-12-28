<?php
/**
 * @file
 * Alpha's theme implementation to display a single Drupal page.
 */
?>
<div<?php print $attributes; ?>>
  <?php if (isset($page['header'])) : ?>
    <?php print render($page['header']); ?>
  <?php endif; ?>
  <?php if (isset($page['content'])) : ?>
    <?php print render($page['content']); ?>
  <?php endif; ?>
  <div id="hfooter" class="clearfix"></div>
</div>
<?php if (isset($page['footer'])) : ?>
  <?php print render($page['footer']); ?>
  <?php if (!empty($contact_popup)): ?>
    <?php print $contact_popup; ?>
  <?php endif; ?>
<?php endif; ?>
