<?php $lang = $lang ?? ($_GET['lang'] ?? 'en'); ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>SharePet</title>
</head>

<body>

<div class="col justify-content-between" style="background-color: rgba(108, 238, 8, 0.2);">
    <div class="d-flex justify-content-between p-3">
        <div class="d-flex align-items-center">
            <span class="h4 mb-0">SharePet</span>
        </div>

        <div class="d-flex justify-content-center align-items-center gap-2">

            <label for="language-select">Language:</label>

            <select id="language-select" class="form-select form-select-sm"
                    onchange="changeLanguage(this.value)">

                <option value="en" <?= $lang === 'en' ? 'selected' : '' ?>>English</option>
                <option value="ja" <?= $lang === 'ja' ? 'selected' : '' ?>>日本語</option>

            </select>

            <a href="/?lang=<?= $lang ?>" class="btn btn-outline-success">Home</a>
            <a href="/about?lang=<?= $lang ?>" class="btn btn-outline-success">About</a>

        </div>
    </div>
</div>

<main class="container mt-5 mb-5">


<script>
function changeLanguage(lang) {
    const url = new URL(window.location.href);
    url.searchParams.set('lang', lang);
    window.location.href = url.toString();
}
</script>