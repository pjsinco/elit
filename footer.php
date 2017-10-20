<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package elit
 */
?>

      <footer id="colophon" class="footer" role="contentinfo">
        <div class="footer__body">
          <div class="row--full module--footer">
            <div class="size-1-of-2">
            <?php
              if ( function_exists( 'ninja_forms_display_form' ) ) {
                ninja_forms_display_form( 5 );
              } 
            ?>
            </div>
            <div class="size-1-of-2--last">
              <div class="footer__block">
                <h2 class="footer__header--minor">Send us a note</h2>
                <p class="footer__body-text--white">
                  Have a news tip or idea for a story? Send it our way.
                </p>
                <a class="footer__btn--link" href="/drop-us-note">Contact us</a>
              </div>
            </div>
          </div>
          <div class="row--full">
            <h2 class="footer__header--minor">More from the <span><a href="http://www.osteopathic.org/Pages/default.aspx" title="American Osteopathic Association">American Osteopathic Association</a></span></h2>
            <div class="footer__col">
              <h3 class="footer__title">About the AOA</h3>
              <ul class="footer__list">
                <li class="footer__list-item">
                  <a href="http://doctorsthatdo.org/" title="Home - Doctors of Osteopathic Medicine">Doctors That DO</a>
                </li>
                <li class="footer__list-item">
                  <a href="http://www.osteopathic.org/inside-aoa/about/aoa-membership/Pages/default.aspx" title="Enjoy the Benefits of Being an AOA Member">AOA Membership</a>
                </li>
                <li class="footer__list-item">
                  <a href="http://www.osteopathic.org/inside-aoa/about/leadership/Pages/default.aspx" title="Leadership & Policy">Leadership and Policy</a>
                </li>
                <li class="footer__list-item">
                  <a href="http://www.osteopathic.org/inside-aoa/about/affiliates/Pages/default.aspx" title="AOA Affiliates, Partnerships, and Teams">Related Organizations</a>
                </li>
                <li class="footer__list-item">
                  <a href="https://aoa.rangemod.com/RetailSite.asp" title="American Osteopathic Association">AOA Store</a>
                </li>
                <li class="footer__list-item">
                  <a href="http://www.osteopathic.org/inside-aoa/about/Pages/employment-opportunities.aspx" title="Employment Opportunities">Work at the AOA</a>
                </li>
              </ul>
              
              <h3 class="footer__title">Accreditation</h3>
              <ul class="footer__list">
                <li class="footer__list-item">
                  <a href="http://www.osteopathic.org/inside-aoa/accreditation/predoctoral%20accreditation/Pages/default.aspx" title="COM Accreditation">COM Accreditation</a>
                </li>
                <li class="footer__list-item">
                  <a href="http://www.osteopathic.org/inside-aoa/accreditation/postdoctoral-training-approval/Pages/default.aspx" title="Postdoctoral Training Approval">Postdoctoral Training Approval</a>
                </li>
                <li class="footer__list-item">
                  <a href="http://www.osteopathic.org/inside-aoa/accreditation/opti-approval/Pages/default.aspx" title="Osteopathic Postdoctoral Training Institution Approval">OPTI Approval</a>
                </li>
              </ul>
            </div> <!-- .footer__col -->

            <div class="footer__col">
              <h3 class="footer__title">Advocacy</h3>
              <ul class="footer__list">
                <li class="footer__list-item">
                  <a href="http://www.osteopathic.org/inside-aoa/public-policy/federal-legislative-priorities/Pages/default.aspx" title="Federal Legislative Priorities">Legislative Priorities</a>
                </li>
                <li class="footer__list-item">
                  <a href="http://www.osteopathic.org/inside-aoa/public-policy/regulatory-issues/Pages/default.aspx" title="Regulatory Issues">Regulatory Issues</a>
                </li>
                <li class="footer__list-item">
                  <a href="http://www.osteopathic.org/inside-aoa/public-policy/state-government-affairs/Pages/default.aspx" title="State Government Affairs">State Government Affairs</a>
                </li>
              </ul>
              
              <h3 class="footer__title">Education</h3>
              <ul class="footer__list">
                <li class="footer__list-item">
                  <a href="http://opportunities.osteopathic.org/index.htm" title="Opportunities.osteopathic.org">Find a Training Program</a>
                </li>
                <li class="footer__list-item">
                  <a href="http://www.osteopathic.org/inside-aoa/Education/postdoctoral-training/Pages/default.aspx" title="Postdoctoral Training">Postdoctoral Training</a>
                </li>
              </ul>
            </div> <!-- .footer__col -->

            <div class="footer__col--last">
              <h3 class="footer__title">CME Opportunities</h3>
              <ul class="footer__list">
                <li class="footer__list-item">
                  <a href="https://minerva.osteopathic.org" title="Online CME">Online CME</a>
                </li>
                <li class="footer__list-item">
                  <a href="http://www.osteopathic.org/inside-aoa/events/omed/Pages/default.aspx" title="Home - OMED: Osteopathic Medical Conference & Exposition">OMED</a>
                </li>
                <li class="footer__list-item">
                  <a href="http://osteopathic.org/inside-aoa/events/regional-osteopathic-medical-education/Pages/default.aspx" title="AOA ROME Conferences">ROME</a>
                </li>
              </ul>

              <h3 class="footer__title">Professional Development</h3>
              <ul class="footer__list">
                <li class="footer__list-item">
                  <a href="http://www.osteopathic.org/inside-aoa/development/practice-mgt/Pages/default.aspx" title="Practice Management">Practice Management</a>
                </li>
                <li class="footer__list-item">
                  <a href="http://www.osteopathic.org/inside-aoa/development/do-jobs-online/Pages/default.aspx" title="DO Jobs Online">DO Jobs Online</a>
                </li>
                <li class="footer__list-item">
                  <a href="http://www.osteopathic.org/inside-aoa/development/research-and-development/Pages/default.aspx" title="Research and Development">Research and Development</a>
                </li>
              </ul>
              
              <h3 class="footer__title">Physician Profiles</h3>
              <ul class="footer__list">
                <li class="footer__list-item">
                  <a href="https://aoaprofiles.org/" title="AOA Profiles">Order Physician Credentialing Reports</a>
                </li>
              </ul>
              
              <h3 class="footer__title">Other publications</h3>
              <ul class="footer__list">
                <li class="footer__list-item"><a href="http://www.do-online.org/JAOA/JAOA.cfm" title="The Journal of the American Osteopathic Association">JAOA</a>
                </li>
              </ul>
            </div><!-- .footer__col-last -->
          </div><!-- .row -->
        </div> <!-- .footer__container -->

        <div class="row--full module">
          <p class="footer__body-text">
            Copyright <?php echo date('Y'); ?>, American Osteopathic Association. <span>All rights reserved.</span>
          </p>
          <ul class="footer__list--horiz">
            <li class="footer__list-item--horiz">
              <a href="/comment-policy" title="Comment Policy">Comment Policy</a>
            </li>
            <li class="footer__list-item--horiz">
              <a href="<?php bloginfo( 'rss_url' ) ?>" title="RSS feed">RSS</a>
            </li>
            <li class="footer__list-item--horiz">
              <a href="http://www.osteopathic.org/inside-aoa/about/Pages/terms-of-use-agreement.aspx" title="Terms of Use Agreement">Terms of Use</a>
            </li>
            <li class="footer__list-item--horiz">
              <a href="http://www.osteopathic.org/inside-aoa/about/Pages/privacy-policy.aspx" title="Privacy Policy">Privacy Policy</a>
            </li>
            <li class="footer__list-item--horiz">
              <a href="http://www.osteopathic.org/inside-aoa/about/Pages/copyright-notice.aspx" title="Copyright Notice">Copyright Notice</a>
            </li>
          </ul>
        </div><!-- .row -->
      </footer><!-- #colophon -->
    <?php if ( is_dev_env() ): ?>
      <script src="http://localhost:35729/livereload.js"></script>
    <?php endif; ?>
    <?php wp_footer(); ?>
  </body>
</html>

