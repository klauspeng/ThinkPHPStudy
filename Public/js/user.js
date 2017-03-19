/**
 * Created by Administrator on 2016/9/12.
 */
var url = 'http://localhost:8888/';
function register(){
    var name = $('#name');
    var password = $('#password');
    var password2 = $('#password2');
    var type = $('#type');
    if(name.val() == ''){
        $('#msg').html('用户名不能为空');
        return false;
    }
    if(password.val() == '' || password2.val() ==''){
        $('#msg').html('密码不能为空');
        return false;
    }
    if(password.val() != password2.val()){
        $('#msg').html('两次密码不同，请检查');
        return false;
    }
    if(type.val() == 1){
        $('#msg').html('请选择用户类型');
        return false;
    }
    $('#msg').html('');
    $.ajax({
        //提交数据的类型 POST GET
        type:"POST",
        url:url+"home/user/register",
        async: false,
        data:{
            name:name.val(),
            password:password.val(),
            password2:password2.val(),
            type:type.val()
        },
        //在请求之前调用的函数
        success:function(data){
            if(data == 1){
                $('#msg').html('用户名已注册');
            }else{
                $('#msg').html('注册成功');
                window.location.href=url+"home/index/login";
            }
        },
        error: function(){
            alert('错误,请联系管理员');
        }
    });
}

//登录
function login(){
    var name = $('#name');
    var password = $('#password');
    if(name.val() == ''){
        $('#msg').html('请输入用户名');
        return false;
    }
    if(password.val() == ''){
        $('#msg').html('请输入密码');
        return false;
    }
    $('#msg').html('');
    $.ajax({
        //提交数据的类型 POST GET
        type:"POST",
        url:url+"home/user/login",
        async: false,
        data:{
            name:name.val(),
            password:password.val()
        },
        //在请求之前调用的函数
        success:function(data){
            if(data == 1){
                $('#msg').html('用户应未注册');
            }else if(data == 2){
                $('#msg').html('登录成功');
                window.location.href=url;
            }else if(data == 3){
                $('#msg').html('密码错误');
            }
        },
        error: function(){
            alert('错误,请联系管理员');
        }
    });
}
