<?php
	namespace MS;
	use MS\MSDb;
	class MSMessage extends MSDb{
		/*
			CLKMessage maked by Mustafa Çolakoğlu.
			Contact
				mailto://mustafacolakoglu94@gmail.com
				http://facebook.com/220mustafa
				http://mcolak.net
			This library is using MYSQL.
			If you want to use this library, you must load your DATABASE CLKMessage.sql
			Starting.
				Run:
				$CLKMessage=new CLKMessage();
				1-)Connecting Database
					For Example:
						$CLKMessage->connectDb("localhost","root","root123","messages");
				2-)Adding User
					For Exampe:
						$CLKMessage->addUser("user1","user123user","mySecretAnswer");
				3-)Logining User
					For Example:
						$login=$CLKMessage->userLogin("user1","user123user");
						if($login){
							//Successfully login.
						}
						else{
							if($CLKMessage->data["userLoginFail"]==2){
								//There isn't no user.
							}
							else{
								//Username or password wrong
							}
						}
				3-)Logout User
					For Example:
						$CLKMessage->userLogout();
				4-)Checking User:
					$CLKMessage->checkUser("username");
					if($CLKMessage){
						//User exist
					}
					else{
						//User doesn't exist
					}
				5-)Message Box
					Use Type 1:
						$messages=$CLKMessage->userMessages();
						//returns all messages
					Use Type 2:
						$messages=$CLKMessage->userMessages(1,10);
						// returns 1 and 10 subjects
					Use Type 3:
						$messages=$CLKMessage->userMessages(false,10);
						// returns last 10 messages
					Use Type 4:
						$messages=$CLKMessage->userMessages(5,false);
						//returns after 5 subjects
					Use Type 5:
						$messages=$CLKMessage->userMessages(false,false,1);
						//returns 1 id's users subjects
					
					After you can use this code
						$messages=$CLKMessage->data["userMessages"];
					
					Return array:
						$messages=array(
							"userId"=>$userId,
							"userName"=>$_SESSION["CLKUserName"],
							"otherUserId"=>$otherUserId,
							"otherUserName"=>$otherUserInfo["kullaniciAdi"],
							"subject"=>$new["konu"],
							"lastMessage"=>$lastMessage["mesaj"],
							"messageId"=>$new["id"],
							"messageType"=>"new",
							"date"=>$new["date"],
							"time"=>$new["time"]
						);
				6-)New Messages
					Use Type 1:
						$messages=$CLKMessage->userNewMessages();
						//returns all messages
					Use Type 2:
						$messages=$CLKMessage->userNewMessages(1,10);
						// returns 1 and 10 subjects
					Use Type 3:
						$messages=$CLKMessage->userNewMessages(false,10);
						// returns last 10 messages
					Use Type 4:
						$messages=$CLKMessage->userNewMessages(5,false);
						//returns after 5 subjects
					Use Type 5:
						$messages=$CLKMessage->userNewMessages(false,false,1);
						//returns 1 id's users subjects
					
					After you can use this code
						$messages=$CLKMessage->data["userNewMessages"];
					
					Return array:
						$messages=array(
							"userId"=>$userId,
							"userName"=>$_SESSION["CLKUserName"],
							"otherUserId"=>$otherUserId,
							"otherUserName"=>$otherUserInfo["kullaniciAdi"],
							"subject"=>$new["konu"],
							"lastMessage"=>$lastMessage["mesaj"],
							"messageId"=>$new["id"],
							"messageType"=>"new",
							"date"=>$new["date"],
							"time"=>$new["time"]
						);
				8-)Last Messages
					Use Type 1:
						$messages=$CLKMessage->userLastMessages();
						//returns all messages
					Use Type 2:
						$messages=$CLKMessage->userLastMessages(1,10);
						// returns 1 and 10 subjects
					Use Type 3:
						$messages=$CLKMessage->userLastMessages(false,10);
						// returns last 10 messages
					Use Type 4:
						$messages=$CLKMessage->userLastMessages(5,false);
						//returns after 5 subjects
					Use Type 5:
						$messages=$CLKMessage->userLastMessages(false,false,1);
						//returns 1 id's users subjects
					
					After you can use this code
						$messages=$CLKMessage->data["userLastMessages"];
					
					Return array:
						$messages=array(
							"userId"=>$userId,
							"userName"=>$_SESSION["CLKUserName"],
							"otherUserId"=>$otherUserId,
							"otherUserName"=>$otherUserInfo["kullaniciAdi"],
							"subject"=>$new["konu"],
							"lastMessage"=>$lastMessage["mesaj"],
							"messageId"=>$new["id"],
							"messageType"=>"new",
							"date"=>$new["date"],
							"time"=>$new["time"]
						);
				9-)Message Details
					$CLKMessage->messageDetails(Subject Id,start,finish);
					Return array:
						$messages=array(
							"id"=>$all["id"],
							"subject"=>$subjectInfo["konu"],
							"user1Id"=>$user1Info["id"],
							"user2Id"=>$user2Info["id"],
							"user1UserName"=>$user1Info["kullaniciAdi"],
							"user2UserName"=>$user2Info["kullaniciAdi"],
							"message"=>$all["mesaj"],
							"date"=>$all["date"],
							"time"=>$all["time"]
						);
						
						After you can use this code
						$messages=$CLKMessage->data["messageDetails"];
						
				10-)Change Password
					$CLKMessage->changePassword(1,"newPassword");
				11-)Change Secret Answer
					$CLKMessage->changeSecretAnswer(1,"newAnswer");
				12-)New Message
					$fromId=@$_SESSION["CLKId"];
					$toId=5;
					$subject="test";
					$message="test message";
					$CLKMessage->newMessage($fromId,$toId,$subject,$message);
				13-)Answer Message
					$subjectId=5;
					$message="my answer";
					$CLKMessage->answerMessage($subjectId,$message);
		*/
		public function __construct(MSDb $Db){
			$this->Db = $Db;
		}
		public function userMessages($start=false,$finish=false,$userId=false){
			$this->data["userMessages"]=array();
			$meter=0;
			if(!$userId and $this->isLogin()){
				$userId=@$_SESSION["CLKId"];
			}
			$subjects=mysql_query("SELECT * FROM konular WHERE gelenId='$userId' or gonderenId='$userId'");
			$newMessages=mysql_query("SELECT * FROM konular WHERE
				(gelenId='$userId' and (enSonGonderenId!='$userId' and gelenOkuma='0'))
				or
				(gonderenId='$userId' and (enSonGonderenId!='$userId' and gonderenOkuma='0'))
				ORDER BY id DESC");
			$eklenmeyecekler=array();
			while($new=mysql_fetch_array($newMessages)){
				array_push($eklenmeyecekler,$new["id"]);
				if($new["gelenId"]==$userId){
					$otherUserId=$new["gonderenId"];
				}
				else{
					$otherUserId=$new["gelenId"];
				}
				$otherUserInfo=mysql_fetch_array(mysql_query("SELECT * FROM kullanicilar WHERE id='$otherUserId' LIMIT 1"));
				$subjectId=$new["id"];
				$lastMessage=mysql_fetch_array(mysql_query("SELECT * FROM mesajlar WHERE konuid='$subjectId' ORDER BY id DESC LIMIT 1"));
				$message=array(
					"userId"=>$userId,
					"userName"=>$_SESSION["CLKUserName"],
					"otherUserId"=>$otherUserId,
					"otherUserName"=>$otherUserInfo["kullaniciAdi"],
					"subject"=>$new["konu"],
					"lastMessage"=>$lastMessage["mesaj"],
					"messageId"=>$new["id"],
					"messageType"=>"new",
					"date"=>$new["date"],
					"time"=>$new["time"]
				);
				if(!$start and !$finish){
					array_push($this->data["userMessages"],$message);
					if($start===0 and $finish===0){
						return $this->data["userMessages"];
					}
				}
				else if($start and $finish){
					if($meter>=$start and $meter<=$finish){
						array_push($this->data["userMessages"],$message);
					}
				}
				else if($start and !$finish){
					if($meter>=$start){
						array_push($this->data["userMessages"],$message);
					}
				}
				else if(!$start and $finish){
					if($meter<=$finish){
						array_push($this->data["userMessages"],$message);
					}
				}
				$meter++;
			}
			$otherMessages=mysql_query("SELECT * FROM konular WHERE gelenId='$userId' or gonderenId='$userId' ORDER BY id DESC");
			while($other=mysql_fetch_array($otherMessages)){
				$kontrol=0;
				for($i=0;$i<count($eklenmeyecekler);$i++){
					if($other["id"]==$eklenmeyecekler[$i]){
						$kontrol=1;
						break;
					}
				}
				if($kontrol==1){
					continue;
				}
				if($other["gelenId"]==$userId){
					$otherUserId=$other["gonderenId"];
				}
				else{
					$otherUserId=$other["gelenId"];
				}
				$otherUserInfo=mysql_fetch_array(mysql_query("SELECT * FROM kullanicilar WHERE id='$otherUserId' LIMIT 1"));
				$subjectId=$other["id"];
				$lastMessage=mysql_fetch_array(mysql_query("SELECT * FROM mesajlar WHERE konuid='$subjectId' ORDER BY id DESC LIMIT 1"));
				$message=array(
					"userId"=>$userId,
					"userName"=>$_SESSION["CLKUserName"],
					"otherUserId"=>$otherUserId,
					"otherUserName"=>$otherUserInfo["kullaniciAdi"],
					"subject"=>$other["konu"],
					"lastMessage"=>$lastMessage["mesaj"],
					"messageId"=>$other["id"],
					"messageType"=>"last",
					"date"=>$other["date"],
					"time"=>$other["time"]
				);
				if(!$start and !$finish){
					array_push($this->data["userMessages"],$message);
					if($start===0 and $finish===0){
						return $this->data["userMessages"];
					}
				}
				else if($start and $finish){
					if($meter>=$start and $meter<=$finish){
						array_push($this->data["userMessages"],$message);
					}
				}
				else if($start and !$finish){
					if($meter>=$start){
						array_push($this->data["userMessages"],$message);
					}
				}
				else if(!$start and $finish){
					if($meter<=$finish){
						array_push($this->data["userMessages"],$message);
					}
				}
				$meter++;
			}
			return $this->data["userMessages"];
		}
		public function userNewMessages($start=false,$finish=false,$userId=false){
			$this->data["userNewMessages"]=array();
			$meter=0;
			if(!$userId and $this->isLogin()){
				$userId=@$_SESSION["CLKId"];
			}
			$subjects=mysql_query("SELECT * FROM konular WHERE gelenId='$userId' or gonderenId='$userId'");
			$newMessages=mysql_query("SELECT * FROM konular WHERE
				(gelenId='$userId' and (enSonGonderenId!='$userId' and gelenOkuma='0'))
				or
				(gonderenId='$userId' and (enSonGonderenId!='$userId' and gonderenOkuma='0'))
				ORDER BY id DESC");
			$eklenmeyecekler=array();
			while($new=mysql_fetch_array($newMessages)){
				array_push($eklenmeyecekler,$new["id"]);
				if($new["gelenId"]==$userId){
					$otherUserId=$new["gonderenId"];
				}
				else{
					$otherUserId=$new["gelenId"];
				}
				$otherUserInfo=mysql_fetch_array(mysql_query("SELECT * FROM kullanicilar WHERE id='$otherUserId' LIMIT 1"));
				$subjectId=$new["id"];
				$lastMessage=mysql_fetch_array(mysql_query("SELECT * FROM mesajlar WHERE konuid='$subjectId' ORDER BY id DESC LIMIT 1"));
				$message=array(
					"userId"=>$userId,
					"userName"=>$_SESSION["CLKUserName"],
					"otherUserId"=>$otherUserId,
					"otherUserName"=>$otherUserInfo["kullaniciAdi"],
					"subject"=>$new["konu"],
					"lastMessage"=>$lastMessage["mesaj"],
					"messageId"=>$new["id"],
					"messageType"=>"new",
					"date"=>$new["date"],
					"time"=>$new["time"]
				);
				if(!$start and !$finish){
					array_push($this->data["userNewMessages"],$message);
					if($start===0 and $finish===0){
						return $this->data["userNewMessages"];
					}
				}
				else if($start and $finish){
					if($meter>=$start and $meter<=$finish){
						array_push($this->data["userNewMessages"],$message);
					}
				}
				else if($start and !$finish){
					if($meter>=$start){
						array_push($this->data["userNewMessages"],$message);
					}
				}
				else if(!$start and $finish){
					if($meter<=$finish){
						array_push($this->data["userNewMessages"],$message);
					}
				}
				$meter++;
			}
			return $this->data["userNewMessages"];
		}
		public function userLastMessages($start=false,$finish=false,$userId=false){
			$this->data["userLastMessages"]=array();
			$meter=0;
			$otherMessages=mysql_query("SELECT * FROM konular WHERE gelenId='$userId' or gonderenId='$userId' ORDER BY id DESC");
			while($other=mysql_fetch_array($otherMessages)){
				$kontrol=0;
				for($i=0;$i<count($eklenmeyecekler);$i++){
					if($other["id"]==$eklenmeyecekler[$i]){
						$kontrol=1;
						break;
					}
				}
				if($kontrol==1){
					continue;
				}
				if($other["gelenId"]==$userId){
					$otherUserId=$other["gonderenId"];
				}
				else{
					$otherUserId=$other["gelenId"];
				}
				$otherUserInfo=mysql_fetch_array(mysql_query("SELECT * FROM kullanicilar WHERE id='$otherUserId' LIMIT 1"));
				$subjectId=$other["id"];
				$lastMessage=mysql_fetch_array(mysql_query("SELECT * FROM mesajlar WHERE konuid='$subjectId' ORDER BY id DESC LIMIT 1"));
				$message=array(
					"userId"=>$userId,
					"userName"=>$_SESSION["CLKUserName"],
					"otherUserId"=>$otherUserId,
					"otherUserName"=>$otherUserInfo["kullaniciAdi"],
					"subject"=>$other["konu"],
					"lastMessage"=>$lastMessage["mesaj"],
					"messageId"=>$other["id"],
					"messageType"=>"last",
					"date"=>$other["date"],
					"time"=>$other["time"]
				);
				if(!$start and !$finish){
					array_push($this->data["userLastMessages"],$message);
					if($start===0 and $finish===0){
						return $this->data["userLastMessages"];
					}
				}
				else if($start and $finish){
					if($meter>=$start and $meter<=$finish){
						array_push($this->data["userLastMessages"],$message);
					}
				}
				else if($start and !$finish){
					if($meter>=$start){
						array_push($this->data["userLastMessages"],$message);
					}
				}
				else if(!$start and $finish){
					if($meter<=$finish){
						array_push($this->data["userLastMessages"],$message);
					}
				}
				$meter++;
			}
		}
		public function messageDetails($subjectId,$start=false,$finish=false){
			$this->data["messageDetails"]=array();
			$meter=0;
			$subjectInfo=mysql_query("SELECT * FROM konular WHERE id='$subjectId' LIMIT 1");
			if(mysql_num_rows($subjectInfo)<1){
				return false;
			}
			$subjectInfo=mysql_fetch_array($subjectInfo);
			$allMessages=mysql_query("SELECT * FROM mesajlar WHERE konuId='$subjectId' ORDER BY id DESC");
			while($all=mysql_fetch_array($allMessages)){
				$user1Id=$all["gelenId"];
				$user2Id=$all["gonderenId"];
				$user1Info=mysql_fetch_array(mysql_query("SELECT * FROM kullanicilar WHERE id='$user1Id' LIMIT 1"));
				$user2Info=mysql_fetch_array(mysql_query("SELECT * FROM kullanicilar WHERE id='$user2Id' LIMIT 1"));
				$message=array(
					"id"=>$all["id"],
					"subject"=>$subjectInfo["konu"],
					"user1Id"=>$user1Info["id"],
					"user2Id"=>$user2Info["id"],
					"user1UserName"=>$user1Info["kullaniciAdi"],
					"user2UserName"=>$user2Info["kullaniciAdi"],
					"message"=>$all["mesaj"],
					"date"=>$all["date"],
					"time"=>$all["time"]
				);
				if(!$start and !$finish){
					array_push($this->data["messageDetails"],$message);
					if($start===0 and $finish===0){
						return $this->data["messageDetails"];
					}
				}
				else if($start and !$finish){
					if($meter>=$start){
						array_push($this->data["messageDetails"],$message);
					}
				}
				else if(!$start and $finish){
					if($meter<=$finish){
						array_push($this->data["messageDetails"],$message);
					}
				}
				else if($start and $finish){
					if($meter>=$start and $meter<=$finish){
						array_push($this->data["messageDetails"],$message);
					}
				}
				$meter++;
			}
			return $this->data["messageDetails"];
		}
		public function newMessage($from,$to,$subject,$message){
			if($from and $to and $subject and $message){
				$date=date("d:m:Y");
				$when=date("H.i.s");
				$time=time();
				$send=mysql_query("INSERT INTO konular VALUES('','$subject','$from','$to','1','0','$from','$date','$time')");
				$subjectId=mysql_insert_id();
				if($send){
					mysql_query("INSERT INTO mesajlar VALUES('','$subjectId','$message','$from','$to','$date','$when','$time')");
				}
				return $subjectId;
			}
			else{
				return false;
			}
		}
		public function answerMessage($subjectId,$message){
			$subjectInfo=mysql_query("SELECT * FROM konular WHERE id='$subjectId'");
			if(mysql_num_rows($subjectInfo)<1){
				return false;
			}
			else{
				$subjectInfo=mysql_fetch_array($subjectInfo);
				if($subjectInfo["gonderenId"]==@$_SESSION["CLKId"]){
					$user1Id=@$_SESSION["CLKId"];
					$user2Id=$subjectInfo["gelenId"];
				}
				else{
					$user1Id=$subjectInfo["gelenId"];
					$user2Id=$subjectInfo["gonderenId"];
				}
				$subjectId=$subjectInfo["id"];
				$date=date("d:m:Y");
				$when=date("H.i.s");
				$time=time();
				mysql_query("INSERT INTO mesajlar VALUES('','$subjectId','$message','$user1Id','$user2Id','$date','$when','$time')");
			}
		}
		public function error($code){
			if($code==1){
			?>
			<table style="width:400px;height:auto;border:0;background:#ccc;">
				<tr style="width:400px;background:#c33;font:20px Arial;"><td><b>Connect Error</b></td></tr>
				<tr>
					<td>
						<p>
							Mysql Connect Error!
							<?php echo "<b>'".$this->data["mysql"][0]."'</b> or <b>'".$this->data["mysql"][1]."'</b> or <b>'".$this->data["mysql"][2]."'</b>"; ?> wrong.
						</p>
					</td>
				</tr>
			</table>
			<?php
			}
			else if($code==2){
			?>
			<table style="width:400px;height:auto;border:0;background:#ccc;">
				<tr style="width:400px;background:#c33;font:20px Arial;">
					<td>
						<b>DB Error</b>
					</td>
				</tr>
				<tr>
					<td>
						<p>
							Mysql didn't connect this database : <b>'<?php echo $this->data["mysql"][3]; ?>'</b>
						</p>
					</td>
				</tr>
			</table>
			<?php
			}
		}
	}
?>