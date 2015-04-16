<?php session_start(); 
include( "../../DataUtil/common.inc.php"); 
include( "../../DataUtil/DataAccess.inc.php"); 
if($_SESSION[ 'screenName']){ 
include '../../includes/_adminHeader.php'; 
$da=new DataAccess($link); 
$images=$da->get_images(); 
// output data of each row 

//Image Upload validaion
//define a maxim size for the uploaded images in Kb
define ("MAX_SIZE","10000"); 


//This function reads the extension of the file. It is used to determine if the file is an image by checking the extension. 
function getExtension($str) {
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}


//This variable is used as a flag. The value is initialized with 0 (meaning no error found) and it will be changed to 1 if an errro occures. If the error occures the file will not be uploaded.
$errors=0;
//checks if the form has been submitted
if(isset($_POST['Submit'])) 
{
    
//reads the name of the file the user submitted for uploading
$image=$_FILES['image']['name'];
//if it is not empty
if ($image) 
{
//get the original name of the file from the clients machine
$filename = stripslashes($_FILES['image']['name']);
//get the extension of the file in a lower case format
$extension = getExtension($filename);
$extension = strtolower($extension);
//if it is not a known extension, we will suppose it is an error and will not upload the file, otherwize we will do more tests
if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))	
{
//print error message
echo '<h1>Unknown extension!</h1>';
$errors=1;
}
else
{
//get the size of the image in bytes
//$_FILES['image']['tmp_name'] is the temporary filename of the file in which the uploaded file was stored on the server
$size=filesize($_FILES['image']['tmp_name']);


//compare the size with the maxim size we defined and print error if bigger
if ($size > MAX_SIZE*1024)
{
echo '<h1>You have exceeded the size limit!</h1>';
$errors=1;
}

//we will give an unique name, for example the time in unix time format
$image_name=$filename;


//the new name will be containing the full path where will be stored (images folder)
$newname="../../images/".$image_name;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['image']['tmp_name'], $newname);
if (!$copied) 
{
echo '<h1>Copy unsuccessfull!</h1>';
$errors=1;
}}}}

//If no errors registred, print the success message
if(isset($_POST['Submit'])) 
{
    if(!empty($filename)){

    if(!$errors){
echo "<h1>File Uploaded Successfully! Try again!</h1>";
     $da = new DataAccess($link);
     $image_name = $filename;
     $da->insert_image("$image_name");
     ?>
    <meta http-equiv="refresh" content="0">
    <?php
}
}else{
    echo '<h1>No file selected! Please try again.</h1>';
}
}

?>
<a href="image-upload.php">Add New Image</a>

<div class="tab-container">
    <ul class="etabs">

        <li class="tab">
            <a href="#tab1"><i class=icon-feather></i>Image List</a>
        </li>


        <li class="tab">
            <a href="#tab2"><i class=icon-drive></i>Upload Image</a>
        </li>


        <li class="tab">
            <a href="#tab3"><i class=icon-map></i>View Images</a>
        </li>

    </ul>

    <div class="tabs-content">
        <div id="tab1">
            <table class="table">
                <thead>
                    <th>Image Titles</th>
                    <th>Active</th>

                </thead>
                <tbody>
                    <?php foreach($images as $image){ 
                    echo( "<tr>"); 
                    echo( "<td>{$image['image_filename']}</td>"); 
                    echo( "<td>{$image['image_active']}</td>"); 
                    
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="tab2">
            <form name="newad" method="post" enctype="multipart/form-data" action="">
            <table>
            <tr><td><input type="file" name="image"></td></tr>
            <tr><td><input name="Submit" type="submit" value="Upload image"></td></tr>
            </table>	
            </form>

        </div>
        <div id="tab3">
            <div class="sidebar-icon-item">
                <i class="icon-phone"></i> (+1) 777-444-333
            </div>
            <div class="sidebar-icon-item">
                <i class="icon-mail"></i> email@company.com
            </div>
            <div class="sidebar-icon-item">
                <i class="icon-home"></i> Address in City, P.O BOX 1111, Country
            </div>

            <div class="social-icons">

                <ul>
                    <li>
                        <a href="#" title="facebook" target="_blank" class="social-media-icon facebook-icon">zerply</a>
                    </li>
                    <li>
                        <a href="#" title="twitter" target="_blank" class="social-media-icon twitter-icon">dropbox</a>
                    </li>
                    <li>
                        <a href="#" title="digg" target="_blank" class="social-media-icon digg-icon">digg</a>
                    </li>
                    <li>
                        <a href="#" title="mail" target="_blank" class="social-media-icon mail-icon">mail</a>
                    </li>
                    <li>
                        <a href="#" title="flickr" target="_blank" class="social-media-icon flickr-icon">flickr</a>
                    </li>

                </ul>

            </div>

        </div>
    </div>

</div>

<?php }else{ include '../../includes/_header.php'; echo "you are not an admin"; } include '../../includes/_footer.php'; ?>