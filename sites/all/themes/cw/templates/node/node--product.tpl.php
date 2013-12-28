<?php switch($view_mode): ?>
<?php case 'teaser': ?>
<article<?php print $attributes; ?>>
  <?php print render($content['field_product_featured_image']); ?>
  <div<?php print $content_attributes; ?>>
    <?php print render($title_prefix); ?>
    <div class="outerContainer">
      <div class="innerContainer">
        <header><h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2></header>
      </div>
    </div>
    <?php print render($title_suffix); ?>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
    <div class="field button clearfix"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print t('To the description'); ?></a></div>
  </div>
</article>
<?php break; ?>
<?php case 'full': ?>
<article<?php print $attributes; ?>>
  <div class="grid-5 prefix-1 suffix-1">
    <?php if ($link_back_to_products): ?>
    <div class="link-back-top clearfix"><?php print $link_back_to_products; ?></div>
    <?php endif; ?>
    <?php print render($title_prefix); ?>
    <h1 class="title" id="page-title"><?php print $title ?></h1>
    <?php print render($title_suffix); ?>
    <?php if ($link_back_to_products): ?>
    <div class="link-back-bottom clearfix"><?php print $link_back_to_products; ?></div>
    <?php endif; ?>
  </div>
  <div<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>
  <div id="social-holder" class="grid-6"></div>
</article>
<?php break; ?>
<?php default: ?>
<article<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <?php if (!$page && $title): ?>
  <header>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
  </header>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <div<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>
  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
    <?php endif; ?>
    <?php print render($content['comments']); ?>
  </div>
</article>
<?php break; ?>
<?php endswitch; ?>
