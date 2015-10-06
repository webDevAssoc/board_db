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
	$dir = "./board/"; // 파일 위치 지정
	$files = scandir($dir); // 해당 위치 파일 스캔
	
	echo "파일 목록<br>";
	// 파일 목록 리스트로 출력
	for($i=2; $i<count($files); $i++) {
		echo "<a type='button' href='board_read.php?file=".$files[$i]."'>".$files[$i]."</a><br> ";
		// GET 방식으로 [board_read.php]에 가져올 파일명 전달
	}
	
	// 파일 작성 폼으로 연결
	echo "<hr><a type='button' href='board_form.php'>게시글 작성</a>";
?>