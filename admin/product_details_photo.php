<?php
	include 'includes/session.php';
	include 'includes/connection.php';

   /*  image 1 update */

	if(isset($_POST['upload1'])){
		$id = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		$imageErr="";

		$target_dir = "uploaded_images/product_details_images/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

		if(empty($filename)){
            $imageErr="* Before Updating Select File!";
		}
		else if(!in_array($imageFileType,$extensions_arr))
        {  
            $imageErr="* Extension Supported: jpg, jpeg, png, gif!";
		}
		else{

			try{
				move_uploaded_file($_FILES['photo']['tmp_name'],$target_dir.$filename);	
				$update_query = "UPDATE product_details SET p_image_1='$filename' WHERE p_id=$id";
                mysqli_query($conn, $update_query);
				$_SESSION['success'] = 'Product Image 1 Updated Successfully';
				mysqli_close($conn);
				header('location: product_details.php');
				exit;
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				header('location: product_details.php');
				exit;
			}
		}

		$_SESSION['error'] = $imageErr;
		header('location: product_details.php');
		exit;
	}

    /*  image 2 update */

	if(isset($_POST['upload2'])){
		$id = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		$imageErr="";

		$target_dir = "uploaded_images/product_details_images/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

		if(empty($filename)){
            $imageErr="* Before Updating Select File!";
		}
		else if(!in_array($imageFileType,$extensions_arr))
        {  
            $imageErr="* Extension Supported: jpg, jpeg, png, gif!";
		}
		else{

			try{
				move_uploaded_file($_FILES['photo']['tmp_name'],$target_dir.$filename);	
				$update_query = "UPDATE product_details SET p_image_2='$filename' WHERE p_id=$id";
                mysqli_query($conn, $update_query);
				$_SESSION['success'] = 'Product Image 2 Updated Successfully';
				mysqli_close($conn);
				header('location: product_details.php');
				exit;
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				header('location: product_details.php');
				exit;
			}
		}

		$_SESSION['error'] = $imageErr;
		header('location: product_details.php');
		exit;
	}

    /*  image 3 update */

	if(isset($_POST['upload3'])){
		$id = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		$imageErr="";

		$target_dir = "uploaded_images/product_details_images/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

		if(empty($filename)){
            $imageErr="* Before Updating Select File!";
		}
		else if(!in_array($imageFileType,$extensions_arr))
        {  
            $imageErr="* Extension Supported: jpg, jpeg, png, gif!";
		}
		else{

			try{
				move_uploaded_file($_FILES['photo']['tmp_name'],$target_dir.$filename);	
				$update_query = "UPDATE product_details SET p_image_3='$filename' WHERE p_id=$id";
                mysqli_query($conn, $update_query);
				$_SESSION['success'] = 'Product Image 3 Updated Successfully';
				mysqli_close($conn);
				header('location: product_details.php');
				exit;
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				header('location: product_details.php');
				exit;
			}
		}

		$_SESSION['error'] = $imageErr;
		header('location: product_details.php');
		exit;
	}

    /*  image 3 update */

	if(isset($_POST['upload4'])){
		$id = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		$imageErr="";

		$target_dir = "uploaded_images/product_details_images/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

		if(empty($filename)){
            $imageErr="* Before Updating Select File!";
		}
		else if(!in_array($imageFileType,$extensions_arr))
        {  
            $imageErr="* Extension Supported: jpg, jpeg, png, gif!";
		}
		else{

			try{
				move_uploaded_file($_FILES['photo']['tmp_name'],$target_dir.$filename);	
				$update_query = "UPDATE product_details SET p_image_4='$filename' WHERE p_id=$id";
                mysqli_query($conn, $update_query);
				$_SESSION['success'] = 'Product Image 4 Updated Successfully';
				mysqli_close($conn);
				header('location: product_details.php');
				exit;
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				header('location: product_details.php');
				exit;
			}
		}

		$_SESSION['error'] = $imageErr;
		header('location: product_details.php');
		exit;
	}
?>