<div<?php print $attributes; ?>>
  <div<?php print $content_attributes; ?>>
    <ul id="mobile-main-menu" class="links inline clearfix">
      <?php if (!empty($site_phone)): ?>
      <li class="first"><a href="tel:<?php print $site_phone; ?>" class="phone"><?php print t('Phone'); ?></a></li>
      <?php endif; ?>
      <li><a href="mailTo:<?php print $site_mail; ?>" class="email"><?php print t('Email'); ?></a></li>
      <li class="last"><a href="#" class="menu"><?php print t('Menu'); ?></a></li>
    </ul>
    <?php print $content; ?>
    <?php if ($site_mail || $site_phone): ?>
    <div class="block block-contacts">
      <p><a href="tel:<?php print $site_phone; ?>" class="phone"><?php print $site_phone; ?></a></p>
      <p><a href="mailTo:<?php print $site_mail; ?>" class="email"><?php print $site_mail; ?></a></p>
    </div>
    <?php endif; ?>
    <?php if ($main_menu): ?>
    <nav class="block navigation">
      <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'clearfix', 'main-menu')), 'heading' => array('text' => t('Main menu'),'level' => 'h2','class' => array('element-invisible')))); ?>
    </nav>
    <?php endif; ?>
  </div>
</div>
