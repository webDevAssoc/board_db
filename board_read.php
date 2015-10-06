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
	<!-- 로그아웃 버튼 -->
	<a type="button" href="logout.php">로그아웃</a>
	<hr>
	
<?
	// DB 접속
	mysql_connect('localhost', 'phpadmin', 'phpadmin');
	mysql_select_db('phplec_board');

	// 데이터 가져오기
	$sql = 'SELECT id, password, title, context, auther, created 
		FROM board_table 
		WHERE id='.$_GET['file'];
	$list_result = mysql_query($sql);

	// 쿼리 실행 결과를 가져옴
	$board = mysql_fetch_assoc($list_result);

	if ($board != null) {
		$list = "<h3>".$board['title']."</h3>";
		$list .= "<b>글번호</b> : ".$board['id']."<br>";
		$list .= "<b>글쓴이</b> : ".$board['auther']."<br>";
		$list .= "<b>본문</b><br><p>".$board['context']."</p>";
	}
	echo $list;

	/*
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
	*/
?>
	<br><br>
	<a type="button" href="board_pw.php?file=<?=$_GET['file']?>">삭제하기</a>
	<hr>
	<a type="button" href="board.php">게시판 가기</a>
</body>
</html>