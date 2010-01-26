<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <script type="text/javascript" src="mootools-1.2.4-core.js"></script>
        <script type="text/javascript">
            //<![CDATA[

            window.addEvent('domready', function() {
				$('add').addEvent('click',function(){
					var parent = $('list');
					var el = new Element('input',{name:'test[]'});
                                        var el1 = new Element('button', {name:'aa', value:'aa'});
					el.inject(parent);
                                        el1.inject(parent);
					return false;
				})
//        			$('add').addEvent('click',function(){
//					var parent = $('list');
//					var el = new Element('input',{name:'test[]'});
//					el.inject(parent);
//					return false;
//				})
				$('act4').addEvent('click',function(){
					var parent = $('form2');
					parent.set('action','?type=4');
					alert('表单form2的action被修改为?type=4,并开始触发提交');
					parent.submit();
					return false;
				})
				$('act5').addEvent('click',function(){
					var parent = $('form2');
					parent.set('action','?type=5');
					alert('表单form2的action被修改为?type=5,并开始触发提交');
					parent.submit();
					return false;
				})
				$('act6').addEvent('click',function(){
					var parent = $('form2');
					parent.set('action','?type=6');
					alert('表单form2的action被修改为?type=6,并开始触发提交');
					parent.submit();
					return false;
				})
            })
            //]]>

        </script> 
        <title>后台管理 &rsaquo; 首页</title>
    </head>
    <body>
		<h3>新建按钮</h3>
        <form action="?type=1" method="post" id="form">
            <div id="list">
                <input name="test[]" />
            </div>
            <button id="add">添加按钮</button>
			<input type="submit"/>
        </form>
		<h3>单一表单单地址多功能</h3>
		<form action="?type=2" method="post" id="form">
            <div>
                <input name="test[]" />
            </div>
			<input type="submit" name="act1" value="act1"/>
			<input type="submit" name="act2" value="act2"/>
			<input type="submit" name="act3" value="act3"/>
        </form>
		<h3>单一表单多地址多功能</h3>
		<form action="?type=2" method="post" id="form2">
            <div>
                <input name="test[]" />
            </div>
			<input type="submit" name="act4" id="act4" value="act4"/>
			<input type="submit" name="act5" id="act5" value="act5"/>
			<input type="submit" name="act6" id="act6" value="act6"/>
        </form>
    </body>
</html>

<?php

$type = $_GET['type'];
switch($type){
	case '1':
		//var_dump($_POST);
		break;
	case '2':
		if(isset($_POST['act1'])){
			echo '操作为act1';
		}
		if(isset($_POST['act2'])){
			echo '操作为act2';
		}
		if(isset($_POST['act3'])){
			echo '操作为act1';
		}
		break;
	default:
		//var_dump(array('type'=>$type));
		break;
}
