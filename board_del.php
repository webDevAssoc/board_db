<? 
	// 로그인 상태 확인
	session_save_path("./session");
	session_start();
	if (!$_SESSION['is_login']) {
		header("Location: /phplec/board_db/loginform.php");
		exit;
	} 
?>

<?
	// DB 접속
	mysql_connect('localhost', 'phpadmin', 'phpadmin');
	mysql_select_db('phplec_board');

	// 비밀번호 가져오기
	$sql = "SELECT password FROM board_table WHERE id=".$_GET['file'];
	$result = mysql_query($sql);
	$password = mysql_fetch_row($result);

	// 비밀번호 비교
	if ($_POST['pw'] === $password[0]) {
		// 데이터 제거하기
		$sql = "DELETE FROM board_table 
			   WHERE id=".$_GET['file'];

		$result = mysql_query($sql);

		// 제거 결과
		if ($result) {
			echo "게시글 삭제 완료";
		} else {
			echo "에러발생";
		}
	} else {
		echo "비밀번호가 틀렸습니다.";
	}

	/*
	// GET으로 넘어온 파일명 지정
	$file_name = "board/".$_GET['file'];
	
	if (!unlink($file_name)) { // 파일 삭제 (성공시 true, 실패시 false)
		echo "에러발생";
	} else {
		echo "게시글 삭제 완료.";
	}
	*/
?>
<hr>
<a type="button" href="board.php">게시판 가기</a>