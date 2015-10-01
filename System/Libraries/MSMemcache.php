<?php	
	namespace MS;
	use MS\CacheAdapter;
	use Memcache;
	use get;
	class MSMemcache extends CacheAdapter{
		public $settings;
		function __construct($settings = false){
			if(isset($settings) and is_array($settings)){
				$this->settings = $settings;
				$this->connect($settings["host"],$settings["port"]);
			}
			else{
				$settings = get::Config("Cache","Memcache");
				$this->connect($settings["host"],$settings["port"]);
			}
		}
		function connect($host=false,$port=false){
			$this->Memcache = new Memcache;
			if($host and $port){
				$this->connect = $this->Memcache->connect($host,$port);
				if(!$this->connect){
					$this->getMessage("Memcache'e bağlanılamadı","Memcache'e bağlanılamadı","");
				}
			}
			else{
				$this->getMessage("Memcache bilgi eksik.","Memcache bilgilerinizde eksiklikler var. <br/><b>".APPLICATION_PATH."/Config/Cache.php</b> dosyasını kontrol edin.");
			}
		}
		function set($key = false,$data,$second=300,$zip=false){
			if(!$key){
				$this->getMessage("Memcache için key girmelisiniz.","Key bilgisi yok.");
			}
			else{
				$this->Memcache->set($key,$data,$zip,$second);
			}
		}
		function get($key = false){
			if(!$key){
				$this->getMessage("Memcache için key girmelisiniz.","Key bilgisi yok.");
			}
			else{
				$get = $this->Memcache->get($key);
				if($get){
					return $get;
				}
				else{
					return false;
				}
			}
		}
		function delete($key = false){
			if(!$key){
				$this->getMessage("Memcache için key girmelisiniz.","Key bilgisi yok.");
			}
			else{
				$this->Memcache->delete($key);
			}
		}
	}
?>