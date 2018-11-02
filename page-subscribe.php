<?php 
/**
 * Template Name: Subscribe
 *
 */
?>

<?php get_header(); ?>

<?php $layout = 'one-col'; ?>

    <div id="main" class="content">
      <?php while(have_posts()): the_post(); ?>

        <div class="subscribe__container row--full">
          <div class="subscribe__body">
            <hgroup>
              <h1 class="subscribe__header">Get your weekly dose of news and features about the osteopathic profession</h1>
              <a class="subscribe__subhead" href="#">Check it out! <i class="icon"><svg viewBox="0 0 15 16" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid meet"><path d="M14.2801499,0.821663534 L9.54594656,0.821663534 C9.16635208,0.821663534 8.85871551,1.13253838 8.85871551,1.5161286 C8.85871551,1.89971881 9.16635208,2.21059366 9.54594656,2.21059366 L12.697406,2.21059366 L5.95316731,9.0258243 C5.68464548,9.29700591 5.68464548,9.73680043 5.95316731,10.007982 C6.08734571,10.1435728 6.2632795,10.2114516 6.43904825,10.2114516 C6.614817,10.2114516 6.79075079,10.1435728 6.92492919,10.007982 L13.5929189,3.26963621 L13.5929189,6.29999889 C13.5929189,6.68358911 13.9005554,6.99446396 14.2801499,6.99446396 C14.6597444,6.99446396 14.967381,6.68358911 14.967381,6.29999889 L14.967381,1.5161286 C14.967381,1.13253838 14.6597444,0.821663534 14.2801499,0.821663534 Z"></path><path d="M11.9030633,7.81568057 C11.5234688,7.81568057 11.2158322,8.12655542 11.2158322,8.51014563 L11.2158322,13.9891481 C11.2158322,14.2401495 11.006065,14.4521248 10.7576782,14.4521248 L1.99564728,14.4521248 C1.74726045,14.4521248 1.53749324,14.2401495 1.53749324,13.9891481 L1.53749324,5.13488531 C1.53749324,4.88388389 1.74726045,4.6719086 1.99564728,4.6719086 L7.43672157,4.6719086 C7.81631605,4.6719086 8.12395263,4.36103375 8.12395263,3.97744354 C8.12395263,3.59385333 7.81631605,3.28297848 7.43672157,3.28297848 L1.99564728,3.28297848 C0.98510075,3.28297848 0.163031136,4.11370146 0.163031136,5.13488531 L0.163031136,13.9891481 C0.163031136,15.010332 0.98510075,15.8410549 1.99564728,15.8410549 L10.7576782,15.8410549 C11.7682247,15.8410549 12.5902943,15.010332 12.5902943,13.9891481 L12.5902943,8.51014563 C12.5902943,8.1267222 12.2826577,7.81568057 11.9030633,7.81568057 Z"></path></svg></i></a>
            </hgroup>
            <div class="form-placeholder" style="width: 100%; height: 60px; margin-bottom: 2rem; border: 1px solid #ef3f23;"><span style="width: 33%; text-align: center; line-height: 1.5; background-color: #ef3f23; color: #fff; float: right; height: 100%; padding: 1rem; display: block;">Subscribe</span></div>
            <p class="subscribe__graf">
              Published by the American Osteopathic Association, The DO is dedicated to issues that are important to osteopathic physicians and medical students.
            </p>
          </div>
        </div> <!-- .subscribe__container -->

        <!-- SOCIAL -->
        <div class="row--full">
          <?php get_template_part( 'social', 'pick-note' ); ?>
        </div>

      <?php endwhile; ?>

    </div> <!-- #main -->

<?php get_footer(); ?>

