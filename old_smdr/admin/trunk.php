<!DOCTYPE html>
<html>
<head>
    <title>SMDR reporting</title>
    <style type="text/css">
    </style>
</head>
<?php
session_start();

if (!isset($_SESSION['USERNAME'])) {
    header("Location:/smdr/index.php");
    die(); // just to make sure no scripts execute
}
include_once $_SERVER['DOCUMENT_ROOT'] . "/smdr/config/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/smdr/admin/menu.php";

$query = "SELECT * FROM trunks ORDER BY id ASC";
$result = mysqli_query($con, $query);

?>
<body>
    <div id="main" style="overflow-x:scroll;overflow-y:scroll;width:78%;height:90%">
        <h2 align="center" class="style1">Trunks</h2>
        <table border="1" id="trunks">
            <tr>
                <td nowrap>
                    <div align="center">
                        <font size="-1"><strong>Trunk <a href='trunkadd.php'> New</a></strong></font>
                    </div>
                </td>
                <td nowrap>
                    <div align="center">
                        <font size="-1"><strong>Name</strong></font>
                    </div>
                </td>
            </tr>
            <?php
            $rowno = 0;
            while ($row = mysqli_fetch_object($result)) {
                $rowno += 1;
                ?>
                <tr>
                    <td>
                        <div align="center">
                            <font size="-1">
                                <a href='trunked.php?a=<?php echo ($row->id);?> '><?php echo ($row->trunk);?></a>
                            </font>
                        </div>
                    </td>
                    <td>
                        <div align="center">
                            <font size="-1"><?php echo ($row->name);?></font>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</body>
</html>
