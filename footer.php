      </div><!--End Main Content-->
      <hr class="visible-phone"/>
      <?php
          get_sidebar();
          bebelThemeUtils::getPageFooterTemplate(true);
          if (!is_home()){
              bebelThemeUtils::getLogoTemplate(true);
          }
      ?>

    </div><!-- end .container -->
    <?php
    wp_footer();
    ?>
</body>
</html>