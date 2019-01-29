<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 支付相关
 */
class pay_model extends MY_Model {
    var $db = null;
    var $payment_tables = null; 

    public function __construct() {
        parent::__construct();

        // 用到的表名
        $this->dbpay      = $this->dbalias['dbpay'];
        $this->tbszf      = $this->dbalias['tbshenzhoufu'];
        $this->tbappstore = $this->dbalias['tbappstore'];
        $this->tbalipay   = $this->dbalias['tbalipay'];
        $this->tbpay91    = $this->dbalias['tbpay91'];
        $this->tbcmb      = $this->dbalias['tbcmb']; 
        $this->tbweipai   = $this->dbalias['tbweipai'];
        $this->tb360      = $this->dbalias['tb360'];
        $this->tbcunm     = $this->dbalias['tbcunm'];
        $this->tbwoshop   = $this->dbalias['tbwoshop'];
        $this->tbyifutong = $this->dbalias['tbyifutong'];
        $this->tbtelcardex = $this->dbalias['tbtelcardex'];
        

        // 用到的表名
        $this->dbuser  = $this->dbalias['dbuser'];
        $this->tbuser  = $this->dbalias['tbuser'];

        $this->payment_tables = $this->config->item('payment_tables');
    }
    
    public function get_payrank()
    {
        $this->_use_read_db();
        $this->_use_db($this->dbpay);
        $this->db = $this->load->database($this->dbconfig, true);
         
        $sql = "SELECT T1.*, CASINOVIPUSER.userid as uid, CASINOVIPUSER.mobilenumber FROM ";
        $sql .= "(SELECT sum(totalfee) as totalfee, userid, count(userid) as count FROM (";
        $sql_arr = array();
        foreach ($this->payment_tables as $k => $v)
        {
            $sql_arr[] = " (SELECT userid, totalfee FROM " . $v['tbname'] . " ) ";
        }
        $sql .= implode(' UNION ALL ', $sql_arr);
        $sql .= " ) AS T GROUP BY userid ORDER BY totalfee DESC) ";
        $sql .= " AS T1 LEFT JOIN CASINOVIPUSER ON T1.userid = CASINOVIPUSER.userid ";
        $sql .= " WHERE totalfee >= 100";

        $query = $this->db->query($sql);

        $ret = $this->_dealwith_ret($query);

        return $ret;
    }

    /**
     * 按日期充值筹码排行 
     * @param string $fromdate
     * @param string $todate
     * @param string $toolcode [0001|0002|0004]
     * @param string $limit
     */
    public function get_payrank_by_week($fromdate, $todate, $toolcode, $limit = 50)
    {
        $this->_use_read_db();
        $this->_use_db($this->dbpay);
        $this->db = $this->load->database($this->dbconfig, true);
         
        $sql = "SELECT sum(totalfee) as totalfee, userid, count(userid) as count FROM (";
        $sql_arr = array();
        foreach ($this->payment_tables as $k => $v)
        {
            $sql_arr[] = " (SELECT userid, totalfee FROM " . $v['tbname'] . " WHERE tradeTime > '$fromdate' AND tradeTime < '$todate' AND LEFT(productid, 4) = '$toolcode') ";
        }
        $sql .= implode(' UNION ALL ', $sql_arr);
        $sql .= " ) AS T GROUP BY userid ORDER BY totalfee DESC LIMIT $limit";

        $query = $this->db->query($sql);

        $ret = $this->_dealwith_ret($query);
        return $ret;
    }

    /**
     * 按日期充值筹码排行 
     * @param string $strdate
     * @param string $toolcode [0001|0002|0004]
     * @param string $limit
     */
     public function get_payrank_by_date1($strdate, $toolcode, $limit = 50)
    {
        $this->_use_read_db();
        $this->_use_db($this->dbpay);
        $this->db = $this->load->database($this->dbconfig, true);
         
        $sql = "SELECT sum(totalfee) as totalfee, userid, count(userid) as count FROM (";
        $sql_arr = array();
        foreach ($this->payment_tables as $k => $v)
        {
            $sql_arr[] = " (SELECT userid, totalfee FROM " . $v['tbname'] . " WHERE tradeTime like '$strdate%') ";
        }
        $sql .= implode(' UNION ALL ', $sql_arr);
        $sql .= " ) AS T GROUP BY userid ORDER BY totalfee DESC LIMIT $limit";
        //echo $sql;
        $query = $this->db->query($sql);

        $ret = $this->_dealwith_ret($query);
        return $ret;
    }
    public function get_payrank_by_date($strdate, $toolcode, $limit = 50)
    {
        $this->_use_read_db();
        $this->_use_db($this->dbpay);
        $this->db = $this->load->database($this->dbconfig, true);
         
        $sql = "SELECT sum(totalfee) as totalfee, userid, count(userid) as count FROM (";
        $sql_arr = array();
        foreach ($this->payment_tables as $k => $v)
        {
           // $sql_arr[] = " (SELECT userid, totalfee FROM " . $v['tbname'] . " WHERE tradeTime like '$strdate%' AND LEFT(productid, 4) = '$toolcode') ";
            if($toolcode == "0001")
            {
               $sql_arr[] = " (SELECT userid, totalfee FROM " . $v['tbname'] . " WHERE tradeTime <= '$strdate 23:59:59' and tradeTime >= '$strdate 00:00:00' and ( LEFT(productid, 4) = '0001' or LEFT(productid, 4) = '0201' ) ) ";
            }
            
            if($toolcode == "0002")
            {
              $sql_arr[] = " (SELECT userid, totalfee FROM " . $v['tbname'] . " WHERE tradeTime <= '$strdate 23:59:59' and tradeTime >= '$strdate 00:00:00' and ( LEFT(productid, 4) = '0002' or LEFT(productid, 4) = '0202' ) ) ";
            }
        }
        $sql .= implode(' UNION ALL ', $sql_arr);
        $sql .= " ) AS T GROUP BY userid ORDER BY totalfee DESC LIMIT $limit";
        //echo $sql;
        $query = $this->db->query($sql);

        $ret = $this->_dealwith_ret($query);
        return $ret;
    }

    /**
     * 某时间的各个游戏收入
     * @param string $strdate
     */
    public function get_gamepay_by_date($strdate)
    {
        $this->_use_read_db();
        $this->_use_db($this->dbpay);
        $this->db = $this->load->database($this->dbconfig, true);
         
        $sql = "SELECT sum(totalfee) as totalfee, gamecode FROM (";
        $sql_arr = array();
        foreach ($this->payment_tables as $k => $v)
        {
            $sql_arr[] = " (SELECT id, tradeno, tradeTime, userid, gamecode, platformid, totalfee, productid, channelid FROM " . $v['tbname'] . " WHERE tradeTime like '$strdate%') ";
        }
        $sql .= implode(' UNION ALL ', $sql_arr);
        $sql .= " ) AS T GROUP BY gamecode";
        $query = $this->db->query($sql);

        $ret = $this->_dealwith_ret($query);
         
        return $ret;
    }
    
    /**
     * 某天的付费总数
     * @param string $strdate
     * @return Ambigous <boolean, multitype:>
     */
    public function get_totalpay_by_date($strdate) {
         
        $this->_use_read_db();
        $this->_use_db($this->dbpay);
        $this->db = $this->load->database($this->dbconfig, true);
        
        $sql = "SELECT sum(totalfee) as totalfee FROM (";
        $sql_arr = array();
        foreach ($this->payment_tables as $k => $v)
        {
            $sql_arr[] = " (SELECT id, tradeno, tradeTime, userid, gamecode, platformid, totalfee, productid, channelid FROM " . $v['tbname'] . " WHERE tradeTime like '$strdate%') ";
        }
        $sql .= implode(' UNION ALL ', $sql_arr);
        $sql .= " ) AS T ";
        $query = $this->db->query($sql);

        $ret = $this->_dealwith_ret($query);
         
        return $ret[0]['totalfee'];
             
    }
    
    /**
     * 得到每日付费用户数
     */
    public function get_daily_paycount($strdate)
    {
        $this->_use_read_db();
        $this->_use_db($this->dbpay);
        $this->db = $this->load->database($this->dbconfig, true);
       
        $sql  = "SELECT COUNT(DISTINCT(userid)) as num, tradeTime from (";
        $sql_arr = array();
        foreach ($this->payment_tables as $k => $v)
        {
            $sql_arr[] = " SELECT userid, left(tradeTime, 10) as tradeTime FROM " . $v['tbname'] . " WHERE tradeTime like '$strdate%' ";
        }
        $sql .= implode(' UNION ALL ', $sql_arr);
        $sql .= " ) as T GROUP BY tradeTime";
        $query = $this->db->query($sql);
        
        $ret = $this->_dealwith_ret($query);
        
        return $ret;
    }
    
    /**
     * 得到月付费用户数
     */
    public function get_month_paycount()
    {
        $this->_use_read_db();
        $this->_use_db($this->dbpay);
        $this->db = $this->load->database($this->dbconfig, true);
    
        $sql  = "SELECT COUNT(DISTINCT(userid)) as num, tradeTime from (";
        $sql_arr = array();
        foreach ($this->payment_tables as $k => $v)
        {
            $sql_arr[] = " SELECT userid, left(tradeTime, 7) as tradeTime FROM " . $v['tbname'];
        }
        $sql .= implode(' UNION ALL ', $sql_arr);
        $sql .= " ) as T GROUP BY tradeTime";
        $query = $this->db->query($sql);
    
        $ret = $this->_dealwith_ret($query);
    
        return $ret;
    }
    
    /**
     * 得到总付费用户数
     */
    public function get_total_paycount()
    {
        $this->_use_read_db();
        $this->_use_db($this->dbpay);
        $this->db = $this->load->database($this->dbconfig, true);

        $sql  = "SELECT COUNT(DISTINCT(userid)) as num from (";
        $sql_arr = array();
        foreach ($this->payment_tables as $k => $v)
        {
            $sql_arr[] = " SELECT userid, tradeTime FROM " . $v['tbname'] ;
        }
        $sql .= implode(' UNION ALL ', $sql_arr);
        $sql .= ") as T";
        $query = $this->db->query($sql);
    
        $ret = $this->_dealwith_ret($query);
    
        return $ret[0];
    }
    
    /**
     * 确定兑换礼品记录
     * @param number $rid
     * @param array $record
     * @return boolean
     */
    public function updateExchangeRecord($rid, $record) 
    {
        $this->_use_write_db();
        $this->_use_db($this->dbpay);
        $this->db = $this->load->database($this->dbconfig, true);
        
        $this->db->where('id', $rid);
        $ret = $this->db->update($this->tbtelcardex, $record);
        
        return $ret;
    }
    
    /**
     * 兑换礼品列表
     * @return array
     */
    public function getExchangeList () 
    {
        $this->_use_read_db();
        $this->_use_db($this->dbpay);
        $this->db = $this->load->database($this->dbconfig, true);
        
        $sql  = "SELECT *, CASINOTELCARDEXCHANGERECORD.id as rid FROM CASINOBUYHISDB.CASINOTELCARDEXCHANGERECORD";
        $sql .= " JOIN CASINOGLOBALINFO.CASINOEXCHANGEGIFT";
        $sql .= " WHERE CASINOTELCARDEXCHANGERECORD.giftid = CASINOEXCHANGEGIFT.id";
        $sql .= " ORDER BY tradetime DESC";
        $query = $this->db->query($sql);
        
        $ret = $this->_dealwith_ret($query);
        
        return $ret;
    }
    
    /*
     * 插入一条神州付订单记录 
     */
    public function addSZFRecord($tradeno, $userid, $gamecode, $platformid, $cost, $productid) {

        $this->_use_write_db();
        $this->_use_db($this->dbpay);
        $this->db = $this->load->database($this->dbconfig, true);

        $data = array(
            'tradeno'    => $tradeno,    
            'userid'     => $userid,    
            'gamecode'   => $gamecode,    
            'platformid' => $platformid,
            'cost'       => $cost, 
            'productid'  => $productid, 
        );
        $query = $this->db->insert($this->tbszf, $data);
        
        return $this->db->affected_rows();       
    }

    /*
     * 添加筹码
     * @return [0-成功;1-用户不存在;2-加筹码失败] 
     */
    public function addChips($uid, $idxs, $chips) {

        $dbidx = $idxs['dbindex'];
        $tbidx = $idxs['tableindex'];
        
        $this->_use_write_userdb($dbidx);
        $this->_use_db($this->dbuser . $dbidx);
        $this->db = $this->load->database($this->dbconfig, true);

        $sql = "CALL ADDSCORE($uid, $chips, @finalscore, @returncode, $tbidx, $dbidx)";
        $query = $this->db->query($sql);
        $ret = $query->result_array();

        return $ret[0]['returncode']; 

    } 

    /*
     * 检查订单是否已经存在
     */
    public function checkSZFRecExist($tradeno) {

        $this->_use_read_db();
        $this->_use_db($this->dbpay);
        $this->db = $this->load->database($this->dbconfig, true);

        $query = $this->db->get_where($this->tbszf, array('tradeno' => $tradeno));

        return $query->num_rows() > 0; 
    }

    /*
     * 获取充值记录
     */
    public function get_pay($account) {
        $this->_use_read_db();
        $this->_use_db($this->dbpay);
        $this->db = $this->load->database($this->dbconfig, true);
        
        $sql_arr = array();
        foreach ($this->payment_tables as $k => $v)
        {
            $sql_arr[] = " SELECT id, tradeno, tradeTime, userid, gamecode, platformid, totalfee, productid, channelid FROM " . $v['tbname'] . " WHERE userid = '$account' ";
        }
        $sql .= implode(' UNION ALL ', $sql_arr);

        $query = $this->db->query($sql);

        $ret = $this->_dealwith_ret($query); 

        return $ret; 

    }
    
    /**
     * 查询某日充值订单总数
     * @param string $strdate
     * @return int
     */
    public function get_paycount_by_date($strdate)
    {
        $this->_use_read_db();
        $this->_use_db($this->dbpay);
        $this->db = $this->load->database($this->dbconfig, true);
         
        $sql = "SELECT count(*) as count FROM (";

        $sql_arr = array();
        foreach ($this->payment_tables as $k => $v)
        {
            $sql_arr[] = " (SELECT id, tradeno, tradeTime, userid, gamecode, platformid, totalfee, productid, channelid FROM " . $v['tbname'] . " WHERE tradeTime like '$strdate%') ";
        }
        $sql .= implode(' UNION ALL ', $sql_arr);
        $sql .= " ) AS T ";
        $query = $this->db->query($sql);
        
        $ret = $this->_dealwith_ret($query);
         
        return intval($ret[0]['count']);
    }
    
    /**
     * 查询某日期充值订单
     * @param string $strdate
     * @return array
     */
    public function get_pay_by_date($strdate, $page, $perpage) {
    	$this->_use_read_db();
    	$this->_use_db($this->dbpay);
    	$this->db = $this->load->database($this->dbconfig, true);
    	
    	if (is_null($page))
    	{
    	    $page = 0;
    	}
    	
        $sql = "SELECT * FROM (";
        $sql_arr = array();
        foreach ($this->payment_tables as $k => $v)
        {
            $sql_arr[] = " (SELECT id, tradeno, tradeTime, userid, gamecode, platformid, totalfee, productid, channelid FROM " . $v['tbname'] . " WHERE tradeTime like '$strdate%') ";
        }
        $sql .= implode(' UNION ALL ', $sql_arr);
        $sql .= " ) AS T ORDER BY tradeTime DESC";
        $sql .= " LIMIT $page , $perpage";
        $query = $this->db->query($sql);
    	
    	$ret = $this->_dealwith_ret($query);
    	
    	return $ret;
    	
    }

    /*
     * 减去筹码
     * @return [0-成功;1-用户不存在;2-减筹码失败] 
     */
    public function subChips($uid, $idxs, $chips) {

        $dbidx = $idxs['dbindex'];
        $tbidx = $idxs['tableindex'];
        
        $this->_use_write_userdb($dbidx);
        $this->_use_db($this->dbuser . $dbidx);
        $this->db = $this->load->database($this->dbconfig, true);
    
        $sql = "CALL SUBSCORE($uid, $chips, @finalscore, @returncode, $tbidx, $dbidx)";
        $query = $this->db->query($sql);
        $ret = $query->result_array();

        return $ret[0]['returncode']; 

    } 


    /**
     * 月充值记录
     * @param number $year
     * @param number $month
     */
    public function get_monthpay($year, $month) {
        $this->_use_read_db();
    	$this->_use_db($this->dbpay);
    	$this->db = $this->load->database($this->dbconfig, true);
    	
    	$strdate = "$year-$month";
        
      //  print_r($this->payment_tables);
    	
        $sql = "SELECT tradeDate, count(*) as num, sum(totalfee) as total FROM (";
        $sql_arr = array();
        foreach ($this->payment_tables as $k => $v)
        {
            $sql_arr[] = " (SELECT tradeno, totalfee, substring(tradeTime, 1, 10) as tradeDate FROM " . $v['tbname'] . " WHERE tradeTime like '$strdate%') ";
        }
        $sql .= implode(' UNION ALL ', $sql_arr);
        $sql .= " ) AS T GROUP BY tradeDate";
        $query = $this->db->query($sql);
    	
    	$ret = $this->_dealwith_ret($query);
    	
    	return $ret;
    }

    /******************************
     * test code from here 
     *****************************/

}
