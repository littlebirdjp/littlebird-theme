# littlebird-theme

A simple WordPress theme build with _s and Bootstrap 3.

[_s](http://underscores.me/)と[Bootstrap](http://getbootstrap.com/)を使ってシンプルなWordPressテーマを作ってみようという個人プロジェクトです。  
以前制作した[littlebird-site](https://github.com/littlebirdjp/littlebird-site)のLESSファイルを流用して、WPサイトと本サイトを統合。最終的にはプラグインでコンテンツを静的化して、Amazon S3上で運用することを目標としています。

## URL

[http://littlebird.mobi](http://littlebird.mobi)

## Requrements（制作ツール）

- WordPress
- _s
- Bootstrap 3.1.1
- JQuery 1.9.0 or later
- Sketch 3.1.1 or later

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
		- OGPの設定
		- ソーシャルボタンの設置
4. WordPressコンテンツの静的化
	- プラグインのインストール
	- プラグインの検証・選定
	- コンテンツの静的化
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



