<?php

class CServices {

    private $sMethod;
    private $iLimit;
    private $sOrder;
    private $other_message;

    // constructor
    public function CServices() {
        $this->sMethod = 'html';
        $this->iLimit = 5;
        $this->other_message = "";
        $this->sOrder = 'last';
    }

    // set method
    public function setMethod($s) {
        $this->sMethod = $s;  
    }

    // set limit
    public function setLimit($i) {
        $this->iLimit = ($i > 0 && $i < 10) ? $i : $this->iLimit;
    }

    // set order
    public function setOrder($s) {
        $this->sOrder = $s;  
    }

    public function insert_comment($value)
	{
		//$code =0;
		extract($value);
		$query = "INSERT INTO post (userID, topic, thread,comment)
		VALUES('$userID','$topic','$thread','$comment')";
		
		$result = $GLOBALS['MySQL']->addComment($query);

		if($result == TRUE){
			extract($value);
			$userID_query="SELECT `username`,`email` FROM `users` WHERE id= '$userID' ";
			$result2 = $GLOBALS['MySQL']->getRow($userID_query);
			if ($result2 != null){
				$code=1;
			}else{
				$code = 0;}
			return json_encode(array("code"=>$code, "response"=>$result2));

			}
		else{
			$code = 0;
			return json_encode(array("code"=>$code, "response"=>$result));
		}

		

		
	}
	
	public function login($data)
	{
		extract($data);
		$query  ="SELECT * FROM users WHERE email = '$email' AND  password = '$password' ";
		
		$result = $GLOBALS['MySQL']->getRow($query);
		
		if ($result != null)
		{
			$code = 1;
		}
		else
			$code = 0;
		
		return json_encode(array("code"=>$code, "response"=>$result));
		
	}

	public function signUp($value)
	{
		//$code =0;
		extract($value);
		$query = "INSERT INTO users (username, email, password)VALUES('$username','$email','$password')";
		$result = $GLOBALS['MySQL']->addUser($query);

		// $new_query ="SELECT * FROM `user` WHERE username = '$username'AND email  = '$email'";
		// $new_result = $GLOBALS['MySQL']->getRow($new_query);

		if($result == TRUE){
			$code = 1;
		}else{
			$code = 0;
		}

		return json_encode(array("code"=>$code, "response"=>$result));
		// return json_encode(array("code"=>$value);
	}

	public function getComment($value){
		extract($value);
		// $query2 = "SELECT * FROM post ORDER BY ID DESC";
		// $q ="SELECT * FROM post INNER JOIN users ON(post.userID=users.id) ORDER BY post.ID DESC";
		$q = "SELECT * FROM post  INNER JOIN users ON(post.userID=users.id) WHERE topic= '$theNewsId'  ORDER BY post.ID DESC";

			$result2 = $GLOBALS['MySQL']->getAll($q);
			if ($result2 != null) {
				$code = 1;
			}else{
				$code = 0;
			}
			return json_encode(array("code"=>$code, "response"=>$result2));
	}


	
}
?>