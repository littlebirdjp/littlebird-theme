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
		- ヘッダーメニューの組み込み
		- ヘッダータイトルの組み込み
		- フッター要素の組み込み
		- 全体のスタイル調整
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






