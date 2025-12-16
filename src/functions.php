<?php
use kaleidpixel\utility\headerinfo;

if (!function_exists('headerinfo')) {
    /**
     * HTTPヘッダーとサーバー情報を表示するデバッグ用関数
     * 注意: 機密情報が含まれるため、本番環境の公開領域では使用しないでください。
     */
    function headerinfo(): void
    {
        headerinfo::render();
    }
}
