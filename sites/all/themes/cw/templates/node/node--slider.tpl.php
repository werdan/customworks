<?php switch($view_mode): ?>
<?php case 'teaser': ?>
<article<?php print $attributes; ?>>
  <?php print render($content['field_slider_image']); ?>
  <div class="holder">
    <div class="outerContainer">
      <div class="innerContainer">
        <?php print render($title_prefix); ?>
        <?php if ($title): ?>
        <header>
          <h2<?php print $title_attributes; ?>><?php print $title ?></h2>
        </header>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
        <div<?php print $content_attributes; ?>>
          <?php
            // We hide the comments and links now so that we can render them later.
            hide($content['comments']);
            hide($content['links']);
            hide($content['field_slider_image']);
            print render($content);
          ?>
        </div>
      </div>
    </div>
  </div>
</article>
<?php break; ?>
<?php default: ?>
<article<?php print $attributes; ?>>
  <?php print $user_picture; ?>
  <?php print render($title_prefix); ?>
  <?php if (!$page && $title): ?>
  <header>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
  </header>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <?php if ($display_submitted): ?>
  <footer class="submitted"><?php print $date; ?> -- <?php print $name; ?></footer>
  <?php endif; ?>
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
