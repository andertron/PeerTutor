<?php
session_start();

include("../../DataUtil/common.inc.php");
include("../../DataUtil/DataAccess.inc.php");

if($_SESSION['screenName']){
    include '../../includes/_adminHeader.php';
    $da = new DataAccess($link);
    $post= $da->get_post();
     // output data of each row
     ?>
     <a href = "post-add.php">Add New Post</a>
     <table>
         <thead>
             <th>Post Title</th>
             <th>Post Date</th>
             <th>Content</th>
         </thead>
         <tbody>
            <?php
				foreach($post as $post){
					echo("<tr>");
					echo("<td>{$post['post_title']}</td>");
					echo("<td>{$post['post_date']}</td>");
					echo("<td>{$post['post_content']}</td>");
					echo("<td><a href=\"edit-post.php?post_id={$post['post_id']}\">EDIT</a></td>");
					echo("</tr>");
				}
				?>
         </tbody>
     </table>
     <?php

?>  

<?php		
}else{
    include '../../includes/_header.php';
    echo "you are not an admin";
}

include '../../includes/_footer.php';
?>