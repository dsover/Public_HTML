<?php error_reporting (E_ALL ^ E_NOTICE);

function userIsLoggedIn(){

	if (isset($_POST['action']) and $_POST['action'] == 'login'){


		if (!isset($_POST['userName']) or $_POST['userName'] == '' or
			!isset($_POST['password']) or $_POST['password'] == ''){
			$GLOBALS['loginError'] = 'Please fill in both fields';
			return FALSE;
		}
		$password = md5($_POST['password'] . '!trueSeed');
		if (databaseContainsAuthor($_POST['userName'], $password)){
		session_start();
			$_SESSION['loggedIn'] = TRUE;
			$_SESSION['userName'] = $_POST['userName'];
			$_SESSION['password'] = $password ;
			unset($_SESSION['failedLogins']);
			return TRUE;
		}else{
			session_start();
			$_SESSION['lock'] = FALSE;
			$_SESSION['failedLogins'] = 1 +$_SESSION['failedLogins'] ;
			unset($_SESSION['loggedIn']);
			unset($_SESSION['userName']);
			unset($_SESSION['password']);
			unset($_SESSION['passAge']);
			unset($_SESSION['userId']);
		$GLOBALS['loginError'] = 'The specified User Name  or password was incorrect.';
			If($_SESSION['failedLogins'] > 3){
				$_SESSION['lock'] = TRUE;
			}
			return FALSE;
		}
	}
	if (isset($_POST['action']) and $_POST['action'] == 'changePassword'){
		if (!isset($_POST['newpassword']) or $_POST['newpassword'] == ''){
				$GLOBALS['passChangeError'] = 'Please fill in the password field';
		}else{
			try{
				session_start();
				include 'db.inc.php';
				$sql = "UPDATE User SET 
						Password = md5(:newpassword),
						PasswordDate = NOW(),
						ResetNextLogin = FALSE
						WHERE Id = :userId";
				$s = $pdo->prepare($sql);
				$pass = $_POST['newpassword'].'!trueSeed';
				$s->bindValue(':newpassword',$pass);
				$s->bindValue(':userId',$_SESSION['userId']);
				$s->execute();
			} catch (PDOException $e){
				$error = $e;// 'Error searching for author roles.';
				include 'error.html.php';
				exit();
			}
		}
}

	if (isset($_POST['action']) and $_POST['action'] == 'logout'){
		session_start();
		unset($_SESSION['loggedIn']);
		unset($_SESSION['userName']);
		unset($_SESSION['password']);
		unset($_SESSION['passAge']);
		unset($_SESSION['userId']);
		header('Location: ' . $_POST['goto']);
		exit();
	}

	session_start();
	if (isset($_SESSION['loggedIn'])){
		return databaseContainsAuthor($_SESSION['userName'],$_SESSION['password']);
	}
}

function databaseContainsAuthor($userName, $password){
	include 'db.inc.php';
	try{
		$sql = 'SELECT 
				TO_Days(PasswordDate)
				,TO_Days(NOW())
				,ResetNextLogin
				,User.Id,COUNT(*) from User 
				WHERE UserName = :userName AND Password = :password AND Deleted = FALSE';
		$s = $pdo->prepare($sql);
		$s->bindValue(':userName', $userName);
		$s->bindValue(':password', $password);
		$s->execute();
	}
	catch (PDOException $e){
		$error = $sql;//'Error searching for author.';
		include 'error.html.php';
		exit();
	}
	$row = $s->fetch();
	if ($row[0] > 0){ 
		session_start();
		$diff = $row[1] - $row[0];
		
		$_SESSION['userId'] = $row['Id'];
		$_SESSION['passAge'] = $diff;
		$_SESSION['changePass'] = $row['2'];
		return TRUE;
	}
	else{
		return FALSE;
	}
}

function userHasRole($userTypeId){
	include 'db.inc.php';
	try{
		$sql = "SELECT COUNT(*) FROM User 
					JOIN UserType on User.UserTypeId = UserType.Id
				WHERE User.UserName =:userName AND UserType.Id= :userTypeId";
		$s = $pdo->prepare($sql);
		$s->bindValue(':userName',$_SESSION['userName']);
		$s->bindValue(':userTypeId',$userTypeId);
		$s->execute();
	} catch (PDOException $e){
		$error = 'Error searching for author roles.';
		include 'error.html.php';
		exit();
	}
		$row = $s->fetch();
	if ($row[0] > 0){
		return TRUE;
	}
	else{
		return FALSE;
	}
}
