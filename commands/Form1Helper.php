<?php
namespace app\commands;
use yii\base\Component;

/*主要用于 控制器中 所需函数*/
class Form1Helper extends Component
{

    public function test() {
        return 'yes';
    }

    /*获取访问用户的浏览器的信息   \Yii::$app->myhelper->determinebrowser();*/
    public function determinebrowser () {
        $Agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        if (preg_match('/msie ([0-9].[0-9]{1,2})/',$Agent,$version)) {
            $browserversion=$version[1];
            $browseragent="Internet Explorer";
        } else if (preg_match( '#opera/([0-9]{1,2}.[0-9]{1,2})#',$Agent,$version)) {
            $browserversion=$version[1];
            $browseragent="Opera";
        } else if (preg_match( '#firefox/([0-9.]{1,5})#',$Agent,$version)) {
            $browserversion=$version[1];
            $browseragent="Firefox";
        }else if (preg_match( '#chrome/([0-9].{1,3})#',$Agent,$version)) {
            $browserversion=$version[1];
            $browseragent="Chrome";
        }else if (preg_match( '#safari/([0-9.]{1,3})#',$Agent,$version)) {
            $browseragent="Safari";
            $browserversion="";
        }else {
            $browserversion = "";
            $browseragent = $Agent;
        }
        return $browseragent." ".$browserversion;
    }

    /*获取访问用户的系统的信息*/
    public function determineplatform () {
        $Agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $browserplatform='';
        if (preg_match('/win/',$Agent) && strpos($Agent, '95')) {
            $browserplatform="Windows 95";
        }
        elseif (preg_match('/win 9x/',$Agent) && strpos($Agent, '4.90')) {
            $browserplatform="Windows ME";
        }
        elseif (preg_match('/win/',$Agent) && preg_match('/98/',$Agent)) {
            $browserplatform="Windows 98";
        }
        elseif (preg_match('/win/',$Agent) && preg_match('/nt 5.0/',$Agent)) {
            $browserplatform="Windows 2000";
        }
        elseif (preg_match('/win/',$Agent) && preg_match('/nt 5.1/',$Agent)) {
            $browserplatform="Windows XP";
        }
        elseif (preg_match('/win/',$Agent) && preg_match('/nt 6.0/',$Agent)) {
            $browserplatform="Windows Vista";
        }
        elseif (preg_match('/win/',$Agent) && preg_match('/nt 6.1/',$Agent)) {
            $browserplatform="Windows 7";
        }
        elseif (preg_match('/win/',$Agent) && preg_match('/32/',$Agent)) {
            $browserplatform="Windows 32";
        }
        elseif (preg_match('/win/',$Agent) && preg_match('/nt/',$Agent)) {
            $browserplatform="Windows NT";
        }elseif (preg_match('/mac os/',$Agent)) {
            $browserplatform="Mac OS";
        }
        elseif (preg_match('/linux/',$Agent)) {
            $browserplatform="Linux";
        }
        elseif (preg_match('/unix/',$Agent)) {
            $browserplatform="Unix";
        }
        elseif (preg_match('/sun/',$Agent) && preg_match('/os/',$Agent)) {
            $browserplatform="SunOS";
        }
        elseif (preg_match('/ibm/',$Agent) && preg_match('/os/',$Agent)) {
            $browserplatform="IBM OS/2";
        }
        elseif (preg_match('/mac/',$Agent) && preg_match('/pc/',$Agent)) {
            $browserplatform="Macintosh";
        }
        elseif (preg_match('/powerpc/',$Agent)) {
            $browserplatform="PowerPC";
        }
        elseif (preg_match('/aix/',$Agent)) {
            $browserplatform="AIX";
        }
        elseif (preg_match('/hpux/',$Agent)) {
            $browserplatform="HPUX";
        }
        elseif (preg_match('/netbsd/',$Agent)) {
            $browserplatform="NetBSD";
        }
        elseif (preg_match('/bsd/',$Agent)) {
            $browserplatform="BSD";
        }
        elseif (preg_match('/osf1/',$Agent)) {
            $browserplatform="OSF1";
        }
        elseif (preg_match('/irix/',$Agent)) {
            $browserplatform="IRIX";
        }
        elseif (preg_match('/freebsd/',$Agent)) {
            $browserplatform="FreeBSD";
        }
        if ($browserplatform=='') {$browserplatform = $Agent; }
        return $browserplatform;
    }

    /*判断是否是手机浏览器，如果是 返回 true*/
    public function ismobile() {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))        return true;
        //此条摘自TPM智能切换模板引擎，适合TPM开发
        if(isset ($_SERVER['HTTP_CLIENT']) &&'PhoneClient'==$_SERVER['HTTP_CLIENT'])        return true;
        //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))        //找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
        //判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'        );
            //从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }
        //协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
        }
        return false;
    }

    /*SCWS中文分词php代码实现
    * @param $keyword 要分词的关键字
    * @return 分词后结果
    */
    public function scws($keyword) {
        if (empty($keyword)) {
            return false;
        }
        //实例化分词插件核心类
        $so = scws_new();

        //设置分词时所用编码
        $so->set_charset('utf8');

        //设置分词所用词典(此处使用utf8的词典)
        $so->set_dict('/usr/local/scws12/etc/dict.utf8.xdb');

        //设置分词所用规则
        $so->set_rule('/usr/local/scws12/etc/rules.utf8.ini');

        //分词前去掉标点符号
        $so->set_ignore(true);

        //是否复式分割，如“中国人”返回“中国＋人＋中国人”三个词。
        //取值可组合 (1)短词 (2)二元（将相邻的2个单字组合成一个词） (4)重要单字 (8)全部单字
        $so->set_multi(1);
        //$so->set_multi(2);

        //如果为 true 则结果中多个单字会自动按二分法聚分，如果为 false 则不处理，缺省为 false
        $so->set_duality(true);

        //要进行分词的语句  get_result
        $so->send_text($keyword);

        //获取分词结果，如果提取高频词用get_tops方法(不需要循环调用)
        //**注意** get_result每次切词后本函数应该循环调用，直到返回 false 为止，因为程序每次返回的词数是不确定的。
        while ($tmp = $so->get_result()) {
            foreach ($tmp as $v) {
                if(mb_strlen($v['word'], 'utf-8') > 1) {//过滤掉一个字的
                    $words[] = '(' . $v['word'] . ')';
                }
            }
        }

        $so->close();

        $keyword = implode("|", $words);//sphinx所需格式：(key1)|(key2)

        return $keyword;
    }

    /*sphinx全文检索php代码实现
    * @param $keyword 所需要关键词的格式 (key1)|(key2)
    * @return 搜索结果的IDS
    */
    public function sphinx($keyword){
        if (empty($keyword)) {
            return false;
        }

        $sphinx = new \SphinxClient;

        //sphinx的主机名和端口
        $sphinx->setServer('127.0.0.1',9312);

        //设置返回结果集为php数组格式
        $sphinx->SetArrayResult ( true );

        //匹配结果的偏移量，参数的意义依次为：起始位置，返回结果条数，最大匹配条数
        $sphinx->SetLimits(0, 1000, 1000); //可利用该方法进行分页，懒得写了...,这里返回1000个ID交给mysql去分页

        //匹配所有查询词(默认模式);
        $sphinx->SetMatchMode(SPH_MATCH_PHRASE);

        // 使用第二版的“扩展匹配模式”对查询进行匹配.
        $sphinx->SetMatchMode(SPH_MATCH_EXTENDED2);

        //使用多字段模式
        $sphinx->SetMatchMode(SPH_MATCH_EXTENDED);

        //最大搜索时间
        $sphinx->SetMaxQueryTime(10);

        //执行简单的搜索，这个搜索将会查询所有字段的信息(不包括设置的属性字段)
        $result = $sphinx->query($keyword,'articleindex'); //多关键词 '(配置)|(讲解)'
        //索引源是配置文件中的 articleindex ，如果有多个索引源可使用,号隔开：'email,diary' 或者使用'*'号代表全部索引源

        foreach ($result['matches'] as $key => $val){
        $id[] = $val['attrs']['aid'];
        }
        $ids = implode(',',$id);

        return $ids;
    }


}
