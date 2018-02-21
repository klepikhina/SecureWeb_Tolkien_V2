<?php
#Purpose: Homework 6
#Author: Ksenia Lepikhina ksle1621@colorado.edu
#Version: 1.0
#Date: 02/27/2018
include_once('/var/www/html/hw6/hw6-lib.php');
echo "<html> <head> <title> Tolkien </title> </head> <body>";
$db=connect();
echo "<a href=index.php?s=4> Characters </a>";
if(is_numeric($s) || $s==NULL) {
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
                        $sid=htmlspecialchars($sid);
                        $bid=htmlspecialchars($bid);
                        $query = "SELECT b.bookid, b.title  from books b, stories s where b.storyid=s.storyid and b.storyid=$sid";
                        $result = mysqli_query($db, $query);
                        
                        while($row=mysqli_fetch_row($result)) {
                                echo "<tr> <td> <a href=index.php?bid=$row[0]&s=2> $row[1] </a> </td> </tr> \n";
                        }
                        echo "</table>";
                        break;
                case 2: 
                        echo "<table> <tr> <td> <b> <u> Characters </b> </u> </td> </tr> \n";
                        $bid=htmlspecialchars($bid);
                        $sid=htmlspecialchars($sid);
                        $cid=htmlspecialchars($cid);
                        $query = "SELECT a.characterid, c.name from appears a, characters c where c.characterid=a.characterid and a.bookid=$bid";
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
                default:
                        echo "<table> <tr> <td> <b> <u> Stories </b></u> </td></tr> \n";
                        $query = "SELECT storyid, story from stories";
                        $result = mysqli_query($db, $query);
                        $sid=htmlspecialchars($sid);
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
