<?php

namespace kaleidpixel\utility;

class headerinfo
{
    private const string TEMPLATE_PATH = __DIR__ . '/templates/info.php';
    private const string LANG_PATH = __DIR__ . '/i18n/';

    /**
     * メイン実行メソッド
     */
    public static function render(): void
    {
        // 1. 言語設定の取得 (ブラウザ設定を優先、デフォルトは 'en')
        $langCode = self::detectLanguage();
        $trans = self::loadTranslation($langCode);

        // 2. データの収集とサニタイズ（重要: XSS対策）
        // print_r の結果もエスケープするために、一度データとして取得します
        $remoteAddr = self::safeVarDump($_SERVER['REMOTE_ADDR'] ?? 'unknown');
        $allHeaders = self::safePrintR(getallheaders());

        // Cloudflare
        $cfHeaders = self::safePrintR([
            'CF-Connecting-IP' => $_SERVER['HTTP_CF_CONNECTING_IP'] ?? 'not set',
            'CF-Ray'           => $_SERVER['HTTP_CF_RAY'] ?? 'not set',
            'CF-Visitor'       => $_SERVER['HTTP_CF_VISITOR'] ?? 'not set',
            'CF-IPCountry'     => $_SERVER['HTTP_CF_IPCOUNTRY'] ?? 'not set',
        ]);

        // Proxy
        $proxyHeaders = self::safePrintR([
            'X-Forwarded-For'   => $_SERVER['HTTP_X_FORWARDED_FOR'] ?? 'not set',
            'X-Forwarded-Proto' => $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? 'not set',
            'X-Forwarded-Host'  => $_SERVER['HTTP_X_FORWARDED_HOST'] ?? 'not set',
            'X-Real-IP'         => $_SERVER['HTTP_X_REAL_IP'] ?? 'not set',
            'Forwarded'         => $_SERVER['HTTP_FORWARDED'] ?? 'not set',
        ]);

        // HTTP_ Variables (PHP 8.0+ str_starts_with)
        $httpVarsRaw = array_filter($_SERVER, fn($key) => str_starts_with($key, 'HTTP_'), ARRAY_FILTER_USE_KEY);
        $httpVars = self::safePrintR($httpVarsRaw);

        // All Server Vars
        $serverVars = self::safePrintR($_SERVER);

        // 3. テンプレートの読み込み
        // 変数をローカルスコープに展開してinclude
        include self::TEMPLATE_PATH;
    }

    /**
     * ブラウザのAccept-Languageを見て言語を判定
     */
    private static function detectLanguage(): string
    {
        $accept = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
        // 'ja' が含まれていれば日本語、それ以外は英語
        return str_contains(strtolower($accept), 'ja') ? 'ja' : 'en';
    }

    /**
     * 翻訳ファイルの読み込み
     */
    private static function loadTranslation(string $lang): array
    {
        $file = self::LANG_PATH . $lang . '.php';
        if (file_exists($file)) {
            return include $file;
        }
        return include self::LANG_PATH . 'en.php';
    }

    /**
     * 安全な print_r 出力（HTMLエスケープ済み）
     */
    private static function safePrintR(mixed $data): string
    {
        // print_r の結果を取得し、HTML特殊文字をエスケープする
        $output = print_r($data, true);
        return htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
    }

    /**
     * 安全な var_dump 出力
     */
    private static function safeVarDump(mixed $data): string
    {
        ob_start();
        var_dump($data);
        $output = ob_get_clean();
        return htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
    }
}
