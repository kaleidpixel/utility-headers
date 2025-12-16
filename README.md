# kaleidpixel/utility

A secure, lightweight utility library for PHP 8.4+, designed for strict infrastructure environments.
Currently features a robust **HTTP Header Inspection Tool** (`headerinfo`).

![PHP Version](https://img.shields.io/badge/php-%3E%3D8.4-777bb4.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)

## ⚠️ SECURITY WARNING

**THIS TOOL EXPOSES SENSITIVE SERVER INFORMATION.**

- **DO NOT** use this tool in a public-facing production environment without strict IP restrictions.
- It displays raw `$_SERVER` variables, internal IP addresses, and proxy headers.
- While output is sanitized against XSS, the information itself allows attackers to fingerprint your infrastructure.

**Recommended usage:**
- Local Development Environment
- Staging Environment (protected by Basic Auth or VPN/IP allow-lists)

---

## Requirements

- **PHP 8.4** or higher
- Composer

## Installation

Install the package via Composer:

```bash
composer require kaleidpixel/utility
```

## Usage

### Header Inspection (`headerinfo`)

This utility provides a beautifully formatted, multi-language (English/Japanese) HTML view of all HTTP headers and server variables. It automatically detects the browser's language preference.

#### Using the global helper function

Simply call the function anywhere in your code to inspect headers. The script will terminate execution (`exit`) after rendering, similar to `phpinfo()`.

```php
<?php

require __DIR__ . '/vendor/autoload.php';

// Dump headers and stop execution
headerinfo();
```

#### Using the Class (Namespace)

If you prefer not to use the global function or want to integrate it into a specific flow:

```php
<?php

use kaleidpixel\utility\headerinfo\HeaderInfo;

require __DIR__ . '/vendor/autoload.php';

// Renders the template
HeaderInfo::render();
exit;
```

## Features

- **Sanitized Output:** All output is escaped using `htmlspecialchars` to prevent XSS attacks.
- **PHP 8.4 Optimized:** Utilizes modern PHP features like `str_starts_with` and typed properties.
- **Cloudflare & Proxy Support:** Dedicated sections for `CF-Connecting-IP`, `X-Forwarded-For`, etc.
- **Multilingual:** Auto-detects `HTTP_ACCEPT_LANGUAGE`.
	- 🇯🇵 Japanese (if `ja` is present)
	- 🇺🇸 English (Default)

## Directory Structure

This package is designed as a collection of utilities.

```text
kaleidpixel/utility
├── src/
│   ├── headerinfo/       # Header Inspection Module
│   │   ├── HeaderInfo.php
│   │   ├── templates/
│   │   └── i18n/
│   ├── (future-module)/  # Future utilities (e.g., 'hoge', 'fuga')
│   └── functions.php     # Global helper functions
└── composer.json
```

## License

This project is licensed under the [MIT License](LICENSE).
