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

  <h2 class="section__title" id="projects">Projects</h2>

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

<div class="row section">

  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 service">
  <a href="http://minecraftkids.jp">
    <div class="thumbnail">
      <img src="<?php bloginfo('template_directory'); ?>/img/service04@2x.png" height="120" width="120" alt="" class="service__image">
      <div class="caption">
        <h3 class="service__title">マインクラフトきっず</h3>
        <p class="service__text">こどものための「Minecraft」ゲーム情報サイト。（準備中）</p>
      </div>
    </div>
  </a>
  </div>

  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 service">
  <a href="http://yumetabi.club">
    <div class="thumbnail">
      <img src="<?php bloginfo('template_directory'); ?>/img/service05@2x.png" height="120" width="120" alt="" class="service__image">
      <div class="caption">
        <h3 class="service__title">yumetabi.club</h3>
        <p class="service__text">夢を追う人と、それを応援する人のためのプロジェクト。（準備中）</p>
      </div>
    </div>
  </a>
  </div>

</div>

</div><!-- /.container -->

</div><!-- /.content -->

<div class="container">

<div class="row section_border_bottom profile">

  <h2 class="section__title" id="profile">Profile</h2>

  <?php $users =get_users( array('orderby'=>ID,'order'=>ASC,'exclude'=>1) );
  $template_directory = get_bloginfo( 'template_directory' );
  foreach($users as $user):
    echo '<div class="row section">'."\n";

    echo '<div class="col-xs-12 col-sm-3 col-md-4 col-lg-4 profile__image">'."\n";
      echo '<div class="profile__imageInner">'."\n";
        echo get_avatar( $user->ID ,80 )."\n";
      echo '</div>'."\n";
    echo '</div>'."\n";

    echo '<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">'."\n";
     echo '<h3 class="profile__title">'.$user->user_firstname.' '.$user->user_lastname.'</h3>'."\n";
     echo '<p class="profile__text">'.$user->user_description.'</p>'."\n";
     echo '<div class="socialButton">'."\n";
       echo '<a href="https://twitter.com/'.$user->user_nicename.'"><img src="'.$template_directory.'/img/bt_twitter@2x.png" height="25" width="25" alt=""></a>'."\n";
       echo '<a href="https://www.facebook.com/'.$user->user_nicename.'"><img src="'.$template_directory.'/img/bt_facebook@2x.png" height="25" width="25" alt=""></a>'."\n";
       echo '<a href="http://instagram.com/'.$user->user_nicename.'"><img src="'.$template_directory.'/img/bt_instagram@2x.png" height="25" width="25" alt=""></a>'."\n";
      echo '</div>'."\n";
    echo '</div>'."\n";

  echo '</div>'."\n";
  endforeach; ?>

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
			<a href="https://github.com/littlebirdjp/littlebird-theme"><i class="fa fa-github fa-lg fa-fw"></i></a>littlebird<br>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<div class="pagetop" id="pageTop">
  <a href="#page"><i class="fa fa-chevron-up"></i></a>
</div>

<?php wp_footer(); ?>

</body>
</html>
