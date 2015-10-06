<? 
	// 로그인 상태 확인
	session_save_path("./session");
	session_start();
	if (!$_SESSION['is_login']) {
		header("Location: /phplec/loginform.php");
		exit;
	} 
?>

<?
	// GET으로 넘어온 파일명 지정
	$file_name = "board/".$_GET['file'];
	
	if (!unlink($file_name)) { // 파일 삭제 (성공시 true, 실패시 false)
		echo "에러발생";
	} else {
		echo "게시글 삭제 완료.";
	}
?>
<hr>
<a type="button" href="board.php">게시판 가기</a>