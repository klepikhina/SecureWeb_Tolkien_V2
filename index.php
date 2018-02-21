<?php
#Purpose: Homework 6
#Author: Ksenia Lepikhina ksle1621@colorado.edu
#Version: 1.0
#Date: 02/27/2018
include_once('/var/www/html/hw6/hw6-lib.php');
echo "<html> <head> <title> Tolkien </title> </head> <body>";
$db=connect();
echo "<a href=index.php?s=4> Characters </a>";
if(icheck($s)) {
        switch($s) {
                case 0:
                        echo "<table> <tr> <td> <b> <u> Stories </b></u> </td></tr> \n";
                        $sid=htmlspecialchars($sid);
                        $query = "SELECT storyid, story from stories";
                        $result = mysqli_query($db, $query);
                        
                        while($row=mysqli_fetch_row($result)) {
                                echo "<tr> <td> <a href=index.php?sid=$row[0]&s=1> $row[1] </a> </td> </tr> \n";
                        }        
                        echo "</table>";
                        break;   
                case 1: 
                        echo "<table> <tr> <td> <b> <u> Books </b> </u> </td> </tr> \n";
                        $sid=mysqli_real_escape_string($db, $sid);
                        if ($stmt = mysqli_prepare($db, "SELECT bookid, title  from books where storyid=?")) {
                                mysqli_stmt_bind_param($stmt, "s", $sid);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $bid, $title);
                                while(mysqli_stmt_fetch($stmt)) {
                                        $bid=htmlspecialchars($bid);
                                        $title=htmlspecialchars($title);
                                        echo "<tr> <td> <a href=index.php?bid=$bid&s=2> $title </a> </td> </tr> \n";
                                }
                                mysqli_stmt_close($stmt);
                        }
                        echo "</table>";
                        break;
                case 2: 
                        echo "<table> <tr> <td> <b> <u> Characters </b> </u> </td> </tr> \n";
                        $sid=mysqli_real_escape_string($db, $sid);
                        $bid=mysqli_real_escape_string($db, $bid);
                        $cid=mysqli_real_escape_string($db, $cid);
                        if ($stmt = mysqli_prepare($db, "SELECT a.characterid, c.name from appears a, characters c where c.characterid=a.characterid and a.bookid=$bid")) {
                               mysqli_stmt_bind_param($stmt, "s", $sid);
                               mysqli_stmt_execute($stmt);
                               mysqli_stmt_bind_result($stmt, $bid, $title);
                               while(mysqli_stmt_fetch($stmt)) {
                                       $bid=htmlspecialchars($bid); 
                        $result = mysqli_query($db, $query);
                        while($row=mysqli_fetch_row($result)) {
                                 echo "<tr> <td> <a href=index.php?cid=$row[0]&s=3> $row[1] </a> </td> </tr> \n";
                        }
                        echo "</table>";
                        break;
                case 3:
                        echo "<table> <tr> <td> <b> <u> Appearances </b> </u> </td> </tr> \n
                        <tr> <td> Character </td> <td> Book </td> <td> Story </td> </tr> \n";
                        $cid = htmlspecialchars($cid);
                        $sid=htmlspecialchars($sid);
                        $bid=htmlspecialchars($sid);
                        $query = "SELECT c.name, b.title, s.story from books b, characters c, stories s, appears a where a.characterid=$cid and a.bookid=b.bookid and s.storyid=b.storyid and c.characterid=a.characterid";
                        $result = mysqli_query($db, $query);
                        while($row=mysqli_fetch_row($result)) {
                                echo "<tr> <td> <a href=index.php?s=0>$row[0]</a> </td>
                                <td> <a href=index.php?s=0>$row[1] </a> </td>
                                <td> <a href=index.php?s=0>$row[2] </a> </td> </tr> \n";
                        }
                        echo  "</table>";
                        break;
                case 4:
echo "<table> <tr> <td> <b> <u> Characters </b> </u> </td> </tr> \n
                        <tr> <td> Characters </tr> <tr> Pictures </tr> </td>  \n";
                        $sid = htmlspecialchars($sid);
                        $bid = htmlspecialchars($bid);
                        $cid = htmlspecialchars($cid);
                        $query = "SELECT c.name, p.url, c.characterid from characters c, pictures p where p.characterid=c.characterid";
                        $result = mysqli_query($db, $query);
                        while($row=mysqli_fetch_row($result)) {
                                 echo "<tr> <td> <a href=index.php?s=0>$row[0]</a> </td>
                                    <td> <a href=index.php?s=50>$row[1] </a> </td>
                                    <td> <a href=index.php?s=50>$row[2] </a> </td> </tr> \n";
                        }
                        echo  "</table>";
                        break;
                case 5:
                        $characterName=mysqli_real_escape_string($db, $characterName);
                        $characterRace=mysqli_real_escape_string($db, $characterRace);
                        $characterSide=mysqli_real_escape_string($db, $characterSide);
                        if ($stmt = mysqli_prepare($db, "INSERT INTO characters set characterid='', name=?, race=?, side=?")) {
                                mysqli_stmt_bind_param($stmt, "sss", $characterName, $characterRace, $characterSide);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_close($stmt);
                        } 
                        if ($stmt = mysqli_prepare($db, "SELECT characterid from characters where name=? and race=? and side=? order by characterid desc limit 1")) {
                                mysqli_stmt_bind_param($stmt, "sss", $characterName, $characterRace, $characterSide);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $cid);
                                while(mysqli_stmt_fetch($stmt)) {
                                        $cid=$cid;
                                }
                                mysqli_stmt_close($stmt);
                        } else {
                                echo "Error with query";
                        }
                default:
                        echo "<table> <tr> <td> <b> <u> Stories </b></u> </td></tr> \n";
                        $query = "SELECT storyid, story from stories";
                        $result = mysqli_query($db, $query);
                        while($row=mysqli_fetch_row($result)) {
                                echo "<tr> <td> <a href=index.php?sid=$row[0]&s=1> $row[1] </a> </td> </tr> \n";
                        }
                        echo "</table>";
                        break;
        }
} else {
        echo "Stop messing with my website";
}
echo "</body> </html>";
?>
