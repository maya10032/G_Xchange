document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById("image"); // input name="files[]"の要素を取得
    const preview    = document.getElementById("preview"); // preview表示するところ

    if (imageInput && preview) {
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
                    img.src               = e.target.result; // プレビュー表示用
                    img.style.width       = "100px";
                    img.style.height      = "100px";
                    img.style.marginRight = "10px";
                    preview.appendChild(img);
                };

                reader.onerror = function () {
                    console.error('ファイル読み込み中にエラーが発生しました。');
                };

                // URLに変換
                reader.readAsDataURL(file);
            });
        });
    }
});
