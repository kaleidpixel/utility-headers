<?php
/**
 * @var array $trans 翻訳配列
 * @var string $langCode 言語設定
 * @var string $remoteAddr エスケープ済み
 * @var string $allHeaders エスケープ済み
 * @var string $cfHeaders エスケープ済み
 * @var string $proxyHeaders エスケープ済み
 * @var string $httpVars エスケープ済み
 * @var string $serverVars エスケープ済み
 */
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($langCode, ENT_QUOTES); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($trans['title'], ENT_QUOTES); ?></title>
    <style>
        body { font-family: 'SF Mono', 'Segoe UI Mono', 'Roboto Mono', monospace; margin: 20px; background: #f5f5f5; color: #333; }
        h1 { color: #222; }
        h2 { color: #555; margin-top: 30px; border-bottom: 2px solid #ccc; padding-bottom: 5px; font-size: 1.2rem; }
        pre { background: #fff; padding: 15px; border: 1px solid #ddd; border-radius: 5px; overflow-x: auto; font-size: 0.9rem; white-space: pre-wrap; word-wrap: break-word; }
        .important { background: #ffffcc; font-weight: bold; border-color: #e6e600; }
        .security-warning { background: #ffebee; color: #c62828; padding: 10px; border: 1px solid #ef9a9a; border-radius: 5px; margin-bottom: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="security-warning">
        ⚠️ DEBUG MODE: This page contains sensitive server information. Do not expose to public.
    </div>

    <h1><?php echo htmlspecialchars($trans['h1'], ENT_QUOTES); ?></h1>

    <h2><?php echo htmlspecialchars($trans['sec1'], ENT_QUOTES); ?></h2>
    <pre class="important"><?php echo $remoteAddr; ?></pre>

    <h2><?php echo htmlspecialchars($trans['sec2'], ENT_QUOTES); ?></h2>
    <pre><?php echo $allHeaders; ?></pre>

    <h2><?php echo htmlspecialchars($trans['sec3'], ENT_QUOTES); ?></h2>
    <pre><?php echo $cfHeaders; ?></pre>

    <h2><?php echo htmlspecialchars($trans['sec4'], ENT_QUOTES); ?></h2>
    <pre><?php echo $proxyHeaders; ?></pre>

    <h2><?php echo htmlspecialchars($trans['sec5'], ENT_QUOTES); ?></h2>
    <pre><?php echo $httpVars; ?></pre>

    <h2><?php echo htmlspecialchars($trans['sec6'], ENT_QUOTES); ?></h2>
    <pre><?php echo $serverVars; ?></pre>

</body>
</html>
