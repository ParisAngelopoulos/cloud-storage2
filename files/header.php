<?php
// Top bar on every page after logging in
$page = basename($_SERVER['PHP_SELF']);
$link = function ($file, $label) use ($page) {
    $active = $page === $file ? 'bg-white/20 text-white' : 'text-sky-100 hover:text-white';
    return '<a href="' . $file . '" class="px-3 py-1.5 rounded-lg ' . $active . '">' . $label . '</a>';
};
?>
<header class="bg-brand text-white">
    <div class="max-w-5xl mx-auto px-4 py-3 flex flex-wrap items-center justify-between gap-3">
        <a href="<?php echo ($_SESSION['role'] ?? '') === 'admin' ? 'admin_page.php' : 'home.php'; ?>" class="flex items-center gap-2 text-xl font-bold">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white/20">☁</span> Cloud Storage
        </a>
        <nav class="flex flex-wrap items-center gap-1 text-sm">
            <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
                <?php echo $link('admin_page.php', 'Overzicht'); ?>
            <?php endif; ?>
            <?php echo $link('home.php', 'Mijn bestanden'); ?>
            <?php echo $link('share.php', 'Delen'); ?>
            <span class="ml-2 text-sky-100">👤 <?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?></span>
            <a href="logout.php" class="ml-2 px-3 py-1.5 rounded-lg bg-white text-brand font-semibold hover:bg-sky-50">Uitloggen</a>
        </nav>
    </div>
</header>
