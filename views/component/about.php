<?php
$lang = $lang ?? 'en';
?>

<div class="container mt-5">

<?php if ($lang === 'ja'): ?>

    <h1>このアプリについて</h1>

    <p>
        このアプリは、コードやテキストスニペットを簡単に共有するためのツールです。
    </p>

    <p>
        ユーザーはコードを入力し、リンクを生成して他の人と共有できます。
        生成されたリンクからは、シンタックスハイライト付きでコードを閲覧できます。
    </p>

    <p>
        このアプリはPHPとMonaco Editorを使用して構築されています。
    </p>

<?php else: ?>

    <h1>About This App</h1>

    <p>
        This application allows users to easily share code and text snippets.
    </p>

    <p>
        Users can enter code, generate a unique link, and share it with others.
        The shared link allows viewing the snippet with syntax highlighting.
    </p>

    <p>
        This app is built using PHP and Monaco Editor.
    </p>

<?php endif; ?>

</div>