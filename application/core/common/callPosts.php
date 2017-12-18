<?php
/*
	FOR `posts` TABLE SQL MANAGMENT 
*/
class	CallPosts
{
	// default SELECT sql request for posts table:
	$select	=	'SELECT `id`, `user_id`, `date`, `image`, `likes`, `tags`, `legend` ';
	// default LIMIT sql request for posts table:
	$limit	=	' LIMIT 0, ' . POSTS_ON_PAGE;

	/* 1. PREPARE POSTS BY POST ID */
	// returns array of post data asked by posts id's
	public static function	byId($dbh, $postId[]) {
		
		$searchList	=	implode(', ', (array)$postId);
				
		$query	=	$this->select . 'WHERE `id` = ?' . $this->limit;
		$stmt	=	$dbh->prepare($query);
		$stmt->execute([$searchList]);
		$askedPosts	=	$stmt->fetchAll(PDO::FETCH_ASSOC);

		if (is_null($askedPosts)) {
			$askedPosts	=	false;
		}

		return	$askedPosts;
	}


	/* 2. PREPARE POSTS BY USER ID */
	// returns array of post data asked by users id's
	public static function	byUser($dbh, $userId[]) {
		
		$searchList	=	implode(', ', (array)$userId);

		$query	=	$this->select . 'WHERE `user_id` = ?' . $this->limit;
		$stmt	=	$dbh->prepare($query);
		$stmt->execute([$searchList]);
		$askedPosts	=	$stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if (is_null($askedPosts)) {
			$askedPosts	=	false;
		}
		
		return	$askedPosts;
	}


	/* 3. PREPARE POSTS BY DATE */
	// returns array of post data sorted by timestamp
	public static function	sortDate($dbh, $oldest) {
		
		// order:
		$type	=	(bool)$oldest	==	true ? 'DESK' : 'ASC';
		
		$query	=	$this->select . 'ORDER BY `date` ' . $type . $this->limit;
		$stmt	=	$dbh->prepare($query);
		$stmt->execute([]);
		$askedPosts	=	$stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if (is_null($askedPosts)) {
			$askedPosts	=	false;
		}
		
		return	$askedPosts;
	}


	/* 4. PREPARE POSTS BY RATE */
	// returns array of post data asked by rating(likes)
	public static function	sortRate($dbh, $lowest) {

		// order:
		$type	=	(bool)$lowest	==	true ? 'ASC' : 'DESC';
		
		$query	=	$this->select . 'ORDER BY `likes` ' . $type . $this->limit;
		$stmt	=	$dbh->prepare($query);
		$stmt->execute([]);
		$askedPosts	=	$stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if (is_null($askedPosts)) {
			$askedPosts	=	false;
		}
		
		return	$askedPost;
	}

}