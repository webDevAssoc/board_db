<? 
	// 로그인 상태 확인
	session_save_path("./session");
	session_start();
	if (!$_SESSION['is_login']) {
		header("Location: /phplec/board_db/loginform.php");
		exit;
	} 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
</head>
<body>
<?	
	// DB 접속
	mysql_connect('localhost', 'phpadmin', 'phpadmin');
	mysql_select_db('phplec_board');

	// 데이터 삽입하기
	$sql = 
	"INSERT INTO board_table (password, title, context, auther, created) 
	VALUES (	'".$_POST['pw']."',
			'".mysql_real_escape_string($_POST['title'])."', 
			'".mysql_real_escape_string($_POST['context'])."',
			'".$_SESSION['nickname']."',
			now() )"; 
	$result = mysql_query($sql);

	// 삽입 결과
	if ($result) {
		echo "게시글 저장 완료";
	} else {
		echo "에러발생";
	}
	/*
	// 파일 저장 위치 지정
	$file_name = "board/".$_POST['title']."_by_".$_SESSION['nickname'].".txt";
	
	// 파일 write 모드로 열기
	$file = fopen($file_name, "w");
	if (!fwrite($file, $_POST['context'])) { // 파일 작성 (성공시 true, 실패시 false)
		unlink($file_name);	// 실패시 생성한 파일 삭제
		echo "에러발생";
	} else { 
		echo "게시글 저장 완료.";
	}
	// 파일 포인터 닫음
	fclose($file);
	*/
?>
	<hr>
	<a type="button" href="board.php">게시판 가기</a>
</body>
</html>