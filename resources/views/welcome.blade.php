

<?php if (\Auth::check()) : ?>
  <?php echo \View::make('dashboard',['user'=>\Auth::user()]); ?>
<?php else :?>
  <?php echo \View::make('auth/login'); ?>
<?php endif; ?>

