document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById("images"); // input name="images"の要素を取得
    const preview = document.getElementById("preview"); // preview表示するところ

    // ファイル選択をされたとき
    imageInput.addEventListener("change", function () {
        // preview初期化
        preview.innerHTML = "";

        const files = imageInput.files;
        // ファイルが選択されてない場合は終了
        if (files.length === 0) return;

        // 各ファイルをプレビュー
        Array.from(files).forEach((file) => {
            // 新しく入力された写真をプレビュー表示させるための処理
            const reader = new FileReader();
            // 読み込みが成功した際に走るイベント。eには読み込んだ値が入っている。
            reader.onload = function (e) {
                const img = document.createElement("img");
                img.src = e.target.result; // プレビュー表示用
                img.style.width = "100px"; // プレビュー画像のサイズ
                img.style.marginRight = "10px"; // 画像の間隔
                preview.appendChild(img);
            };

            // URLに変換
            reader.readAsDataURL(file);
        });
    });
});
