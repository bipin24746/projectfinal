<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie World</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<!-- Header section -->
<div class="bg-gray-900 text-white font-bold pl-4">
    <div class="container mx-auto py-2">
        <div class="flex justify-between items-center px-4">
            <a href="index.php" class="text-white text-2xl font-bold no-underline">MOVIE WORLD</a>
            <!-- Navigation menu -->
            <ul class="list-none m-0 p-0">
                <li class="inline-block mr-6">
                    <a href="#" class="text-white no-underline" id="movies-link">Movies</a>
                    <!-- Dropdown menu for movies -->
                    <ul class="hidden absolute bg-gray-900 text-white text-sm mt-2" id="movies-dropdown">
                        <li><a href="#" class="block py-2 px-4">Now Showing</a></li>
                        <li><a href="comingsoon.php" class="block py-2 px-4">Coming Soon</a></li>
                    </ul>
                </li>
               <a href="mybookings.php" class="px-2">My Bookings</a>
                <?php
                // Check if a user is logged in and display appropriate menu option
                session_start();
                if (isset($_SESSION['email'])) {
                    echo '<li class="inline-block mr-6">
                            <a href="logout.php" class="text-white no-underline">Logout</a>
                          </li>';
                } else {
                    echo '<li class="inline-block mr-6">
                            <a href="login.php" class="text-white no-underline">Login</a>
                          </li>';
                          echo '<li class="inline-block mr-6">
                            <a href="register.php" class="text-white no-underline">Register</a>
                          </li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<!-- Main content section -->
<div class=" max-w-5xl mx-auto">
    <h2 class="text-center font-semibold">Now Showing</h2>

    <!-- Movie cards container -->
    <div class="flex flex-wrap justify-space">
        <?php
        // Establish a connection to the database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "moviebooking";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve movies from the database
        $sql = "SELECT * FROM movie";
        $result = $conn->query($sql);

        // Display movie cards
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mid = $row['id'];
                $name = $row['name'];
                $image = $row['image'];

                echo "
                <div class='movie-card border-2 border-gray-300 p-2 md:p-4 w-1/2 md:w-2/4 lg:w-1/4 m-2'>
                    <img src='images/$image' alt='Movie Poster' class='h-32 md:h-48 w-full object-cover'>
                    <div class='movie-details mt-2'>
                        <h5 class='movie-name text-sm md:text-base font-bold mb-1'>$name</h5>";

                        
                // Check if a user is logged in and display "Book Now" button
                if (isset($_SESSION['email'])) {
                    echo "<form action='booking.php' method='post'>
                            <input type='hidden' name='mid' value='$mid'>
                            <input type='hidden' name='mname' value='$name'>
                            <input type='submit' name='book_now' value='Book Now' class='book bg-green-500 px-2 py-1 text-xs md:text-sm font-semibold rounded cursor-pointer'>
                          </form>";
                }
                echo "</div>
                </div>";
            }
        } else {
            echo "No movies found.";
        }
        $conn->close();
        ?>
    </div>
</div>

<script>
    // Dropdown menu functionality
    const moviesLink = document.getElementById('movies-link');
    const moviesDropdown = document.getElementById('movies-dropdown');

    moviesLink.addEventListener('click', function (event) {
        event.preventDefault();
        moviesDropdown.classList.toggle('hidden');
    });
</script>



<?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moviebooking";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve coming soon movies from the database
$sql = "SELECT * FROM coming_soon";
$result = $conn->query($sql);

?>
    <h1>Coming Soon Movies</h1>
    <div class="movie-container flex flex-wrap justify-center">
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mid = $row['id'];
                $name = $row['name'];
                $image = $row['image'];

                echo "
                <div class='movie-card border-2 border-gray-300 p-2 md:p-4 w-1/2 md:w-2/4 lg:w-1/4 m-2'>
                    <img src='images/$image' alt='Movie Poster' class='h-32 md:h-48 w-full object-cover'>
                    <div class='movie-details mt-2'>
                        <h5 class='movie-name text-sm md:text-base font-bold mb-1'>$name</h5>";

                // Add more details if needed
                if (isset($_SESSION['email'])) {
                    echo "<form action='showdetails.php' method='post'>
                            <input type='hidden' name='mid' value='$mid'>
                            <input type='hidden' name='mname' value='$name'>
                            <input type='submit' name='book_now' value='Show Details' class='book bg-green-500 px-2 py-1 text-xs md:text-sm font-semibold rounded cursor-pointer'>
                          </form>";
                }
                echo "</div>
                </div>";
            }
        } else {
            echo "No coming soon movies found.";
        }
        $conn->close();
        ?>
    </div>
    
<script>
    // Dropdown menu functionality
    const moviesLink = document.getElementById('movies-link');
    const moviesDropdown = document.getElementById('movies-dropdown');

    moviesLink.addEventListener('click', function (event) {
        event.preventDefault();
        moviesDropdown.classList.toggle('hidden');
    });
</script>
</body>
</html>
