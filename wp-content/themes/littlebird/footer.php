<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package littlebird
 */
?>

	</div><!-- #content -->

	</div><!-- /.container -->

<div class="content">

<div class="container">

<div class="row section">

  <h2 class="section__title" id="service">Service</h2>

  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 service">
  <a href="http://igfan.jp">
    <div class="thumbnail">
      <img src="<?php bloginfo('template_directory'); ?>/img/service01@2x.png" height="120" width="120" alt="" class="service__image">
      <div class="caption">
        <h3 class="service__title">IG Fan</h3>
        <p class="service__text">instagramとiPhoneographyに関する総合情報サイト。</p>
      </div>
    </div>
  </a>
  </div>

  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 service">
  <a href="http://twpr.jp">
    <div class="thumbnail">
      <img src="<?php bloginfo('template_directory'); ?>/img/service02@2x.png" height="120" width="120" alt="" class="service__image">
      <div class="caption">
        <h3 class="service__title">castella</h3>
        <p class="service__text">TwitterやFacebookなど、色んなSNSでプロフが作れるソーシャルプロフィールサイト。</p>
      </div>
    </div>
  </a>
  </div>

  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 service">
  <a href="http://genpatsu.net">
    <div class="thumbnail">
      <img src="<?php bloginfo('template_directory'); ?>/img/service03@2x.png" height="120" width="120" alt="" class="service__image">
      <div class="caption">
        <h3 class="service__title">原発ニュース</h3>
        <p class="service__text">日本各地の原発施設に関する最新ニュースがチェックできるアプリ。</p>
      </div>
    </div>
  </a>
  </div>

</div>

</div><!-- /.container -->

</div><!-- /.content -->

<div class="container">

<div class="row section section_border_bottom profile">

  <h2 class="section__title" id="profile">Profile</h2>

  <div class="col-xs-12 col-sm-3 col-md-4 col-lg-4 profile__image">
	<img src="<?php bloginfo('template_directory'); ?>/img/youthkee@2x.png" height="80" width="80" alt="">
  </div>

  <div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
        <h3 class="profile__title">Yusuke Takahashi</h3>
        <p class="profile__text">UI設計が大好きなWebデベロッパー。<br>
        サイトの企画、制作、運営やライティングなどやっています。</p>
        <div class="socialButton">
          <a href="https://twitter.com/youthkee"><img src="<?php bloginfo('template_directory'); ?>/img/bt_twitter@2x.png" height="25" width="25" alt=""></a>
          <a href="https://www.facebook.com/youthkee"><img src="<?php bloginfo('template_directory'); ?>/img/bt_facebook@2x.png" height="25" width="25" alt=""></a>
          <a href="http://instagram.com/youthkee"><img src="<?php bloginfo('template_directory'); ?>/img/bt_instagram@2x.png" height="25" width="25" alt=""></a>
        </div>
  </div>

</div>

<div class="row section section_border_bottom contact">

  <h2 class="section__title" id="contact">Contact</h2>

    <p class="contact__text">サイトやサービスに関するお問い合せは下記ボタンより、メールにてご連絡ください。</p>
    <p class="text-center"><a href="mailto:littlebird.mobi@gmail.com" class="btn btn-success linkButton linkButton_icon_left" role="button"><span class="glyphicon glyphicon-envelope"></span>Send Email</a></p>

</div>

</div><!-- /.container -->

	<footer id="colophon" class="site-footer footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'littlebird' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'littlebird' ), 'WordPress' ); ?></a><br>
			<a href="https://github.com/littlebirdjp/littlebird-theme"><i class="fa fa-github fa-lg fa-fw"></i></a>littlebird
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<div class="pagetop" id="pageTop">
  <a href="#page"><i class="fa fa-chevron-up"></i></a>
</div>

<?php wp_footer(); ?>

</body>
</html>
