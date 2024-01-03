<style>
    .leftmenu {
        height: 60px;
        display: flex;
        justify-content: space-around;
        position: fixed;
        top: 60px;
        left: 200px;
        right: 0;
        z-index: 1000;
        background-color: #fff;
    }

    .leftmenu a {
        padding: 10px;
        border-radius: 15px;
        background-color: #f2f2f2;
        text-decoration: none;
        color: black;
        font-size: 15px;
        font-weight: bold;
        height: 40px;
        transition: background-color 0.3s ease;
    }

    .leftmenu a:hover {
        background-color: #d9d9d9;
    }

    .leftmenu a.active {
        background-color: #007bff;
        color: white;
    }
</style>

<?php
include_once("Database/connect-mysql.php");

$sql = "SELECT * FROM `category`";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error in SQL query: " . mysqli_error($conn));
}

$rows = mysqli_num_rows($result);

if ($rows) {
    echo '<div class="leftmenu">';
    echo '<a href="index.php" class="' . ((!isset($_GET['categoryid'])) ? 'active' : '') . '">Tất cả</a>';
    
    while ($row = mysqli_fetch_array($result)) {
        echo '<a href="index.php?categoryid=' . $row["categoryid"] . '" class="' . ((isset($_GET['categoryid']) && $_GET['categoryid'] == $row["categoryid"]) ? 'active' : '') . '">' . $row['categoryname'] . '</a>';
    }

    echo '</div>';
}

// Don't forget to close the result set
mysqli_free_result($result);

// Close the database connection
mysqli_close($conn);
?>
