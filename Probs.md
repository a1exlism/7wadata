1. [apache2 mode_rewrite enable](https://www.digitalocean.com/community/tutorials/how-to-set-up-mod_rewrite-for-apache-on-ubuntu-14-04)

2. [双入口](http://csser.work/09/23/2016/php-ci-entrance/#方案2-文件夹归类)

3. application/config/config.php line38 把index.php删掉了, 可能会出问题. 记录一下

4. [核心类扩展 core/MY_Controller](http://stackoverflow.com/questions/3678798/codeigniter-check-for-user-session-in-every-controller)
  for session check => create a MY_Controller for reusing

5. [CodeIgniter BASEPATH](http://stackoverflow.com/questions/26990196/codeigniter-basepath)

6. user/ 和 admin/ session冲突, 更改admin session其中一个字段为admin_id

7. [controller层向view层传值](http://stackoverflow.com/questions/12294527/passing-variable-from-controller-to-view-in-codeigniter)

8. excel with [js-xlsx](https://github.com/SheetJS/js-xlsx)

9. 设置自定义配置文件 /user/config/use_type.php
[refer](http://codeigniter.org.cn/user_guide/libraries/config.html)
最后打算放在core自定义的controller中进行加载(少一步)

10. Session中的user_id 实际上为username