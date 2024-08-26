## G_Xchange
![G_Xchange](https://img.shields.io/badge/Version-0.0.0-990000.svg)

## リンク集
- [Googleスプレッドシート](https://drive.google.com/drive/u/0/folders/1-roOokKqeLLemFCi9_nUCXZB8nd9r2Mg)
- [ユースケース図](https://www.figma.com/design/1FHDWPVVQIz17znMWBGoMA/UML-Use-Case-Diagram-(Community)?node-id=0-1&t=gJ14Ykkbc7scDHDc-1)
- [画面遷移図](https://www.figma.com/board/VcWE3DDOnYaTjBdRCIszMV/Entity-relationship-(ER)-Diagram-(Community)?node-id=0-1&t=pMfiVIQyutNQzZTx-1)
- [レイアウト図](https://www.figma.com/design/bkxQDsRZeRDQ3whOlcx0t2/EC%E3%82%B5%E3%82%A4%E3%83%88-%E6%97%A5%E6%9C%AC%E8%AA%9E%E3%83%AF%E3%82%A4%E3%83%A4%E3%83%BC%E3%83%95%E3%83%AC%E3%83%BC%E3%83%A0-(Community)?node-id=31-10850&t=nO1CiySTnnIjovim-1)
- [画面レイアウト設計書_書籍管理](https://docs.google.com/document/d/1K5AMjsroJLlKEMf1fIPJKDw1e8ZMhxsK/edit)
- [ER図](https://www.figma.com/board/doltIUZEiDblQT2GUJRbuL/FigJam-ER-Diagram-Template-(Community)?node-id=0-1&t=2bRAgjsLxfx5ZSXm-1)
- [テーブル設計書](https://docs.google.com/spreadsheets/d/1sB0bkHo7bQcCjjboNBKfvzxNyTK-gV-x4ntMSb97Ydo/edit?gid=0#gid=0)
- [クラス設計書](https://docs.google.com/spreadsheets/d/1-87RJE4FHaRmWMn16mwFAHAaWpDv8kcq/edit?gid=788228945#gid=788228945)
- [URLマッピング一覧](https://docs.google.com/spreadsheets/d/1y0lJ4_Cli_bPAPsbkgGsMGVLZdjui-6b/edit?gid=1173526636#gid=1173526636)

## 機能要件
1：ユーザ登録とログイン機能の実装
- 新規ユーザ登録フォームを作成
- 登録時に必要なバリデーションを実装
- ユーザデータをデータベースに保存する機能を実装
- ログイン機能を実装

2：商品カタログの登録・編集・削除 / 表示
- データベースに商品を登録
- データベースから商品情報を取得
- 商品一覧ページを作成
- カテゴリや検索キーワードでフィルタリングできる機能を実装
- 商品の並び替え

3：商品画像のアップロード機能
- 商品登録/編集フォームに画像アップロードを追加する
- アップロードされた画像をデータベースに保存する機能を実装
- 画像の保存先ディレクトリを設定
- アップロードされた画像ファイル名をユニークで生成し、データベースに保存
- 画像のサイズや形式のバリデーションを実装
- 画像を削除する機能を実装し、商品編集時に既存の画像を削除できるようにする

4：商品詳細ページ作成
- 商品の詳細情報を表示する機能を実装
- 「カートに追加」ボタンを設置

5：カート機能の実装
- カートに商品を追加する機能を実装
- カート内の商品数を変更できる機能を実装
- カートから商品を削除する機能を実装
- カートの中身を保存し、ユーザがログアウト後もカートの内容を保持
- カートの合計金額を計算し表示

6：購入履歴の表示
- ユーザの購入履歴をデータベースから取得
- 購入履歴ページを作成し、過去の注文をリスト形式で表示
- 各注文の詳細情報を表示
- 再購入ボタンを実装

7：お問い合わせ機能の実装
- お問い合わせページを作成し、フォームを設置
- フォームの入力に対するバリデーションを実装
- お問い合わせが送信された際に管理者に通知めーrを送信する機能を実装
- ユーザにもお問い合わせが正常に送信されたことを確認するメールを自動送信する

お試し
