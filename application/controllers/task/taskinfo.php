<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class taskinfo extends MY_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin () || !$this->session->userdata('admin_name') ) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yygl_task' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'task/cus_task_model' );
		
		$this->load->model ( 'task/jb_task2form_model' );
		$this->load->model ( 'task/jb_form2redis_model' );
	}
	public function index() {
		$select_tag = $this->input->get ( 'tag', true ) ? $this->input->get ( 'tag', true ) : '';
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "财务管理",
						"child" => "帐户详情" 
				),
				"header1" => array (
						"father" => "财务管理",
						"child" => "帐户详情" 
				),
				'taglist' => $this->config->item ( 'taglist' ) 
		);
		$config ['base_url'] = site_url ( 'task/taskinfo/index' );
		$this->load->view ( 'no3/sys_notice_list_views', $data );
	}
	public function toAdd() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "财务管理",
						"child" => "帐户详情" 
				),
				"header1" => array (
						"father" => "财务管理",
						"child" => "帐户详情" 
				),
				'taglist' => $this->config->item ( 'taglist' ) 
		);
		$this->load->view ( 'task/tasknew_views', $data );
	}
	public function toEdit() {
		$id = $this->input->get ( 'id' ) ? $this->input->get ( 'id' ) : 0;
		if (! $id) {
			$this->session->set_flashdata ( 'error', '参数错误1' );
			redirect ( 'task/taskmgr' );
		}
		$edit = $this->input->get ( 'edit' ) ? $this->input->get ( 'edit' ) : "";
		$readonly = "";
		if("true"!==$edit){
			$readonly = " readonly='readonly' ";
		}
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "财务管理",
						"child" => "帐户详情" 
				),
				"header1" => array (
						"father" => "财务管理",
						"child" => "帐户详情" 
				),
				'readonly' => $readonly,
				'adduser' => $this->session->userdata('admin_name'),
				'notice' => $this->cus_task_model->gettaskForm ( $id ),
				'form_list' => $this->cus_task_model->getChildSolution($id)
		);
		$this->load->view ( 'task/taskinfo_views', $data );
	}
	public function ajaxDeltask()
	{
		$task_id = $this->input->post ( 'task_id' ) ? intval($this->input->post ( 'task_id' )) : 0;
		if ($task_id<=0) {
			$return_ary = array (
					'status' => '0',
					'msg' => '参数错误！'
			);
			exit ( json_encode ( $return_ary ) );
			return;
		}
		$flag = $this->cus_task_model->deltask($task_id);
		$return_ary = array (
				'status' => '0',
				'msg' => '任务'.$task_id.'删除失败'
		);
		if($flag)
		{
			$return_ary = array (
					'status' => '1',
					'msg' => '任务'.$task_id.'删除成功'
			);
		}
		exit ( json_encode ( $return_ary ) );
	
	}
	public function ajaxClosetask()
	{
		$task_id = $this->input->post ( 'task_id' ) ? $this->input->post ( 'task_id' ) : "";
		if (!$task_id) {
			$return_ary = array (
					'status' => '0',
					'msg' => '参数错误！'
			);
			exit ( json_encode ( $return_ary ) );
			return;
		}
		$data = array (
					'status' => 2
		);
		$flag = $this->cus_task_model->updatetask($task_id, $data);
		$return_ary = array (
				'status' => '0',
				'msg' => '关闭失败'
		);
		if($flag)
		{
			$return_ary = array (
				'status' => '1',
				'msg' => '成功'
			);
		}
		exit ( json_encode ( $return_ary ) );
		
	}
	public function ajaxGetChildSolution()
	{
		$task_id = $this->input->post ( 'task_id' ) ? $this->input->post ( 'task_id' ) : 0;
		if (!$task_id) {
			$return_ary = array (
					'status' => '0',
					'msg' => '参数错误！'
			);
			exit ( json_encode ( $return_ary ) );
			return;
		}
		$solutions = $this->cus_task_model->getChildSolution($task_id);
		$return_ary = array (
				'status' => '0',
				'msg' => '无工单记录！'
		);
		if($solutions)
		{
			$return_ary = array (
					'status' => '1',
					'solutions' => $solutions,
					'msg' => '成功'
			);
		}
		exit ( json_encode ( $return_ary ) );
	}
	public function ajaxSaveSolution() {
		$task_id = $this->input->post ( 'task_id' ) ? $this->input->post ( 'task_id' ) : 0;
		$solution = $this->input->post ( 'solution' ) ? $this->input->post ( 'solution' ) : "";
		$adduser = $this->session->userdata('admin_name');
		if (!$task_id || !$solution) {
			$return_ary = array (
				'status' => '0',
				'adduser' => $adduser,
				'time' => date('Y-m-d H:i:s',time()),
				'msg' => '参数错误！'
			);
			exit ( json_encode ( $return_ary ) );
			return;
		}
		$solution = urldecode($solution);
		$data = array (
				'task_id' => $task_id,
				'adduser' => $adduser,
				'solution' => $solution
		);
		$flag = $this->cus_task_model->inserttaskSolution($data);
		$return_ary = array (
				'status' => '0',
				'adduser' => $adduser,
				'time' => date('Y-m-d H:i:s',time()),
				'msg' => '保存失败'
		);
		if($flag)
		{
			$return_ary = array (
					'status' => '1',
					'adduser' => $adduser,
					'time' => date('Y-m-d H:i:s',time()),
					'msg' => '成功'
			);
		}
		exit ( json_encode ( $return_ary ) );
	}
	public function ajaxSavetaskNew() {
		$target_ip = $this->input->post ( 'target_ip' ) ? $this->input->post ( 'target_ip' ) : "";
		$target_port = $this->input->post ( 'target_port' ) ? intval($this->input->post ( 'target_port' )) : 0;
		$tasktype = $this->input->post ( 'tasktype' ) ? $this->input->post ( 'tasktype' ) : "";
		$inter_time = $this->input->post ( 'inter_time' ) ? $this->input->post ( 'inter_time' ) : "";
		$exec_time = $this->input->post ( 'exec_time' ) ? $this->input->post ( 'exec_time' ) : date('Y-m-d H:i:s',time());
		$describe = $this->input->post ( 'describe' ) ? $this->input->post ( 'describe' ) : "";
		$hex = $this->input->post ( 'hex' ) ? $this->input->post ( 'hex' ) : "";
		$hex = trim($hex);
		
		$end_time = $this->input->post ( 'end_time' ) ? $this->input->post ( 'end_time' ) : date ( 'Y-m-d H:i:s', strtotime ('+1 day' ));
		$action_type = $this->input->post ( 'action_type' ) ? $this->input->post ( 'action_type' ) : "DNS";
		$target_type = $this->input->post ( 'target_type' ) ? $this->input->post ( 'target_type' ) : "server_task";
		$priority_lev = $this->input->post ( 'priority_lev' ) ? intval($this->input->post ( 'priority_lev' )) : 1;
		if($priority_lev<=0){$priority_lev=1;}
		$adduser = $this->session->userdata('admin_name');
		$status = 1;//任务状态： 1 开启， 2 关闭
		
		if("client_task"!==$target_type){
			$hex = "";
		}
		$this->writelog("0 ajaxSavetaskNew: ".target_ip);
		if (!$target_ip || !$tasktype || ("1"!=$tasktype&&"2"!=$tasktype) || ("1"==$tasktype && !$inter_time) || ("2"==$tasktype && !$exec_time)) {
			$return_ary = array (
					'status' => '0',
					'msg' => '参数错误！'
			);
			exit ( json_encode ( $return_ary ) );
			return;
		}
		if(!$this->ifEffectiveAddr($target_ip)){
			$return_ary = array (
					'status' => '0',
					'msg' => 'IP或域名无效！'
			);
			exit ( json_encode ( $return_ary ) );
			return;
		}
	
		$describe = urldecode($describe);
		$uuid = md5(uniqid());
		$data = array (
				'target_ip' => $target_ip,
				'target_port' => $target_port,
				'tasktype' => $tasktype,
				'describe' => $describe,
				'hex' => $hex,
				'adduser' => $adduser,
				'update_user' => $adduser,
				'update_time' => date('Y-m-d H:i:s',time()),
				'inter_time' => $inter_time,
				'exec_time' => $exec_time,
				'status' => $status,
				'end_time' => $end_time,
				'action_type' => $action_type,
				'target_type' => $target_type,
				'priority_lev' => $priority_lev,
				'uuid' => $uuid
		);
		$this->writelog("1 $data ");
		$flag = $this->cus_task_model->inserttaskNew($data);
		$this->writelog("2 $flag ");
		$return_ary = array (
				'status' => '0',
				'adduser' => $adduser,
				'time' => date('Y-m-d H:i:s',time()),
				'msg' => '保存失败'
		);
		$res = $this->cus_task_model->gettaskId($uuid);
		$this->writelog("3 $res ");
		if($flag && !empty ( $res ) && $res['id'])
		{
			$return_ary = array (
					'status' => '1',
					'adduser' => $adduser,
					'time' => date('Y-m-d H:i:s',time()),
					'task_id' => $res['id'],
					'msg' => '成功'
			);
// 			$this->testTask();
// 			$this->jb_form2redis_model->writelog("-------testForm------------");
// 			$this->testForm();
		}
		exit ( json_encode ( $return_ary ) );
	}
	public function createtaskForm()
	{
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "财务管理",
						"child" => "帐户详情"
				),
				"header1" => array (
						"father" => "财务管理",
						"child" => "帐户详情"
				),
				'adduser' => $this->session->userdata('admin_name'),
				'taglist' => $this->config->item ( 'taglist' ),
				'tasktypeArr' => $tasktypeArr = array ("task" => "游戏task","install" => "无法安装","conn" => "无法连接","slow" => "游戏卡顿","flash" => "游戏闪退","other" => "其他问题")
		);
		$this->load->view ( 'task/tasknew_views', $data );
	}
	
	public function testTask(){
		$this->jb_task2form_model->testTask2From();
	}
	public function testForm(){
		$this->jb_form2redis_model->testFrom2Redis();
	}
	
	public function ifEffectiveAddr($ip){
		if(!$this->checkIp($ip)){
			$ip = gethostbyname($ip);
		}
		$flag = $this->checkIp($ip);
		return $flag;
	}
	/*
	 *@return Boolen
	*@param String $ip 要匹配的ip地址
	*@param String $pat 匹配的正则规则
	*@param Boolen 匹配成功后返回的布尔值
	*preg_match()
	*0为不成功，1为成功
	*/
	public function checkIp($ip){
		//0.0.0.0--- 255.255.255.255
		$pat = "/^(((1?\d{1,2})|(2[0-4]\d)|(25[0-5]))\.){3}((1?\d{1,2})|(2[0-4]\d)|(25[0-5]))$/";
		if(preg_match($pat,$ip)){
			$num = preg_match($pat,$ip);
			return $num;
		}else{
			$num = preg_match($pat,$ip);
			return $num;
		}
	}
	
	private function writeLog($txt) {
		$log_file = "/log/taskinfo.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date("Y-m-d H:i:s", time());
		$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
		fclose ( $handle );
	}
	
	
}
