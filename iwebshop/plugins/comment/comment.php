<?php

class comment extends pluginBase{

    //【必填】插件中文名称
    public static function name()
    {
        return "三众科技评论插件";
    }

    //【必填】插件的功能简介
    public static function description()
    {
        return "文章评论插件";
    }

    //安装插件代码
    public static function install()
    {
        $commentDB = new IModel('article_comment');//表名article_comment
        //判断表是否存在
        if($commentDB->exists())
        {
            return true;
        }
        $data = array(
            "comment" => self::name(),
            "column"  => array(
                "id" => array("type" => "int(11) unsigned",'auto_increment' => 1),
                "content" => array("type" => "text","comment" => "评论内容"),
                "create_time" => array("type" => "int(11) unsigned","default" => "0","comment" => "评论时间"),
                "recontents" => array("type" => "text","comment" => "回复内容"),
                "recomment_time" => array("type" => "int(11) unsigned","default" => "0","comment" => "回复时间"),
                "aid" => array("type" => "int(11) unsigned","default" => "0","comment" => "文章id"),
                "uid" => array("type" => "int(11) unsigned","default" => "0","comment" => "用户id")
            ),
            "index" => array("primary" => "id","key" => "aid,uid"),
        );
        $commentDB->setData($data);
        //开始创建表
        return $commentDB->createTable();
    }
    //卸载插件代码
    public static function uninstall()
    {
        $commentDB = new IModel('article_comment');
        //删除表
        return $commentDB->dropTable();
    }

    //插件参数配置
    public static function configName()
    {
	//在本拿了中无参数配置
    	return array();
    }

     public function reg()
    {
        //后台插件管理中增加该插件链接
        plugin::reg("onSystemMenuCreate",function(){
            $link = "/plugins/system_comment_list";
            Menu::$menu["插件"]["插件管理"][$link] = $this->name();
        });

        //后台评论列表的链接
        plugin::reg("onBeforeCreateAction@plugins@system_comment_list",function(){
            self::controller()->system_comment_list = function(){$this->comment_list();};
        });
        //后台评论详情的链接
        plugin::reg("onBeforeCreateAction@plugins@system_comment_edit",function(){
            self::controller()->system_comment_edit = function(){$this->comment_edit();};
        });
        //后台评论回复的链接
        plugin::reg("onBeforeCreateAction@plugins@system_comment_update",function(){
            self::controller()->system_comment_update = function(){$this->comment_update();};
        });
        //后台评论删除的链接
        plugin::reg("onBeforeCreateAction@plugins@system_comment_del",function(){
            self::controller()->system_comment_del = function(){$this->comment_del();};
        });

    }

    public function comment_list()
    {
            $this->redirect('system_comment_list');
    }

    public function comment_edit()
    {
        $id           = IFilter::act(IReq::get('id'));
        $commentDB = new IQuery('article_comment as c');
        $commentDB->join=" left join article as b on c.aid = b.id left join user as a on c.uid = a.id ";
        $commentDB->where=" c.id=$id ";
        $commentDB->fields ="c.id,FROM_UNIXTIME(c.create_time) as create_time,a.username,b.title,c.recomment_time,c.recontents,c.content";
        $items = $commentDB->find();

        $this->redirect('system_comment_edit',array('comment' => current($items)));
    }

    //回复评论
    public function comment_update()
    {
        $id           = IFilter::act(IReq::get('id'));
        $recontents   = IFilter::act(IReq::get('recontents'));

        $data        = array();

        $data['recontents']=$recontents;
        $data['recomment_time']=time();
        //保存数据库
        $commentDB = new IModel('article_comment');
        $commentDB->setData($data);
        $commentDB->update('id = '.$id);

        $this->redirect('system_comment_list');
    }

    //回复删除
    public function comment_del()
    {
        $commentDB = new IModel('article_comment');
        $id           = IFilter::act(IReq::get('id'));
        $commentDB->del('id = '.$id);
        $this->redirect('system_comment_list');
    }

}