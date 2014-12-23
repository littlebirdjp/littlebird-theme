# littlebird-theme

A simple WordPress theme build with _s and Bootstrap 3.

[_s](http://underscores.me/)と[Bootstrap](http://getbootstrap.com/)を使ってシンプルなWordPressテーマを作ってみようという個人プロジェクトです。  
以前制作した[littlebird-site](https://github.com/littlebirdjp/littlebird-site)のLESSファイルを流用して、WPサイトと本サイトを統合。最終的にはStaticPressで静的化してAmazon S3に公開するところまで持っていきたいと思っています。

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
	- Bootstrapのインストール
	- Gruntのセットアップ
3. テーマの編集
	- オリジナルCSSの移植
	- テーマへのCSSとJSの組み込み
	- コーディング
4. WordPressコンテンツの静的化
5. サイトの公開
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


