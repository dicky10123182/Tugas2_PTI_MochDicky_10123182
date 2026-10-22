<!DOCTYPE html>
<html lang="<?= e($_SESSION['lang']) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e(t('app_title')) ?></title>
<style>
 body{font-family:Arial,sans-serif;background:#f4f6f8;margin:0;color:#222}
 .nav{background:#1f3a5f;color:#fff;padding:12px 24px;display:flex;justify-content:space-between;align-items:center}
 .nav a{color:#fff;text-decoration:none;margin-left:12px}
 .wrap{max-width:900px;margin:24px auto;background:#fff;padding:24px;border-radius:8px;box-shadow:0 1px 4px rgba(0,0,0,.1)}
 table{width:100%;border-collapse:collapse;margin-top:12px}
 th,td{border:1px solid #ddd;padding:8px;text-align:left}
 th{background:#eef2f7}
 label{display:block;margin-top:12px;font-weight:bold}
 input,select{width:100%;padding:8px;margin-top:4px;box-sizing:border-box}
 .btn{display:inline-block;padding:8px 14px;background:#1f3a5f;color:#fff;border:0;border-radius:4px;cursor:pointer;text-decoration:none;font-size:14px;width:auto}
 .btn-red{background:#c0392b}.btn-gray{background:#7f8c8d}
 .err{background:#fdecea;color:#b71c1c;padding:10px;border-radius:4px;margin-top:12px}
 .ok{background:#e8f5e9;color:#1b5e20;padding:10px;border-radius:4px;margin-top:12px}
 form.inline{display:inline}
</style>
</head>
<body>
<div class="nav">
  <strong><?= e(t('app_title')) ?></strong>
  <div>
    <a href="set_lang.php?lang=id">ID</a> | <a href="set_lang.php?lang=en">EN</a>
    <?php if (isset($_SESSION['user'])): ?>
      <a href="logout.php"><?= e(t('logout')) ?></a>
    <?php endif; ?>
  </div>
</div>
<div class="wrap">
