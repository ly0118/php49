<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/31
 * Time: 18:27
 */

namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function register(){
        if(IS_POST){
            $username = I('post.username');
            $password = I('post.password');
            $mail = I('post.mail');
            $salt = md5(time());
            $data = array(
                'username' => $username,
                'password' => $password,
                'email'    => $mail,
                'salt'     => $salt,
            );
            $rs = M('User') -> add($data);
            if($rs){
                $this -> success('注册成功',U('User/login'),3);
            }else{
                $this -> error('注册失败',U('User/register'),3);
            }
        }else{
            $this -> display();
        }
    }
}