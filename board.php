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
	$sql = 'SELECT id, title, auther, created FROM board_table';
	$list_result = mysql_query($sql);

	// 쿼리 실행 결과를 배열 형태로 담음
	$boards = array ();  
	while ( $row = mysql_fetch_assoc($list_result)) {  
		$board = array (  
			"id" => (int) $row ['id'] ,
			"title" => $row ['title'],
			"auther" => $row ['auther'],
			"created" => $row ['created']
		);
		// 결과 배열로 푸쉬
		array_push($boards, $board);  
	}
?>
	<!-- BEGIN 게시판 리스트 -->
	<table border="1" style="width:100%">
		<!-- 테이블 제목 -->
		<tr>
			<th>번호</th>
			<th>제목</th>
			<th>작성자</th>
			<th>생성일</th>
		</tr>

		<!-- 테이블 리스트 -->
<?
		$list=null;
		if ($boards == null) { // 데이터가 없을시
			$list .= "<tr><td colspan='4' style='text-align:center'>결과가 없습니다</td></tr>";
		} else {	// 데이터가 있을시
			foreach($boards as $board) {
				$list .= "<tr>";
				$list .= "<td>".$board['id']."</td>";
				// 게시글로 가기위해 링크
				$list .= "<td><a type='button' href='board_read.php?file="
					.$board['id']."'>".$board['title']."</a></td>";
				$list .= "<td>".$board['auther']."</td>";
				$list .= "<td>".$board['created']."</td>";
				$list .= "</tr>";
			}
		}
		echo $list;
?>
	</table>
	<!-- END 게시판 리스트 -->

<?
	/*
	$dir = "./board/"; // 파일 위치 지정
	$files = scandir($dir); // 해당 위치 파일 스캔
	
	echo "파일 목록<br>";
	// 파일 목록 리스트로 출력
	for($i=2; $i<count($files); $i++) {
		echo "<a type='button' href='board_read.php?file=".$files[$i]."'>".$files[$i]."</a><br> ";
		// GET 방식으로 [board_read.php]에 가져올 파일명 전달
	}
	*/
	
	// 파일 작성 폼으로 연결
	echo "<hr><a type='button' href='board_form.php'>게시글 작성</a>";
?>
</body>
</html>