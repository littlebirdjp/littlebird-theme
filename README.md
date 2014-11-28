# littlebird-theme

A simple WordPress theme build with _s and Bootstrap 3.

## URL

[http://littlebird.mobi/blog](http://littlebird.mobi/blog)(Under Construction)

## Requrements（制作ツール）

- WordPress
- _s
- Bootstrap 3.1.1
- JQuery 1.9.0 or later
- Sketch 3.0 or later

## 制作過程

1. [ローカル仮想環境の構築](#ローカル仮想環境の構築)
	1. [Virtual Boxのインストール](#virtual-boxのインストール)
	2. [Vagrantのインストール](#vagrantのインストール)
	3. [VCCWのインストール](#vccwのインストール)
	4. [VCCWの初期設定](#vccwの初期設定)
	5. [VCCWの環境構築](#vccwの環境構築)
	6. [仮想環境の動作確認](#仮想環境の動作確認)

### ローカル仮想環境の構築

WordPressの仮想環境を簡単に構築できる[VCCW](http://vccw.cc/)で、ローカルに作業環境を準備しました。
また、そのために必要な、[Virtual Box](https://www.virtualbox.org/)と[Vagrant](https://www.vagrantup.com/)も合わせてインストールしました。
※以下のセットアップおよび制作過程は、Mac OS X環境にて行っています。

#### Virtual Boxのインストール

Virtual Boxの[ダウンロードページ](https://www.virtualbox.org/wiki/Downloads)から、Mac OS X版のパッケージをダウンロードし、インストールを実行しました。

#### Vagrantのインストール

Vagrantの[ダウンロードページ](https://www.vagrantup.com/downloads.html)から、Mac OS X版のパッケージをダウンロードし、インストールを実行しました。

#### VCCWのインストール

VCCWの[公式サイト](http://vccw.cc/)から、zipファイルをダウンロードし、展開後のファイル一式を作業ディレクトリ内に設置しました。
今回、作業ディレクトリは、Mac OS X内の以下のパスとしています。
```
/Users/[ユーザー名]/prj/littlebird/
```
次に、Vagrantfile.sampleをコピー＆リネームし、Vagrantfileを作成。そして、必要な箇所を編集しました。
今回は、主に以下の記述を変更してあります。
```
WP_LANG              = ENV["wp_lang"] || "ja" # WordPress locale (e.g. ja)
WP_HOSTNAME          = "littlebird.local" # e.g example.com
WP_IP                = "192.168.33.10" # host ip address
WP_TITLE             = "lottlebird blog" # title
WP_DB_PREFIX         = 'lb_' # Database prefix
WP_DIR               = '/blog' # e.g. /wp or wp or other
```

#### VCCWの環境構築

設定が完了したら、作業ディレクトリ上でターミナルを開いて「vagrant up」コマンドを実行します。
初回のみ、環境構築に20分ほどかかり、ターミナルのメッセージがときどき止まりますが、構築完了まで気長に待ちましょう。

※コマンド実行中に余計なキーを叩くと、処理が中断され、最後まで環境構築されない場合があるので、注意してください。（作業ディレクトリ内にWordPressのファイルが作成されない等）
構築に失敗した場合は、いったん「vagrant destroy」で環境を破棄して、再度「vagrant up」を実行すれば、最初から構築をやり直すことができます。

#### 仮想環境の動作確認

環境構築が完了したら、先ほど設定したIPアドレス（192.168.33.10）をブラウザで叩いてアクセスします。
WordPressの画面（デフォルトテンプレートでインストールされた状態）が表示されたら、VCCWのセットアップ成功です。

##### ホストネームでアクセスするには

IPではなく、Vagrantfileで設定したホストネーム（littlebird.local）でアクセスできるようにするには、vagrant-hostsupdaterというプラグインをインストールする必要があります。ターミナルで以下のコマンドを実行して、vagrant-hostsupdaterをインストールしてください。
```
vagrant plugin install vagrant-hostsupdater
```
インストール中にエラーメッセージが表示される場合は、[Homebrew](http://brew.sh/)と[Nokogiri](https://rubygems.org/gems/nokogiri)のgemをインストールしてください。

※ホストネームでのアクセスは、仮想環境の構築後でも適用可能です。一度「vagrant halt」で仮想マシンを停止してから、再度「vagrant up」で起動すれば、ホストネームでもアクセスできるようになります。