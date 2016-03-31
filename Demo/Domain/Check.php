<?php 

class Domain_Check {

    public $msg      = '';
    public $nickname = '';
    public $Email    = '';
    public $password = '';
    public $model    = '';

	public function checkNi($nickname){

		if (!preg_match('/^[0-9a-zA-Z\x{4e00}-\x{9fa5}]{1,16}+$/u', $nickname)) {
        	$this->msg = '昵称只能为中文、英文、数字，不得超过16位！';
    	} 

        if (!empty($this->model->checkNickname($nickname))) {
            $this->msg = '该昵称已占用';
        }
    }

    public function checkE($Email){
       
        if (!preg_match('/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/', $Email)) {
            $this->msg = '邮箱地址格式错误';
        } 

        if (!empty($this->model->checkEmail($Email))) {
            $this->msg = '该邮箱已占用';
        }
    }

    public function checkPwd($password){

        if (!preg_match('/^[\s|\S]{6,18}$/u', $password)) {
            $this->msg = '密码长度为6-18位！';
        } 
    }

    public function request($data){
        $this->model    = new Model_Check();
        $this->nickname = $data['nickname'];
        $this->Email    = $data['Email'];
        $this->password = $data['password'];
    }

    public function reg($data){
        $this->request($data);
        $this->checkNi($this->nickname);
        $this->checkE($this->Email);
        $this->checkPwd($this->password);

        return $this->msg;

    }

}



 