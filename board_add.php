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
?>
<hr>
<a type="button" href="board.php">게시판 가기</a>