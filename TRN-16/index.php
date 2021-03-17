
<?php echo file_get_contents("index.html")?>

<?php
  //variables for first name and last name
$nameErr=$full_name=$first_name=$last_name="";

if ($_SERVER['REQUEST_METHOD']=="POST"){
    //check if the input field is filled or not
  if (empty($_POST["firstname"])) {
    $nameErr = "First Name is required";
  } else {
    $first_name = test_input($_POST["firstname"]);
    // checks if fist name only contains letters
    if (!preg_match("/^[a-zA-Z]*$/",$first_name)) {
      $nameErr = "Only letters allowed";
    }
  }
    //check if the input field is filled or not
  if (empty($_POST["lastname"])) {
    $nameErr = "Last Name is required";
  } else {
    $last_name = test_input($_POST["lastname"]);
    // checks if last name only contains letters
    if (!preg_match("/^[a-zA-Z]*$/",$last_name)) {
      $nameErr = "Only letters allowed";
    }
  }

}

//function fro test input

function test_input($data){
  $data=trim($data);
  return $data;
}

?>


<?php
$full_name=$first_name." ".$last_name;

echo "<br>";

echo "Hello ".$full_name."!";

echo "<br>";
?>


<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}
?>

<?php
echo "<br>";
echo "Full Name: ".$full_name;
echo "<br>";
?>

