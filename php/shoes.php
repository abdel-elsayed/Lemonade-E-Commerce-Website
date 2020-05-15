<?php
require("config.php");
if(!isset($_SESSION['source']))
{
	header("Location:loginIndex.php?loginFirst");
}

if(isset($_GET['add_cart'])){
	if( !in_array($_GET['item_id'], $_SESSION['cart_id'])){
		$sql = "INSERT INTO users_add_items (user_id, quantity, item_id) VALUES (?,1,?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ii", $_SESSION['userId'],$_GET['item_id']);
		$stmt->execute();
		
		array_push($_SESSION['cart_id'],$_GET['item_id']);
		header("Location:shoes.php?addedSuccessfully");
		}
}

if(isset($_GET['like'])){
	$sql = "INSERT into users_like_items (user_id,item_id) VALUES(?,?)"; 
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ii", $_SESSION['userId'],$_GET['item_id']);
	$stmt->execute();
	

	$sql = "UPDATE items SET likes= items.likes+1 WHERE item_id =? "; 
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i",$_GET['item_id']);
	$stmt->execute();
	

	array_push($_SESSION['liked_items'],$_GET['item_id']);

	header("Location:shoes.php?likedSuccessfully");

	}

if(isset($_GET['unlike'])){	
	$sql = "DELETE FROM users_like_items WHERE user_id = ? AND item_id = ? "; 
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ii", $_SESSION['userId'],$_GET['item_id']);
	$stmt->execute();
	
	$sql = "UPDATE items SET likes=likes-1 WHERE item_id = ? "; 
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i",$_GET['item_id']);
	$stmt->execute();

	$item_unliked = $_GET['item_id'];
	if (($key = array_search($item_unliked, $_SESSION['liked_items'])) !== false)
	unset($_SESSION['liked_items'][$key]);

	header("Location:shoes.php?UnlikedSuccessfully");

}
$sql = "SELECT item_id FROM users_like_items
WHERE user_id = ? ";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['userId']);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);	
if($result)
	{
	foreach($result as $row){
	  $liked[] = $row;
	}
	   
$_SESSION['liked_items']= array_column($liked,'item_id');
}else 
	{$_SESSION['liked_items']=array();
	}
?>
<html>
<head>
	<title></title >
	<link rel="stylesheet" type= "text/css" href="/project/css/shoes.css">
	<link rel="stylesheet" type= "text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="navBar">
		<h1>
			<a href="bags.php" class="Lemonade">Lemonade <img class="lemon" src="/project/images/lemon.png"></a>
		</h1>
		<ul>
			<li><a href="bags.php" class="bags">Bags</a></li>
			<li><a href="shoes.php" class="shoes">Shoes</a></li>
			<li><a href="profile.php" class="profile">Profile</a></li>
			<li><a href="FrontPage.php?logout=success" class="logout">Logout</a></li>
		</ul>
	</div>

	<div class="container">
	<?php 
$sql = "SELECT * FROM items WHERE type = ?";
$stmt = $conn->prepare($sql);
$input ="S";
$stmt->bind_param("s", $input);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
if($result){
	
	foreach($result as $row){
	$rows[] = $row;}

	 for($i=0; $i<count($rows); $i++){
?>
		<div class="box">
			<div class="detailBox">
				<p class="itemName"><?php echo $rows[$i]['name']?></p>
				<p class="itemPrice">$ <?php echo $rows[$i]['price']?></p>
				<?php
					if(!in_array($rows[$i]['item_id'],$_SESSION['liked_items'])) {
					?> 
					<a href="shoes.php?like=1&item_id=<?php echo $rows[$i]['item_id']?>" ><i class='fa fa-heart fa-lg' style='color:  white'></i></a>
					<?php 
					}elseif(in_array($rows[$i]['item_id'],$_SESSION['liked_items'])) {
					?>
					<a href="shoes.php?unlike=1&item_id=<?php echo $rows[$i]['item_id']?>" ><i class='fa fa-heart fa-lg' style='color: #DC143C'></i></a>
					<?php } ?>	
				<p class="amountLikes"><?php echo $rows[$i]['likes']?></p>
				<?php echo	"<a href='".$rows[$i]['link']."' name='itemInformation'><i class='fa fa-info fa-lg'></i></a>";?>
			</div>
		
			<?php echo "<img class='itemImage' src='/project/images/".$rows[$i]['name'].".jpg'>" ?>
			
			<?php
               if(!in_array($rows[$i]['item_id'],$_SESSION['cart_id'])) {
            ?> 
            <a href="shoes.php?add_cart=1&item_id=<?php echo $rows[$i]['item_id']?>" class="icon"><i class='fa fa-cart-plus fa-2x' style="color: #3498DB"></i></a>
            <?php 
            }else {
            ?>
            <a href="#" class="icon"><i class='fa fa-cart-plus fa-2x' style="color: gray"></i></a>
            <?php
            }
            ?>
		</div>
		<?php
		}
}else{
		echo "No items to display";
		}
	?>
	</div>

</body>
</html>