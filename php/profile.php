<?php
require("config.php");
if(isset($_SESSION['source'])) // when accessed from the login page or the update_profile page, it fetches all the variables
{
	
	$sql = "SELECT user_id,first_name,last_name,phone,username,email,password FROM users 
	WHERE user_id = ?"; // fetch the information when accessed from login or recently updated
	
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $_SESSION['userId']);
	$stmt->execute();
	$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	if($result){
		foreach($result as $row){
	
	$_SESSION['userId']= $row['user_id'];
	$_SESSION['firstname'] = $row['first_name'];
	$_SESSION['lastname'] =$row['last_name'];
	$_SESSION['email'] = $row['email'];
	$_SESSION['phone'] = $row['phone'];
	$_SESSION['username'] = $row['username'];
	$_SESSION['password'] = $row['password'];
		}
	}
	
}elseif($_SESSION['source']== NULL) 
{
	header("Location:loginIndex.php?error=loginFirst");
	exit();
}

if(isset($_GET['delete'])){
	
	$sql = "DELETE FROM users_add_items WHERE item_id = ? ";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $_GET['itemId'] );
	$stmt->execute();
	
	$value_to_delete = $_GET['itemId'];
	if (($key = array_search($value_to_delete, $_SESSION['cart_id'])) !== false)
		unset($_SESSION['cart_id'][$key]);

	header("Location:profile.php?deletedsuccessfully");
	}

if(isset($_POST['update'])){
	if( $_POST['newQuan']>0){
		
		$sql = "UPDATE users_add_items SET quantity = ? WHERE item_id =? "; 
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ii", $_POST['newQuan'],$_GET['itemId'] );
		$stmt->execute();
		
		header("Location:profile.php?updatedSuccessfully");}
}

if(isset($_GET['like'])){
	
	$sql = "INSERT into users_like_items (user_id,item_id) VALUES(?,?)"; 
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ii", $_SESSION['userId'],$_GET['item_id']);
	$stmt->execute();
	
	$sql = "UPDATE items SET likes= items.likes+1 WHERE item_id = ? ";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i",$_GET['item_id']);
	$stmt->execute();

	array_push($_SESSION['liked_items'],$_GET['item_id']);
	header("Location:profile.php?likedSuccessfully");
	}

if(isset($_GET['unlike'])){	
	$sql = "DELETE FROM users_like_items WHERE user_id =? AND item_id =?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ii", $_SESSION['userId'],$_GET['item_id']);
	$stmt->execute();	
	
	$sql = "UPDATE items SET likes=likes-1 WHERE item_id =? "; 
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i",$_GET['item_id']);
	$stmt->execute();

	$item_unliked = $_GET['item_id'];
	if (($key = array_search($item_unliked, $_SESSION['liked_items'])) !== false)
	unset($_SESSION['liked_items'][$key]);

	header("Location:profile.php?UnlikedSuccessfully");

}

?>

<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type= "text/css" href="/project/css/style4.css">
	<link rel="stylesheet" href="project/css/font-awesome/css/font-awesome.min.css">
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
	<div class="wrapper">
    	<div class="card"> 
    		<a href="#" name="darkMode"><i class='fa fa-moon-o fa-2x'></i></a>
    		<img class="profileIcon" src="/project/images/user.jpeg" alt="user Icon">

    		<table class="table1">	
    	    	<tr>
    	    		<td>
    	    			<p class="name"><?php  echo  $_SESSION['firstname']. " ". $_SESSION['lastname'] ?></p>
    	    		</td>

    	    		<td>
    	    			<a href = "update_profile.php?subject=name"> update  </a>
    	    		</td>
    	    	</tr>

    	    	<tr>
    	    		<td>
    	    			<p><i class="fa fa-user-circle"></i><?php echo " ". $_SESSION['username'] ?></p>
    	    		</td>

    	    		<td>
    	    			<a href = "update_profile.php?subject=username"> update  </a>
    	    		</td>
    	    	</tr>

    	    	<tr>
    	    		<td>
    	    			<p><i class="fa fa-envelope-square"></i><?php echo " ".$_SESSION['email'] ?></p>
    	    		</td>
    	    		<td>
    	    			<a href = "update_profile.php?subject=email" > update</a>
    	    		</td>
    	    	</tr>

    	    	<tr>
    	    		<td>
    	    			<p><i class="fa fa-phone"></i><?php echo " ".$_SESSION['phone'] ?></p>
    	    		</td>

    	    		<td>
    	    			<a href ="update_profile.php?subject=phone" > update</a>
    	    		</td>
    	    	</tr>

    	    	<tr>
    	    		<td>
    	    			<a href="update_profile.php?subject=password" >Change Password</a>
    	    		</td>
    	    	</tr>
    	    </table>
		</div>

		<div class="card2">
			<table class="table2">
	
<?php 
		
	$sql = "SELECT items.item_id, items.name, items.price, items.link, items.likes,users_add_items.quantity  
	FROM items INNER JOIN users_add_items ON items.item_id = users_add_items.item_id WHERE users_add_items.user_id =?"; //get the cart items
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $_SESSION['userId']);
	$stmt->execute();
	$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);	
	if($result)
		{
		foreach($result as $row){
		   $rows[] = $row;}
		   
		$sql = "SELECT item_id FROM users_like_items
		WHERE user_id = ?"; 
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $_SESSION['userId']);
		$stmt->execute();
		$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		
		if($result){
			foreach($result as $row){
				$liked[] = $row;
			}
			$_SESSION['liked_items']= array_column($liked,'item_id');
		}else 
			{$_SESSION['liked_items']=array();
		}
		
		$total =0;
		for($i=0; $i<count($rows); $i++){
	?>	
					<td class="outter">
						<?php echo "<img align='left' class='itemImg' src='/project/images/".$rows[$i]['name'].".jpg'" ?>
						
						<h1  class="itemTitle"></h1>
						<?php echo "<h1 class='itemTitle'>".$rows[$i]['name']."</h1>"?>
						
						<table class="table3">
							<tr class="innerRow">

								<td class="icon1">
									<a href="profile.php?delete=true&itemId=<?php echo $rows[$i]['item_id']; ?>" 
										name="deleteFromWishList">
										<i class="fa fa-trash fa-lg"></i>
									</a>
								</td>

								<td class="icon2">
									<?php echo	"<a href='".$rows[$i]['link']."' name='itemInformation'><i class='fa fa-info fa-lg'></i></a>";?>
								</td>
				
								<td class="icon3">
								<?php
								if(!in_array($rows[$i]['item_id'],$_SESSION['liked_items'])) {
								?> 
								<a href="profile.php?like=1&item_id=<?php echo $rows[$i]['item_id']?>" ><i class='fa fa-heart fa-lg' style='color: black'></i></a>
								<?php 
								}elseif(in_array($rows[$i]['item_id'],$_SESSION['liked_items'])) {
								?>
								<a href="profile.php?unlike=1&item_id=<?php echo $rows[$i]['item_id']?>" ><i class='fa fa-heart fa-lg' style='color: #DC143C'></i></a>
								<?php
								}
								?><p class="amountLikes"><?php echo $rows[$i]['likes']; ?></p>
								</td>		
								
								<td class="icon4">
									<form class="updateForm" action="profile.php?update=success&itemId=<?php echo $rows[$i]['item_id']; ?>"method ="POST">
										<label class="quantity">QTY</label> 
										<input type="number"  placeholder= "<?php echo $rows[$i]['quantity']; ?>" name="newQuan" min="1" max="100" size ="2">
										<button type ="submit" name ="update"> update </button>
									</form>
								</td>

								<td class="icon5">
									<p class="price">$<?php echo $rows[$i]['quantity']*$rows[$i]['price']; ?> </p>
								</td>

							</tr>
						</table>
					</td>
				</tr>

				<?php
				   $total +=$rows[$i]['quantity']*$rows[$i]['price'];}
				   echo "<h1 class='total'>Total: $". $total."</h1>"; 
				   $_SESSION['cart_id']= array_column($rows,'item_id');
				
				   }else{ $_SESSION['cart_id']= array();
				?>

				</table>
				<img class="emptyCart" src="/project/images/emptyCart.svg">
				<p class="emptyTitle">Wishlist is empty</p>

				<?php
				   }
				?>
		</div>	
    </div>

</body>
</html>