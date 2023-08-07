<?php
include("header.php");
?>
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
                            <input type='submit' name='show_details' value='Show Details' class='book bg-green-500 px-2 py-1 text-xs md:text-sm font-semibold rounded cursor-pointer'>
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
