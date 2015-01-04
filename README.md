# littlebird-theme

A simple WordPress theme build with _s and Bootstrap 3.

[_s](http://underscores.me/)と[Bootstrap](http://getbootstrap.com/)を使ってシンプルなWordPressテーマを作ってみようという個人プロジェクトです。  
以前制作した[littlebird-site](https://github.com/littlebirdjp/littlebird-site)のLESSファイルを流用して、WPサイトと本サイトを統合。最終的にはプラグインでコンテンツを静的化して、Amazon S3上で運用することを目標としています。

## URL

[http://littlebird.mobi](http://littlebird.mobi)

## Requrements（制作ツール）

- WordPress
- _s
- Bootstrap 3.2
- JQuery 1.11.1 or later
- Sketch 3.1.1 or later
- Virtual Box
- Vagrant

## 制作過程（随時更新中）

1. [ローカル仮想環境の構築](#user-content-ローカル仮想環境の構築)
	- [Virtual Boxのインストール](#user-content-virtual-boxのインストール)
	- [Vagrantのインストール](#user-content-vagrantのインストール)
	- [VCCWのインストール](#user-content-vccwのインストール)
	- [VCCWの初期設定](#user-content-vccwの初期設定)
	- [VCCWの環境構築](#user-content-vccwの環境構築)
	- [仮想環境の動作確認](#user-content-仮想環境の動作確認)
		- [ホストネームでアクセスするには](#user-content-ホストネームでアクセスするには)
2. [テーマ開発の環境準備](#user-content-テーマ開発の環境準備)
	- [_sのダウンロード](#user-content-_sのダウンロード)
	- [_sのインストール](#user-content-_sのインストール)
	- [Bootstrapのインストール](#user-content-bootstrapのインストール)
	- [Gruntのセットアップ](#user-content-gruntのセットアップ)
3. [テーマの編集](#user-content-テーマの編集)
	- [オリジナルCSSの移植](#user-content-オリジナルcssの移植)
	- [テーマへのCSSとJSの組み込み](#user-content-テーマへのcssとjsの組み込み)
	- [リセットCSSの削除](#user-content-リセットcssの削除)
	- [コーディング](#user-content-コーディング)
		- [ヘッダーメニューの組み込み](#user-content-ヘッダーメニューの組み込み)
		- [ヘッダータイトルの組み込み](#user-content-ヘッダータイトルの組み込み)
		- [フッター要素の組み込み](#user-content-フッター要素の組み込み)
		- [コンテンツ部分のスタイル調整](#user-content-コンテンツ部分のスタイル調整)
		- [OGPの設定](#user-content-ogpの設定)
		- [ソーシャルボタンの設置](#user-content-ソーシャルボタンの設置)
4. [WordPressコンテンツの静的化](#user-content-wordpressコンテンツの静的化)
	- [プラグインのインストール](#user-content-プラグインのインストール)
	- [プラグインの検証](#user-content-プラグインの検証)
		- [StaticPress](#user-content-staticpress)
		- [Really Static](#user-content-really-static)
		- [StaticPressとReally Staticの比較](#user-content-staticpressとreally-staticの比較)
5. サイトの公開
	- 共通ファイルのアップロード
	- コンテンツのアップロード
6. Amazon S3への移行

### ローカル仮想環境の構築

WordPressの仮想環境を簡単に構築できる[VCCW](http://vccw.cc/)で、ローカルに作業環境を準備しました。  
また、そのために必要な、[Virtual Box](https://www.virtualbox.org/)と[Vagrant](https://www.vagrantup.com/)も合わせてインストールしました。  
※以下のセットアップおよび制作過程は、Mac OS X 10.9.5環境にて行っています。

#### Virtual Boxのインストール

Virtual Boxの[ダウンロードページ](https://www.virtualbox.org/wiki/Downloads)から、Mac OS X版のパッケージをダウンロードし、インストールを実行しました。

#### Vagrantのインストール

Vagrantの[ダウンロードページ](https://www.vagrantup.com/downloads.html)から、Mac OS X版のパッケージをダウンロードし、インストールを実行しました。

#### VCCWのインストール

まずプロジェクト用の作業ディレクトリを作成し、そこにVCCWのGitリポジトリをcloneする方法でインストールしました。  
今回、作業ディレクトリは以下のパスとしています。
```
~/prj/littlebird/
```
作業ディレクトリ上でターミナルを開いて、以下のコマンドを実行しました。
```
$ git clone git@github.com:miya0001/vccw.git
```
すると、`~/prj/littlebird/vccw/`というサブディレクトリが作成されるので、そちらに移動します。

次に、Vagrantfile.sampleをコピー＆リネームし、Vagrantfileを作成。そして、必要な箇所を編集しました。  
今回は、主に以下の記述を変更してあります。
```
WP_LANG              = ENV["wp_lang"] || "ja" # WordPress locale (e.g. ja)
WP_HOSTNAME          = "littlebird.local" # e.g example.com
WP_IP                = "192.168.33.10" # host ip address
WP_HOME              = "" # path to WP_HOME, e.g blank or /wp or ...
WP_SITEURL           = "" # path to WP_SITEURL, e.g blank or /wp or ...
WP_TITLE             = "littlebird" # title
WP_DB_PREFIX         = 'lb_' # Database prefix
```

#### VCCWの環境構築

設定が完了したら、`~/prj/littlebird/vccw/`上でターミナルを開いて「vagrant up」コマンドを実行します。  
初回のみ、環境構築に20分ほどかかり、ターミナルのメッセージがときどき止まりますが、構築完了まで気長に待ちましょう。  

※コマンド実行中に余計なキーを叩くと、処理が中断され、最後まで環境構築されない場合があるので、注意してください。（作業ディレクトリ内にWordPressのファイルが作成されない等）  
構築に失敗した場合は、いったん「vagrant destroy」で環境を破棄して、再度「vagrant up」を実行すれば、最初から構築をやり直すことができます。

#### 仮想環境の動作確認

環境構築が完了したら、先ほど設定したIPアドレス（192.168.33.10）をブラウザで叩いてアクセスします。  
WordPressの画面（デフォルトテンプレートでインストールされた状態）が表示されたら、VCCWのセットアップ成功です。

![](screenshots/screenshot01.png?raw=true)

##### ホストネームでアクセスするには

IPではなく、Vagrantfileで設定したホストネーム（littlebird.local）でアクセスできるようにするには、vagrant-hostsupdaterというプラグインをインストールする必要があります。ターミナルで以下のコマンドを実行して、vagrant-hostsupdaterをインストールしてください。
```
vagrant plugin install vagrant-hostsupdater
```
インストール中にエラーメッセージが表示される場合は、[Homebrew](http://brew.sh/)と[Nokogiri](https://rubygems.org/gems/nokogiri)のgemをインストールしてください。

※ホストネームでのアクセスは、仮想環境の構築後でも適用可能です。一度「vagrant halt」で仮想マシンを停止してから、再度「vagrant up」で起動すれば、ホストネームでもアクセスできるようになります。

### テーマ開発の環境準備

次に今回、Automattic社が提供しているスターターテーマ「_s（Underscores）」をベースに使いたかったので、_sのインストールを行いました。  

#### _sのダウンロード

_sをダウンロードするには、_sの[公式サイト](http://underscores.me/)にアクセスし、「CREATE YOUR UNDERSCORES BASED THEME」というタイトルの横の「Advanced Options」を選択し、必要な項目を入力してから、「GENERATE」ボタンをクリックします。

![](screenshots/screenshot02.png?raw=true)

今回は、以下のように入力しました。
```
Theme Name: littlebird
Theme Slug: littlebird
Theme URI: http://underscores.me/
Author: Yusuke Takahashi
Author URI: http://littlebird.mobi
Description: A simple WordPress theme.
```
すると、「littlebird.zip」という名前のファイルがダウンロードされます。

#### _sのインストール

_sをインストールするには、解凍したフォルダ（/littlebird/）一式を、WordPressのテーマディレクトリ内にコピーします。  
今回は`~/prj/littlebird/`以下にVCCWのローカル環境が構築されているので、下記のディレクトリ以下に設置する形になります。

```
~/prj/littlebird/vccw/www/wordpress/wp-content/themes/
```
この状態で、_sのベーステーマを管理画面から選択できるようになりました。

![](screenshots/screenshot03.png?raw=true)

管理画面にログインして、「外観」→「テーマ」へ進むと、「littlebird」というテーマが新たに表示されるので、そちらを選択して「有効化」をクリックしてみましょう。

![](screenshots/screenshot04.png?raw=true)

すると、サイトの方はこんな感じでまっさらなデザインになりました。

#### Bootstrapのインストール

続いて、Bootstrapを導入するため、テーマフォルダ内にBootstrapをインストールしました。

[littlebird-site](https://github.com/littlebirdjp/littlebird-site)の時と同じように、Bowerでインストールしてもよかったのですが、今回はこもりまさあきさんが日本語向けに文字回りの調整を行なった[Jbootstrap](https://github.com/gaspanik/jbootstrap)を使うことにしました。やはりブログサイトなので、日本語でも読みやすい方がいいですよね。

そこで、先ほどのテーマフォルダ内に`bower_components`というディレクトリを作成し、

```
~/prj/littlebird/vccw/www/wordpress/wp-content/themes/littlebird/bower_components/
```

このフォルダ上でターミナルを開いて、以下のコマンドを実行します。

```
$ git clone https://github.com/gaspanik/jbootstrap.git
```

すると、`jbootstrap`というサブディレクトリが作成され、その中にJbootstrapのファイル一式がダウンロードされました。

#### Gruntのセットアップ

それでは、続いて[前回](https://github.com/littlebirdjp/littlebird-site)と同じようにGruntのセットアップと動作確認をしてみましょう。

まず、`jbootstrap`フォルダ上でターミナルを開いて、以下のコマンドを実行します。

```
$ sudo npm install
```

すると、Grunt本体と、packages.jsonに書かれたプラグイン一式が、自動的にインストールされます。
`/node_modules/`というフォルダ以下に各プラグインのフォルダができていれば、Gruntとプラグインのインストールは完了です。

![](screenshots/screenshot05.png?raw=true)

GruntでLESSのコンパイルなどのタスクを実行するには、`jbootstrap`フォルダ上で、ターミナルを開いて以下のコマンドを実行します。

```
$ grunt watch
```

すると、ファイルの変更を監視して、自動的にLESS→CSSへの変換を実行してくれるようになります。試しに、`/less/`フォルダ内のtheme.lessというファイルの一番下に、

```
.test {
  float: left;
}
```

と書いて保存してみました。すると、ターミナルに色々とメッセージが表示された後、`/dist/css/`フォルダ内のbootstrap-theme.cssを開くと、先ほど追加した記述がCSSファイルの方にも無事反映されていました。

以上でGruntを使ったカスタマイズの準備が完了です。

### テーマの編集

テーマ開発の準備が整ったので、いよいよテーマの編集に移ります。
実際の流れとしては、[littlebird-site](https://github.com/littlebirdjp/littlebird-site)の時に使ったLESSファイルを移植して、Bootstrapと合わせてテーマ内で読み込まれるように組み込み、テーマを構成している各PHPファイルを編集する形でコーディングを行いました。

#### オリジナルCSSの移植

まず、[littlebird-site](https://github.com/littlebirdjp/littlebird-site)で作ったオリジナルのLESSファイル、`littlebird-site.less`と`littlebird-variables.less`をコピーして、`/less/`フォルダ内にペーストします。

次に、Gruntfile.jsを開いて、LESSのコンパイル設定を探してみました。

```
    less: {
      compileCore: {
        options: {
          strictMath: true,
          sourceMap: true,
          outputSourceFiles: true,
          sourceMapURL: '<%= pkg.name %>.css.map',
          sourceMapFilename: 'dist/css/<%= pkg.name %>.css.map'
        },
        files: {
          'dist/css/<%= pkg.name %>.css': 'less/bootstrap.less'
        }
      },
      compileTheme: {
        options: {
          strictMath: true,
          sourceMap: true,
          outputSourceFiles: true,
          sourceMapURL: '<%= pkg.name %>-theme.css.map',
          sourceMapFilename: 'dist/css/<%= pkg.name %>-theme.css.map'
        },
        files: {
          'dist/css/<%= pkg.name %>-theme.css': 'less/theme.less'
        }
      }
    },

```

この部分に、以下のような記述を書き加えると、オリジナルのLESSファイルをCSSにコンパイルできるようになります。

```
      compileOriginal: {
        options: {
          strictMath: true,
          sourceMap: true,
          outputSourceFiles: true,
          sourceMapURL: 'littlebird-site.css.map',
          sourceMapFilename: 'dist/css/littlebird-site.css.map'
        },
        files: {
          'dist/css/littlebird-site.css': 'less/littlebird-site.less'
        }
      }
    },

```

#### テーマへのCSSとJSの組み込み

次に、テーマからBootstrapのCSSとJavascriptを読み込ませるようにしたいのですが、これはヘッダーファイル（header.php）に直接記述してしまうとよくないので、テーマ毎に動的な設定を行うfunctions.phpファイルに所定の記述を行うことで読み込ませます。

functions.php内で、CSSやJSの読み込みをしているのは、以下の部分になります。

```
function littlebird_scripts() {
	wp_enqueue_style( 'littlebird-style', get_stylesheet_uri() );

	wp_enqueue_script( 'littlebird-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'littlebird-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'littlebird_scripts' );
```

CSSやJSの追加をするには、この`littlebird_scripts`関数内に記述するのですが、まずはBootstrapのCSSを追記し、以下のように修正しました。

3行目は、_sのテーマ固有のCSS（style.css）ですが、こちらはWordPress特有のclassに対するスタイリングが多数設定されており、またWordPressテーマの仕様上、style.cssの存在が重要なので、そのまま残す形にしています。

最後に、littlebird-siteオリジナルのCSSを記述しました。これで、何かスタイルの変更を行いたい場合は、`littlebird-site.less`に記述すれば優先的に反映されるようになります。

```
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bower_components/jbootstrap/dist/css/bootstrap.css' );
	wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/bower_components/jbootstrap/dist/css/bootstrap-theme.css' );

	wp_enqueue_style( 'littlebird', get_stylesheet_uri() );

	wp_enqueue_style( 'littlebird-site', get_template_directory_uri() . '/bower_components/jbootstrap/dist/css/littlebird-site.css' );
```

次にJavascript部分ですが、jQueryとBootstrapのJSを追記し、以下のように修正しました。

jQueryは、Googleの提供しているCDNを読み込ませたいのですが、初期状態だとWordPressデフォルトのjQuery（/wp-includes/js/jquery/配下）を読んでしまう仕様になっているので、デフォルトのjQueryを読み込まない設定を最初に記述します。

次に、jQueryとjQuery MigrateをそれぞれCDNで読み込ませました。jQuery Migrateは、jQuery 1.9以前のコードを互換してくれるプラグインですが、今後他のWordPressプラグインとの兼ね合い等もありそうなので、念のため入れてあります。

```
	wp_deregister_script( 'jquery'); //デフォルトの jQuery は読み込まない
	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array(), '1.11.1', false);
	wp_enqueue_script( 'jquery-mig', '//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js', array(), '1.2.1', false);

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bower_components/jbootstrap/dist/js/bootstrap.min.js' );
```

最後に、サイト内で[Font Awesome](http://fortawesome.github.io/Font-Awesome/)のアイコンフォントを利用したかったので、以下のCSS読み込みも追加してあります。

```
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );
```

最終的に、functions.php内のCSS/JS読み込み部分は、以下のような形になりました。

```
function littlebird_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bower_components/jbootstrap/dist/css/bootstrap.css' );
	wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/bower_components/jbootstrap/dist/css/bootstrap-theme.css' );

	wp_enqueue_style( 'littlebird', get_stylesheet_uri() );

	wp_enqueue_style( 'littlebird-site', get_template_directory_uri() . '/bower_components/jbootstrap/dist/css/littlebird-site.css' );

	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );

	wp_deregister_script( 'jquery'); //デフォルトの jQuery は読み込まない
	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array(), '1.11.1', false);
	wp_enqueue_script( 'jquery-mig', '//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js', array(), '1.2.1', false);

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bower_components/jbootstrap/dist/js/bootstrap.min.js' );

	wp_enqueue_script( 'littlebird-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'littlebird-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'littlebird_scripts' );
```

#### リセットCSSの削除

次に、_sのCSS（style.css）に記述されているリセットCSSを削除しました。

リセットCSSは、基本的なHTML要素に適用されているブラウザのデフォルトスタイルを初期化するためのものですが、BootstrapのCSSでもリセットCSSが記述されており、この2つが競合してしまうので、_s側のリセットCSSを削除します。


```
/*--------------------------------------------------------------
1.0 Reset
--------------------------------------------------------------*/
ここから

...

ここまで削除
/*--------------------------------------------------------------
2.0 Typography
--------------------------------------------------------------*/
```

style.css内で「1.0 Reset」と書かれているブロックの該当スタイルを丸ごと削除してみましょう。

![](screenshots/screenshot06.png?raw=true)

ここまでの作業が完了すると、BootstrapのCSSがテーマに適用されるようになります。
試しにサイトのトップページをブラウザで確認してみると、先ほどとは全く違う見た目になりました。
これだけでも随分読みやすい感じになりましたね。

#### コーディング

続いて、独自のスタイルをテーマに適用するためのコーディングを行いました。
CSSの修正はオリジナルのLESSファイル（littlebird-site.less）で行い、
HTML側の修正はテーマを構成しているPHPファイル上で行います。  
修正箇所によって編集対象となるファイルが異なるのと、
WordPressの機能上の変更を行う場合には、functions.phpを修正する必要があるので注意しましょう。

#### ヘッダーメニューの組み込み

最初に、コンテンツ領域の左右マージンがないので、`<div id="content">`の外側を`<div class="container">`というタグで囲みました。  
Bootstrapの場合、こうすることでコンテンツ領域に適度なマージンを与えることができます。

次に、ヘッダーメニュー部分のコーディングを行いました。  
まずは、[littlebird-site](https://github.com/littlebirdjp/littlebird-site)で作ったメニュー部分`nav.navbar`を丸ごとコピーして、WordPressテーマのヘッダー（header.php）に移植したいと思います。

##### Bootstrapのヘッダーメニュー

```
<nav class="navbar navbar-default header" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle header__toggle" data-toggle="collapse" data-target="#headerMenu">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse header__inner" id="headerMenu">
      <ul class="nav navbar-nav navbar-right header__menu">
        <li><a href="#service">Service</a></li>
        <li><a href="#profile">Profile</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
```

ところが、移植先のheader.phpのソースを見てみると、メニュー部はリストタグ（ul li）に分かれておらず、`<?php wp_nav_menu(); ?>`という一つのタグから生成されていることが分かります。

##### _sテーマのメニュー部分（header.php）

```
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Primary Menu', 'littlebird' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
```

そこで、メニューのリスト部分だけは、元の`<?php wp_nav_menu(); ?>`タグを残す形で、ソースの移植を行いました。

ただし、リストのulタグには、以下のようにBootstrapで付与した独自のclassが付いてなければなりません。

```
      <ul class="nav navbar-nav navbar-right header__menu">
        <li><a href="#service">Service</a></li>
        <li><a href="#profile">Profile</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
```

これを実現するためには、wp_nav_menuタグに、$menu_classパラメータを追加することで対応が可能です。

参考：[テンプレートタグ/wp nav menu - WordPress Codex 日本語版](http://wpdocs.sourceforge.jp/%E3%83%86%E3%83%B3%E3%83%97%E3%83%AC%E3%83%BC%E3%83%88%E3%82%BF%E3%82%B0/wp_nav_menu)

```
<?php wp_nav_menu( array( 'theme_location' => 'primary','menu_class' => 'menu nav navbar-nav navbar-right header__menu' ) ); ?>
```

上記のように、wp_nav_menuタグにパラメータを追加することで、生成されるリストタグに独自のCSSスタイルを適用することができました。

![](screenshots/screenshot07.png?raw=true)

##### カスタマイズ後のヘッダーメニュー部分

以上のカスタマイズにより、最終的にヘッダーメニュー部分のソースは以下のような形になりました。

```
		<nav id="site-navigation" class="navbar navbar-default header" role="navigation">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle header__toggle" data-toggle="collapse" data-target="#headerMenu">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		    </div>
			<div class="collapse navbar-collapse header__inner" id="headerMenu">
			<?php wp_nav_menu( array( 'theme_location' => 'primary','menu_class' => 'menu nav navbar-nav navbar-right header__menu' ) ); ?>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav><!-- #site-navigation -->
```

##### 管理画面でのメニューの設定

メニューの内容を反映するには、WordPressの管理画面から設定を行います。  
「外観」→「メニュー」からメニューの設定画面に移動し、「新規メニューを作成」をクリックします。

今回作るサイトでは、Service、Profile、Contactという各メニュー項目をクリックした際に、同一ページ内のアンカーに飛ばしたいだけなので、
管理画面の左側のメニューから「リンク」というパネルを開いて、URL欄に「#service」「#profile」「#contact」などのアンカーリンクを入力しました。

![](screenshots/screenshot08.png?raw=true)

次に、「メニューの名前」を入力して、「テーマの位置：Primary Menu」というチェックボックスにチェックをしてから、「メニューを保存」ボタンをクリックすると、サイト上にメニュー項目が反映されます。

「メニューの名前」は、好きな名前を指定していいのですが、Chromeのデベロッパーツール等で確認すると分かる通り、`<ul id="menu-[メニュー名]">`のように、メニュー名の一部がHTMLタグのid名などとして出力されます。

日本語のメニュー名だと、これらのid名がエンコードされた文字列となり、若干気持ち悪いので、メニュー名は英数字にした方がいいかもしれません。

#### ヘッダータイトルの組み込み

次に、ヘッダータイトル部分の組み込みを行いました。  
これは、[littlebird-site](https://github.com/littlebirdjp/littlebird-site)では`.jumbotron`というコンポーネント部分、
_sのデフォルトテーマでは`.site-branding`というブロック部分が該当します。

##### Bootstrapのヘッダーメニュー

```
<div class="jumbotron main">
  <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 main__logo">
    <img src="img/logo@2x.png" height="170" width="170" alt="littlebird">
  </div>
  <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 main__title">
    <h1>littlebird</h1>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 main__lead">
    <p>世の中をちょっと面白くするサイトやサービスを作っています。</p>
  </div>
</div>
```

##### _sテーマのサイトタイトル部分（header.php）

```
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div><!-- .site-branding -->
```

基本的に、どちらもよく似たブロック要素なので、Bootstrap側の`.jumbotron`で置き換えればいいのですが、ホームへのリンクと、サイト名、サイト説明の部分は、WordPress固有のタグがきちんと反映されるように注意しましょう。

##### カスタマイズ後のヘッダータイトル部分

```
		<div class="site-branding jumbotron main">
		  <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 main__logo">
		    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/logo@2x.png" height="140" width="140" alt="<?php bloginfo( 'name' ); ?>"></a>
		  </div>
		  <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 main__title">
		    <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 main__lead">
		    <p class="site-description"><?php bloginfo( 'description' ); ?></p>
		  </div>
		</div><!-- .site-branding -->
```

![](screenshots/screenshot09.png?raw=true)

以上で、ヘッダー回りのコーディングは一通り完了しました。

サイトデザインの都合上、_sのデフォルトテーマとは、メニューとタイトルの順序が入れ替わっている点だけ注意してください。

#### フッター要素の組み込み

続いて、フッター部分のコーディングを行いました。

ここでサイトデザインの方針について改めて説明すると、今回はサイトを早く公開することを優先したかったので、[littlebird-site](https://github.com/littlebirdjp/littlebird-site)のデザインをなるべく手を入れずに移植し、完結させたいと思いました。

また、ブログにトップページはない（全ての個別ページがトップページの役割を果たす）という考えのもと、単純に[littlebird-site](https://github.com/littlebirdjp/littlebird-site)で作ったService、Profile、Contactといったブランド説明部分を、フッター要素として全ページに入れ込むことにしました。

なので、コーディング自体は、これらのブロック要素をフッターファイル（footer.php）に挿入する作業になります。

具体的には、`<div id="content">`と`<div class="container">`の閉じタグ以降から、`footer.site-footer`の直前辺りに、該当のソースを挿入しました。

![](screenshots/screenshot10.png?raw=true)

全てのページにサービス紹介が出てくるというのは、ちょっとしつこく感じられるかもしれませんが、SNSや検索エンジンから訪問するほとんどのユーザーにとって、サイトの制作者に関する情報は初見となるでしょうし、コンテンツの補足要素としてはちょうど良いのではないでしょうか？

デザイン的にも、元々帯っぽいあしらいにしていたため、フッターとしてコンテンツの区切りの役割も果たしている気がします。

この辺りのソースは、基本的に静的なHTMLのコピペでいいのですが、使用している画像は、テーマフォルダ以下のディレクトリに移植し、テーマディレクトリを動的に呼び出す設計に変更しました。

```
<img src="<?php bloginfo('template_directory'); ?>/img/service01@2x.png" height="120" width="120" alt="" class="service__image">
```

上記のソースを記述することで、実際ローカル上では、`http://littlebird.local/wp-content/themes/littlebird/img/service01@2x.png`のパスが呼び出されます。

こうすることで、テーマとしての汎用性が増すので、テーマ内で使用する共通画像は、テーマフォルダ以下の所定ディレクトリに設置するようにしましょう。

#### コンテンツ部分のスタイル調整

ヘッダーとフッター部分ができたので、次にメインのコンテンツ部分のコーディングを行いました。

_sとBootstrapのデフォルトスタイルを組み合わせた状態でも、ほぼ問題はないのですが、若干のフォントサイズや行間の調整のみ行なっています。

まず、_sのデフォルトスタイルだと、`p`要素全てに対して下マージンが適用されてしまい、フッター部分などコンテンツ本文以外のスタイルが崩れてしまうので、これを`#content`内だけに適用されるよう修正しました。

##### style.css

```
/*--------------------------------------------------------------
2.0 Typography
--------------------------------------------------------------*/

#content p {
	margin-bottom: 1.5em;
}
```

さらに、全体のバランスを見ながら、コンテンツ部分の見出し、投稿日時、投稿者のフォントサイズなどを調整しました。

これらの調整は、オリジナルCSS（littlebird-site.less）内に「_s overwite」という名前でブロックの追加を行い、WordPress固有のclassに対して上書きする形でスタイルの変更を適用しました。

##### littlebird-site.less

```
//
// _s overwite
// --------------------------------------------------

.site-content {
  border-top: 1px solid @lb-content-border;
}

.entry-meta {
  font-size: 14px;
  color: #666;
}

.posted-on {
  margin-right: 5px;
}

.entry-title {
  font-size: 28px;
  a {
    color: #404040;
    &:hover {
      color: #999;
    }
  }
}

.entry-content {
  h2 {
    font-size: 24px;
    margin-bottom: 1.5em;
  }
}
```

これらのデフォルトスタイル回りについては、また追々運用しながら微調整していきたいと思います。

![](screenshots/screenshot11.png?raw=true)

尚、デフォルトの設定では、サイドバーに各種ウィジェットが登録されていますが、これらは今回作るサイトでは使用しないので、「外観」→「ウィジェット」の設定から、一つ一つパネルを開いて削除しておきました。

#### OGPの設定

さて、最低限のテンプレート修正は完了し、サイトを公開できる状態にはなったのですが、サイトの公開に合わせてOGPの設定をしておくことにしました。

今やサイトのプロモーション施策として、SNSでの拡散は欠かせませんが、OGタグやOGイメージが正しく設定されていないと、十分な拡散効果が得られません。

OGタグについては、header.phpに所定の書式でタグを記述すればいいのですが、サイト名やエントリーのタイトルがきちんと反映されるように、WordPressタグを活用しましょう。

また、OGイメージついては、投稿毎のアイキャッチを表示したかったので、functions.phpにアイキャッチを有効化する設定と、アイキャッチのURLを取得する関数を記述しました。

参考：[投稿サムネイル - WordPress Codex 日本語版](http://wpdocs.sourceforge.jp/%E6%8A%95%E7%A8%BF%E3%82%B5%E3%83%A0%E3%83%8D%E3%82%A4%E3%83%AB)

##### functions.php

```
//RSSフィードとショートリンクを非表示
remove_filter( 'wp_head', 'feed_links', 2 );
remove_filter( 'wp_head', 'feed_links_extra', 3 );
remove_filter( 'wp_head', 'wp_shortlink_wp_head' );

//アイキャッチを有効化
add_theme_support( 'post-thumbnails', array( 'post') );

// Get the featured image URL
function get_featured_image_url() { 
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src($image_id,'thumbnail', true); 
    echo $image_url[0]; 
}
```

functions.phpに上記の記述を書き加えると、WordPressの投稿画面に「アイキャッチ画像」のパネルが表示され、そこからアイキャッチ画像の登録ができるようになります。

尚、HTMLソース上に挿入されるRSSフィードのタグと、ショートリンク（`http://littlebird.local/?p=[投稿ID]`という形式のデフォルトURL）も、今回のサイトでは必要なかったので、表示されないように設定を書き加えてあります。

以上の設定をした上で、ヘッダーファイル（header.php）にOGタグとTwitter Cardsのタグを記述しました。

##### header.php

```
<meta property="og:type" content="blog">
<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
<meta property="twitter:description" content="<?php bloginfo( 'description' ); ?>">
<?php if ( is_single() ) { ?>
<meta property="og:title" content="<?php the_title(); ?>">
<meta name="twitter:title" content="<?php the_title(); ?>">
<meta property="og:url" content="<?php the_permalink(); ?>">
<meta name="twitter:url" content="<?php the_permalink(); ?>">
<?php if(has_post_thumbnail()) { ?>
<meta property="og:image" content="<?php get_featured_image_url(); ?>">
<meta property="twitter:image" content="<?php get_featured_image_url(); ?>">
<?php } else { ?>
<meta property="og:image" content="<?php bloginfo('template_url'); ?>/images/ogimage.png">
<meta property="twitter:image" content="<?php echo esc_url( home_url( '/' ) ); ?>img/ogimage.png">
<?php } ?>
<?php } else { ?>
<meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
<meta name="twitter:title" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
<meta name="twitter:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
<meta property="og:image" content="<?php bloginfo('template_url'); ?>/images/ogimage.png">
<meta property="twitter:image" content="<?php echo esc_url( home_url( '/' ) ); ?>img/ogimage.png">
<?php } ?>
<meta property="fb:admins" content="youthkee">
<meta property="fb:app_id" content="">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@youthkee">
<meta name="twitter:domain" content="littlebird.mobi">
```

以上の設定をすることで、アイキャッチが登録されている場合には、OGイメージとしてアイキャッチ画像（例 `http://littlebird.local/wp-content/uploads/2014/12/webnewprinciple.jpg`）が表示され、アイキャッチがない場合にはデフォルトのOGイメージ（`http://littlebird.local/wp-content/themes/littlebird/img/ogimage.png`）が表示されるようになりました。

#### ソーシャルボタンの設置

最後に各投稿ページにソーシャルボタンを設置しました。  
基本的にはTwitter、Facebook、Google+の公式サイトからタグを取得して所定の箇所にペーストするだけです。
ボタンを挿入したい箇所だけでなく、ヘッダー部分にもタグを記述する必要があるので、注意しましょう。

##### header.php

```
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'ja'}
</script>
</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&appId=&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
```

##### content-single.php

```
	<div class="entry-share">
		<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
		<div class="g-plusone" data-annotation="inline" data-width="120"></div>
	</div><!-- .entry-share -->
```

##### littlebird-site.less

```
.twitter-share-button {
  width: 100px !important;
}

.fb-like {
  top: -5px !important;
  width: 150px !important;
}
```

Facebookのいいねボタンには、各投稿のURLを指定するために`<?php the_permalink(); ?>`を記述してあります。

また、各ソーシャルボタンのマージン等を微調整したかったので、各ボタンの固有classにスタイルを上書きする形でCSS修正を行いました。

以上で、一通りのコーディング作業が完了です。

### WordPressコンテンツの静的化

Vagrantによるローカルの仮想環境でサイトの構築ができたので、生成されたコンテンツをプラグインによって静的化しました。  
このプロジェクトでは、ローカル上のWordPress（テストサイト）→サーバ上のWordPress（本番サイト）といった通常のフローではなく、ローカル上のWordPressで生成されたコンテンツをHTMLとJSのみの静的コンテンツに変換して、静的サイトとして公開する運用フローを想定しています。

#### プラグインのインストール

WordPressのコンテンツを静的化するプラグインとしては、[StaticPress](https://wordpress.org/plugins/staticpress/)と[Really Static](https://wordpress.org/plugins/really-static/)が有名です。  
どちらもWordPressサイトの静的化を行うことができますが、まずはどちらもインストールして、静的コンテンツの生成の仕組みなど、両者の違いを含めて検証することにしました。

WordPressの管理画面から、「プラグイン」→「新規追加」から『Static』と入力してプラグインを検索。
「StaticPress」と「Really Static」を見つけたら、プラグイン名をクリックして、「いますぐインストール」を実行します。  
インストールが完了したら、プラグインのページから各プラグインを「有効化」しましょう。

#### プラグインの検証

##### StaticPress

まずはStaticPressの方から動作の検証をしました。
StaticPressをインストールすると、管理画面のサイドバーに「StaticPress」の項目が追加され、ここからStaticPressの設定・実行を行うことができます。

「StaticPress設定」の画面では、生成する静的サイトのURLと、出力先ディレクトリを設定することができます。

![](screenshots/screenshot12.png?raw=true)

今回は、静的サイトURLを`http://littlebird.mobi/`、出力先ディレクトリ（ドキュメントルート）を`/var/www/wordpress/static/`と設定しました。

以上の設定が完了すると、「StaticPress」画面から、再構築を行うことができます。記事の投稿などの準備が整い、静的コンテンツを生成する場合は、「再構築」ボタンをクリックしましょう。

再構築が開始されると、『初期化中...』というメッセージが表示されて初期化の処理が実行され、続いて『フェッチ開始』というメッセージが表示されます。

![](screenshots/screenshot13.png?raw=true)

その後、ドキュメントルート下の`/static/`ディレクトリ内に、ファイルが一つ一つ生成されていきます。初回の再構築は多くのファイルを生成するため、完了まで約20分ほどかかりますが、画面上に『終了』のメッセージが表示されるまで気長に待ちましょう。

![](screenshots/screenshot14.png?raw=true)

##### Really Static

次にReally Staticの動作検証を行いました。
Really Staticをインストールすると、「設定」メニュー内に「Really Static」の項目が追加され、ここからReally Staticの設定・実行を行うことができます。

Really Staticの設定画面は、初期状態では全ての項目が設定できないので、まずはページ下部の「show Expertsettings」というチェックボックスにチェックを入れましょう。

![](screenshots/screenshot15.png?raw=true)

「ソース」タブでは、ローカルのWordPress本体のURLと、テンプレートディレクトリへのパスを設定します。

今回は、『WordPress本体へのURL』を`http://littlebird.local/`、『テンプレートフォルダへのURLパス』を`http://littlebird.local/wp-content/themes/littlebird/`と設定しました。

![](screenshots/screenshot16.png?raw=true)

「設置場所」タブでは、ローカル上でファイルを生成させるパスや、実際に公開するサイトのURL、サーバ上のテンプレートディレクトリのパスなどを設定します。

今回は「ローカルのファイルシステムで作動させる」を選択した上で、『キャッシュされたファイルへの内部ファイルパス』を`/var/www/wordpress/really-static/`、『キャッシュされたファイルのドメインプリフィックス』を`http://littlebird.mobi/`、『テンプレートフォルダへのパス』を`http://littlebird.mobi/wp-content/themes/littlebird/`と入力しました。

![](screenshots/screenshot17.png?raw=true)

「設定」タブでは、生成するアーカイブの種類や、生成するファイルの種類（拡張子）を設定できます。

今回は、トップページと各投稿毎のページだけを生成したかったので、「indexページを静的にします」だけにチェックを入れて、他のアーカイブのチェックをオフにしました。

また、この画面の上部に「各 `http://littlebird.local/` を `http://littlebird.mobi/` にリライトする」というチェックボックスがありますが、ここにもチェックを入れておきます。

この設定をしないと、静的サイトを生成する際に、WordPressの一部のパスがローカルのドメイン（littlebird.local）のままで生成されてしまうので、注意しましょう。

![](screenshots/screenshot18.png?raw=true)

「手動リフレッシュ」タブでは、ページ単位、またはサイト全体を手動で再構築することができます。

Really Staticでは、記事の投稿などのアクションに応じて自動的にコンテンツを生成することもできますが、初回の構築はこのタブから実行しましょう。

「すべてのファイルを書き込む」ボタンをクリックすると、サイト全体の再構築を行うことができます。

##### StaticPressとReally Staticの比較

StaticPressとReally Static、両方のプラグインで生成されたコンテンツをローカル上で開いて比較してみました。

![](screenshots/screenshot19.png?raw=true)

各フォルダに生成されたHTMLファイルは、正しくパスの書き変え等が行われており、そのまま静的ページとして公開が可能な状態に変換されていました。
ただし、これら2つのプラグインでは、生成するコンテンツの内容に違いがあるようです。

StaticPressは、生成するアーカイブの種類を選べず、全てのアーカイブを出力してしまう他、テーマやプラグインのディレクトリ内にある画像やCSS、JSなども抽出して再生成してしまうようでした。

これらのファイルは、静的サイトの公開には直接必要がないものなので、サーバに丸ごとアップしてしまうのは抵抗があります。

それに対して、Really Staticは、基本的に設定したアーカイブのHTMLと、アップロードしたメディア（画像）以外は生成しません。

テーマ側で使用している画像やCSS、JSなどは、別途アップロードする必要がありますが、日々の運用では更新の必要がないものなので、Really Staticが生成するファイルの方が、静的サイトの運用には適しているかもしれません。

以上の検証から、本プロジェクトでは、Really Staticを使用して静的サイトの運用を行うことにしました。

