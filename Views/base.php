<!doctype HTML>
<html lang="pl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Paweł Cichoń - best project on the earth</title>
    <link rel="stylesheet" type="text/css" href="/pcichon/public/css/styles.css">
    <link rel="stylesheet" type="text/css" href="/pcichon/public/css/fa/css/all.css"> <!-- style Fontawesome -->
</head>
<body>
<header>
    <nav>
        <ul class="menu">
            <li><a href="/pcichon/index">Home</a></li>
            <?php if(!isset($_SESSION["logged_in"])): ?>
                <li><a href="/pcichon/index/login">Zaloguj</a></li>
            <?php elseif( isset($_SESSION["logged_in"]) && isset($_SESSION["role"]) && $_SESSION["role"] === "admin" ): ?>
                <li><a href="/pcichon/admin">Panel admina</a></li>
                <li><a href="/pcichon/index/logout">Wyloguj</a></li>
             <?php elseif( isset($_SESSION["logged_in"]) && isset($_SESSION["role"]) && $_SESSION["role"] === "employee" ): ?>
                <li><a href="/pcichon/employee">Panel pracownika</a></li>
                <li><a href="/pcichon/index/logout">Wyloguj</a></li>
            <?php else: ?>
                <li><a href="/pcichon/index/logout">Wyloguj</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main class="content">
    <?php include $template; ?>
</main>
</body>
</html>