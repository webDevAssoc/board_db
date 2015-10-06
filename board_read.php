<? 
	// 로그인 상태 확인
	session_save_path("./session");
	session_start();
	if (!$_SESSION['is_login']) {
		header("Location: /phplec/loginform.php");
		exit;
	} 
?>
<!-- 로그아웃 버튼 -->
<a type="button" href="logout.php">로그아웃</a>
<hr>
	
<?
	// GET으로 넘어온 파일명 지정
	$file_name = "board/".$_GET['file'];
	
	if (file_exists(file_name)) { // 파일이 존재하는지 확인
		echo "에러발생";
	} else {
		$file = fopen($file_name, "r"); // 있다면 파일을 read 모드로 열기
	
		$context = fread($file, filesize($file_name)); // 파일 크기만큼 파일읽기
		echo $context;
		
		fclose($file);
	}
?>
<br><br>
<a type="button" href="board_del.php?file=<?=$_GET['file']?>">삭제하기</a>
<hr>
<a type="button" href="board.php">게시판 가기</a>