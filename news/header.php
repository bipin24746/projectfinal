<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">


<div class="bg-gray-900 text-white font-bold pl-4">
    <div class="container mx-auto py-2">
        <div class="flex justify-between items-center px-4">
            <a href="index.php" class="text-white text-2xl font-bold no-underline">MOVIE WORLD</a>
            <ul class="list-none m-0 p-0">
                <li class="inline-block mr-6">
                    <a href="#" class="text-white no-underline" id="movies-link">Movies</a>
                    <ul class="hidden absolute bg-gray-900 text-white text-sm mt-2" id="movies-dropdown">
                        <li><a href="#" class="block py-2 px-4">Now Showing</a></li>
                        <li><a href="#" class="block py-2 px-4">Coming Soon</a></li>
                    </ul>
                </li>
                <?php
                if (isset($_SESSION['email'])) {
                    echo '<li class="inline-block mr-6">
                            <a href="logout.php" class="text-white no-underline">Logout</a>
                          </li>';
                } else {
                    echo '<li class="inline-block mr-6">
                            <a href="login.php" class="text-white no-underline">Login</a>
                          </li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<script>
    const moviesLink = document.getElementById('movies-link');
    const moviesDropdown = document.getElementById('movies-dropdown');

    moviesLink.addEventListener('click', function (event) {
        event.preventDefault();
        moviesDropdown.classList.toggle('hidden');
    });
</script>
