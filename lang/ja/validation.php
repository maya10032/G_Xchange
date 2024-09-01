<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attributeを承認してください。',
    'active_url'           => ':attributeには有効なURLを指定してください。',
    'after'                => ':attributeには:date以降の日付を指定してください。',
    'alpha'                => ':attributeには英字のみからなる文字列を指定してください。',
    'alpha_dash'           => ':attributeには英数字・ハイフン・アンダースコアのみからなる文字列を指定してください。',
    'alpha_num'            => ':attributeには英数字のみからなる文字列を指定してください。',
    'array'                => ':attributeには配列を指定してください。',
    'before'               => ':attributeには:date以前の日付を指定してください。',
    'between'              => [
        'numeric' => ':attributeには:min〜:maxまでの数値を指定してください。',
        'file'    => ':attributeには:min〜:max KBのファイルを指定してください。',
        'string'  => ':attributeには:min〜:max文字の文字列を指定してください。',
        'array'   => ':attributeには:min〜:max個の要素を持つ配列を指定してください。',
    ],
    'boolean'              => ':attributeには真偽値を指定してください。',
    'confirmed'            => ':attributeが確認用の値と一致しません。',
    'date'                 => ':attributeには正しい形式の日付を指定してください。',
    'date_format'          => '":format"という形式の日付を指定してください。',
    'different'            => ':attributeには:otherとは異なる値を指定してください。',
    'digits'               => ':attributeには:digits桁の数値を指定してください。',
    'digits_between'       => ':attributeには:min〜:max桁の数値を指定してください。',
    'dimensions'           => ':attributeの画像サイズが不正です。',
    'distinct'             => '指定された:attributeは既に存在しています。',
    'email'                => ':attributeには正しい形式のメールアドレスを指定してください。',
    'body'                 => ':attributeは必須です。',
    'exists'               => '指定された:attributeは存在しません。',
    'file'                 => ':attributeにはファイルを指定してください。',
    'filled'               => ':attributeには空でない値を指定してください。',
    'image'                => ':attributeには画像ファイルを指定してください。',
    'in'                   => ':attributeには:valuesのうちいずれかの値を指定してください。',
    'in_array'             => ':attributeが:otherに含まれていません。',
    'integer'              => ':attributeには整数を指定してください。',
    'ip'                   => ':attributeには正しい形式のIPアドレスを指定してください。',
    'json'                 => ':attributeには正しい形式のJSON文字列を指定してください。',
    'max'                  => [
        'numeric' => ':attributeには:max以下の数値を指定してください。',
        'file'    => ':attributeには:max KB以下のファイルを指定してください。',
        'string'  => ':attributeには:max文字以下の文字列を指定してください。',
        'array'   => ':attributeには:max個以下の要素を持つ配列を指定してください。',
    ],
    'mimes'                => ':attributeには:valuesのうちいずれかの形式のファイルを指定してください。',
    'mimetypes'            => ':attributeには:valuesのうちいずれかの形式のファイルを指定してください。',
    'min'                  => [
        'numeric' => ':attributeには:min以上の数値を指定してください。',
        'file'    => ':attributeには:min KB以上のファイルを指定してください。',
        'string'  => ':attributeには:min文字以上の文字列を指定してください。',
        'array'   => ':attributeには:min個以上の要素を持つ配列を指定してください。',
    ],
    'not_in'               => ':attributeには:valuesのうちいずれとも異なる値を指定してください。',
    'numeric'              => ':attributeには数値を指定してください。',
    'present'              => ':attributeには現在時刻を指定してください。',
    'regex'                => '正しい形式の:attributeを指定してください。',
    'required'             => ':attributeは必須です。',
    'required_if'          => ':otherが:valueの時:attributeは必須です。',
    'required_unless'      => ':otherが:values以外の時:attributeは必須です。',
    'required_with'        => ':valuesのうちいずれかが指定された時:attributeは必須です。',
    'required_with_all'    => ':valuesのうちすべてが指定された時:attributeは必須です。',
    'required_without'     => ':valuesのうちいずれかがが指定されなかった時:attributeは必須です。',
    'required_without_all' => ':valuesのうちすべてが指定されなかった時:attributeは必須です。',
    'same'                 => ':attributeが:otherと一致しません。',
    'size'                 => [
        'numeric' => ':attributeには:sizeを指定してください。',
        'file'    => ':attributeには:size KBのファイルを指定してください。',
        'string'  => ':attributeには:size文字の文字列を指定してください。',
        'array'   => ':attributeには:size個の要素を持つ配列を指定してください。',
    ],
    'string'               => ':attributeには文字列を指定してください。',
    'timezone'             => ':attributeには正しい形式のタイムゾーンを指定してください。',
    'unique'               => 'その:attributeはすでに使われています。',
    'uploaded'             => ':attributeのアップロードに失敗しました。',
    'url'                  => ':attributeには正しい形式のURLを指定してください。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'count' => [
            'max'      => '一度に購入できる数を超えています。',
        ],
        'item_code' => [
            'required' => '商品コードは必須です。',
            'max'      => '商品コードは50文字以内で入力してください。',
        ],
        'item_name' => [
            'required' => '商品名は必須です。',
            'max'      => '商品名は50文字以内で入力してください。',
        ],
        'count_limit' => [
            'required' => '最大注文数は必須です。',
            'integer'  => '最大注文数は数値で入力してください。',
            'min'      => '最大注文数は1以上である必要があります。',
        ],
        'sales_price' => [
            'required' => '販売価格は必須です。',
            'integer'  => '販売価格は数値で入力してください。',
            'min'      => '販売価格は1以上である必要があります。',
        ],
        'regular_price' => [
            'integer'  => '通常価格は数値で入力してください。',
            'min'      => '通常価格は1以上である必要があります。',
        ],
        'message' => [
            'required' => '商品説明は必須です。',
            'max'      => '商品説明は500文字以内で入力してください。',
        ],
        'images' => [
            'required' => '画像は必須です。',
            'array'    => '画像は配列として送信してください。',
            'min'      => '画像は1枚以上選択してください。',
            'max'      => '画像は最大4枚まで選択できます。',
            'image'    => '画像ファイルを選択してください。',
            'mimes'    => 'JPEG, PNG, JPG, GIF, SVG形式の画像ファイルを選択してください。',
            'max'      => '画像ファイルのサイズは2MB以下である必要があります。',
        ],
        'images.*' => [
            'image'    => 'アップロードされたファイルは画像形式である必要があります。',
            'mimes'    => '画像はjpeg, png, jpg, gif, svg形式でアップロードしてください。',
            'max'      => '各画像のサイズは2MB以下にしてください。',
        ],
        'thumbnail' => [
            'required' => 'サムネイル画像を選択してください。',
            'integer'  => 'サムネイルの選択が正しくありません。',
            'between'  => 'サムネイルは0から3の間で選択してください。',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        "phone"            => "電話番号",
        "address"          => "住所",
        "email Address"    => "メールアドレス",
        "password"         => "パスワード",
        "confirm Password" => "パスワード(確認用)",
        "remember Me"      => "ログイン状態を保存",
        'name'             => '氏名',
        'email'            => 'メールアドレス',
        'title'            => 'お問い合わせ項目',
        'body'             => 'お問い合わせ内容',
        'item_code'        => '商品コード',
        'item_name'        => '商品名',
        'category_id'      => 'カテゴリー',
        'count_limit'      => '最大注文数',
        'sales_price'      => '販売価格',
        'regular_price'    => '通常価格',
        'message'          => '商品説明',
        'images'           => '画像',
        'thumbnail'        => 'サムネイル',
        'item_id'          => '商品ID',
        'count'            => '数量'
    ],

];
