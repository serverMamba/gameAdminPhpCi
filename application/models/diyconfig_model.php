<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diyconfig_model extends MY_Model {

    public function __construct() {
        parent::__construct();

        // 用到的表名
        $this->dbglobal     = $this->dbalias['dbglobal'];
        $this->tbadwall     = $this->dbalias['tbadwallinfo'];
        $this->tbgameadwall = $this->dbalias['tbgameadwall'];
        $this->tbglobgift   = $this->dbalias['tbglobgift'];
        $this->tbtotalchip  = $this->dbalias['tbtotalchip'];
        $this->tbonlinestat = $this->dbalias['tbonlinestat'];
        $this->tbbroadcast  = $this->dbalias['tbbroadecast'];
        $this->propertytype = $this->dbalias['propertytype'];
        $this->propertylist = $this->dbalias['propertylist'];
        $this->gifttype     = $this->dbalias['gifttype'];
        $this->giftlist     = $this->dbalias['giftlist'];
        $this->tbmaxid      = $this->dbalias['tbmaxid'];
        $this->chiprank     = $this->dbalias['topchipslist'];
        $this->notifycation = $this->dbalias['notifycation'];
        
        // 数据库配置
        $this->dbconfig['database'] = $this->dbglobal;
        $this->db = $this->load->database($this->dbconfig, true);

    }
    
    /**
     * 返回系统公告数据
     * @return array
     */
    public function get_notifycation()
    {
        $this->_use_read_db();
        $this->db = $this->load->database($this->dbconfig, true);
        $this->db->order_by('notification_addtime', 'desc');
        $query = $this->db->get($this->notifycation);
        
        return $this->_dealwith_ret($query);
    }
    
    /**
     * 返回排行榜数据
     * @param string $type
     * @return array (type, data, ret1, ret2)
     */
    public function get_rank($type)
    {
        //TODO: 后续按$type查询，现在只有筹码排行榜
        //因为用户数据分别放在两台服务器上，需要查两次
        $ret1 = $this->_array_sort($this->_query_rank('m1'), 'value');
        $ret2 = $this->_array_sort($this->_query_rank('m2'), 'value');
        
        $tmp = array_merge($ret1, $ret2);
        $tmp = $this->_array_sort($tmp, 'value');
        $tmp = array_slice($tmp, 0, 20);
        
        $ret = array(
            'type' => $type,    
            'data' => $tmp,
            'ret1' => $ret1,
            'ret2' => $ret2,
        );
        
        return $ret;
    }
    
    /**
     * 排名按value字段排序
     * @param array $arr
     * @param unknown_type $keys
     * @return multitype:unknown
     */
    private function _array_sort($arr, $keys) 
    {
        $keysvalue = array();
        $ret = array();
    
        foreach ($arr as $k => $v) {
            $keysvalue[$k] = $v[$keys];
        }
    
        arsort($keysvalue);
    
        foreach ($keysvalue as $k => $v) {
            $ret[] = $arr[$k];
        }
    
        return $ret;
    }
    
    /**
     * 根据数据库名查询排行榜
     * @param string $dbname
     * @return array
     */
    private function _query_rank($dbname) 
    {
        $this->dbconfig['hostname'] = $this->hostlist[$dbname];
        $this->db = $this->load->database($this->dbconfig, true);
       // print_r($this->dbconfig);
        $this->db->select('userid as id');
        $this->db->select('account as nickname');
        $this->db->select('chips as value');
        $this->db->from($this->chiprank);
       // print_r($this->chiprank);
        $this->db->group_by('userid');
        $query = $this->db->get();

        $ret = $this->_dealwith_ret($query); 
        
       
        return $ret;
    }

    public function get_onlinestat($strdate, $start, $end) {

        $this->_use_read_db();
        $this->db = $this->load->database($this->dbconfig, true);
        
        $sql = "SELECT * FROM " . $this->tbonlinestat;         
//         $sql .= " WHERE statistics_time like '$strdate%'";
        $sql .= " WHERE statistics_time > '$strdate $start:00'";
        $sql .= " AND statistics_time < '$strdate $end:00'";
        $sql .= " ORDER BY statistics_time";
        $query = $this->db->query($sql);

        $ret = $this->_dealwith_ret($query);
        return $ret; 

    }

    /*
     * 广告墙列表 
     */
    public function get_adwalllist() {

        $this->_use_read_db();
        $this->db = $this->load->database($this->dbconfig, true);
        $query = $this->db->get($this->tbadwall);

        return $this->_dealwith_ret($query); 
        
    }

    /*
     * 打开的广告墙列表
     */
    public function get_openadwalllist() {

        $this->_use_read_db();
        $this->db = $this->load->database($this->dbconfig, true);

        $this->db->select($this->tbgameadwall . '.id, adwall_name, adwall_code, game_root_version, game_sub_version, adwallorder');
        $this->db->from($this->tbgameadwall);
        $this->db->join($this->tbadwall, $this->tbgameadwall . '.adwall_code = ' . $this->tbadwall . '.id');
        $this->db->order_by('adwall_code, adwallorder');
        $query = $this->db->get();

        return $this->_dealwith_ret($query); 

    }

    /*
     * 添加打开的广告墙记录
     */ 
    public function addadwall($appid, $rootver, $subver) {
        
        $this->_use_write_db();
        $this->db = $this->load->database($this->dbconfig, true);
        
        $data = array(
            'adwall_code' => $appid,
            'gamecode'    => $appid,
            'game_root_version' => $rootver,
            'game_sub_version'  => $subver,
        );

        $this->db->from($this->tbgameadwall);
        $this->db->where($data);
        $count_ret = $this->db->count_all_results();

        if ($count_ret <= 0) {
            $ret = $this->db->insert($this->tbgameadwall, $data);
        }

        return $ret;

    }

    /*
     * 删除广告墙记录
     */ 
    public function deleteadwall($recordid) {

        $this->_use_write_db();
        $this->db = $this->load->database($this->dbconfig, true);

        $ret = $this->db->delete($this->tbgameadwall, array('id' => $recordid));

        return $ret;

    }
    
    /*
     * 获取礼物表
     */
    public function get_giftlist() {
        
        $this->_use_read_db();
        $this->db = $this->load->database($this->dbconfig, true);

        $query = $this->db->get($this->tbglobgift);

        $ret = $this->_dealwith_ret($query); 
        return $ret;

    }
    
    public function get_totalchip($strdate) {

        $this->_use_read_db();
        $this->db = $this->load->database($this->dbconfig, true);

        $sql = "SELECT totalchipnum, statisticstime FROM CASINOTOTALCHIPNUM";
        $sql .= " WHERE statisticstime LIKE '$strdate%'";
        $sql .= " ORDER BY statisticstime DESC";
        $query = $this->db->query($sql);

        $ret = $this->_dealwith_ret($query); 
        return $ret;

    }

    public function get_broadcast() {

        $this->_use_read_db();
        $this->db = $this->load->database($this->dbconfig, true);

        $query = $this->db->get($this->tbbroadcast);

        $ret = $this->_dealwith_ret($query); 
        return $ret;


    }
    
    /**
     * 财产类型
     * @return array
     */
    public function get_property_type() {
    	
    	$this->_use_read_db();
    	$this->db->select('id, propertytype_des as type, type_pic as pic');
    	$query = $this->db->get($this->propertytype);
    	$ret = $this->_dealwith_ret($query);
    	
    	return $ret;
    	 
    }
    
    /**
     * 礼物类型
     * @return array
     */
    public function get_gift_type() {
    
    	$this->_use_read_db();
    	$this->db->select('id, gifttype_des as type, type_pic as pic');
    	$query = $this->db->get($this->gifttype);
    	$ret = $this->_dealwith_ret($query);
    
    	return $ret;
    
    }
    
    /**
     * 财产列表
     * @param int $type
     * @return array
     */
    public function get_property_list($type) {
    	 
    	$this->_use_read_db();
    	$this->db->select('id, property_des as des, property_price as price, property_pic as pic, property_type as type');
    	$this->db->where('property_type = '. $type);
    	$query = $this->db->get($this->propertylist);
    	$ret = $this->_dealwith_ret($query);
    
    	return $ret;
    	 
    }
    
    /**
     * 礼物列表
     * @param int $type
     * @return array
     */
    public function get_gift_list($type) {
    
    	$this->_use_read_db();
    	$this->db->select('id, giftdes as des, giftprice as price, giftpic as pic, gifttype as type');
    	$this->db->where('gifttype = '. $type);
    	$query = $this->db->get($this->giftlist);
    	$ret = $this->_dealwith_ret($query);
    
    	return $ret;
    
    }
    
    public function get_max_userid() {
    	$this->_use_read_db();
    	
    	$query = $this->db->get($this->tbmaxid);
    	$ret = $this->_dealwith_ret($query);
    	
    	return $ret[0];
    }
    /******************************
     * test code from here 
     *****************************/

}
