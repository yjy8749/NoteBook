function  testUsername(str){
	re=/^[a-zA-Z0-9]{2,12}$/g;
	return re.test(str);
}
function  testPassword(str){
	re=/^[^\u4e00-\u9fa5]{6,12}$/g;
	return re.test(str);
}
function testName(str){
	re=/^[\u4e00-\u9fa5|\w]{1,10}$/g;
	return re.test(str);
}
function setRegMsg(msg,isOk){
	var m=$(".msg");
	if(isOk){
		m.css({"color":"green"});
	}else{
		m.css({"color":"red"});
	}
	m.empty();
	m.append(msg);
}
function checkUsernameIsExist(username){
	$.ajax({
		url: base_url+"register/checkUsernameIsExist",  
		type: 'POST',  
		data:{"username":username},
		timeout: 30000,  
		error: function(){setRegMsg("检查用户名出错,请刷新页面后重试！",false);},  
		success: function(ans){ 
			if(ans!=""&&ans=="ok") {
				setRegMsg("恭喜，该用户名尚无人使用.",true);
			}else{
				setRegMsg("用户名重复请重新输入.",false);
				$("#username").focus();
			}
		}
	});
}
function checkUsername(){
	var g=$("#username");
	var uname=g.val();
	if(uname.length==0){
		return;
	}
	if(!testUsername(uname)){
		setRegMsg("用户名含有非法字符,请使用英文和数字",false);
		g.focus();
		return;
	}
	checkUsernameIsExist(uname);
}
function checkPassword1(){
	var g=$("#password1");
	var pwd1=g.val();
	if(pwd1.length==0){
		return;
	}
	if(pwd1.length<6||pwd1.length>12){
		setRegMsg("密码长度不符合要求",false);
		g.focus();
		return;
	}
	if(!testPassword(pwd1)){
		setRegMsg("请不要在密码中使用汉字",false);
		g.focus();
		return;
	}
	setRegMsg("请再输入一遍密码进行确认",true);
}
function checkPassword2(){
	var g1=$("#password1");
	var g2=$("#password2");
	var pwd1=g1.val();
	var pwd2=g2.val();
	if(pwd1.length==0){
		return;
	}
	if(pwd1!=pwd2){
		setRegMsg("两次输入密码不一致,请重新输入." ,false);
		g2.focus();
		return;
	}
	setRegMsg("请输入你的姓名或昵称.",true);
}
function checkName(){
	var g=$("#name");
	var name=g.val();
	if(name.length==0){
		return;
	}
	if(pwd1.length<1||pwd1.length>10){
		setRegMsg("姓名长度不符合要求",false);
		g.focus();
		return;
	}
	if(!testName(name)){
		setRegMsg("姓名中含有非法字符请使用英文或汉字" ,false);
		g.focus();
		return;
	}
	setRegMsg("信息收集完毕，点击提交进行注册.",true);
}
var cathtml=" <div class='cata' id='null'> <img src='img/bz.png'>"+
        "<input type='text'  placeholder='请输入新的目录名' value='' id='cata_name'>"+
        "<input type='hidden' id='id' value=''>"+
        "<img class='cataadd update' src='img/bi.png'>"+
        "<img class='cataadd delete' src='img/cha.png'>"+
        "<img class='cataadd add' src='img/jia.png'>"+
        "</div>";
function selectCata(cata){
     var cata_id=cata.find("#id") .val();
     if(cata_id!="")	{
     	cataid=cata_id;
     	$(".checked").removeClass("checked");
     	cata.addClass("checked");
     	$(".forcata").removeClass("forcata");
  	$("#forcata"+cataid).addClass("forcata");
     }
}
function addCata(){
	if($("#null").html()==null) $(".rows").append(cathtml);
	var newcata=$("#null");
	  newcata.click(function(){
	    selectCata(newcata);
	  });
	  var cname=newcata.find("#cata_name");
	  cname.focus();
	  cname.focusout(function(){
	  	if(cname.val()=="") {
	  		newcata.remove();
	  		return;
	  	}
		 $.ajax({
			url: base_url+"catas/add",  
			type: 'POST',  
			data:{"cata_name":cname.val()},
			timeout: 30000,  
			error: function(){alert("操作出错,请刷新页面后重试！");},  
			success: function(ans){ 
				if(ans!="") {
					newcata.attr('id','cata'+ans);
					newcata.find("#cata_name").attr("readonly",true);
					newcata.find("#id").val(ans);
					$('.context').append("<div id='forcata"+ans+"' class='hidden'>");
					newcata.mouseover(function(){
					    mouseoverCata();
					   });
					newcata.mouseleave(function(){
					    mouseleaveCata();
					  });
					newcata.find(".add").click(function(){
					    addCata();
					  });
					newcata.find(".update").click(function(){
					    updateCata();
					  });
					newcata.find(".delete").click(function(){
					    deleteCata();
					  });
				}else{
					newcata.remove();
				}
			}
		});
		cname.unbind("focusout");
	  });
}
function updateCata(){
	var total_cata=$("#cata"+cataid);
	var cname=total_cata.find("#cata_name");
	var cata_name=cname.val();
	cname.attr("readonly",false);
	cname.focus();
	cname.focusout(function(){
	  	if(cname.val()==""||cata_name==cname.val()) {
	  		 cname.val(cata_name);
	  	}
		else{
			$.ajax({
					url: base_url+"catas/update",  
					type: 'POST',  
					data:{"cata_name":cname.val(),"cata_id":cataid},
					timeout: 30000,  
					error: function(){alert("操作出错,请刷新页面后重试！");}
				});
			}
		cname.attr("readonly",true);
	  });
	
}
function deleteCata(){
	$(".surebtn").click(function(){
		$.ajax({
			url: base_url+"catas/delete",  
			type: 'POST',  
			data:{"cata_id":cataid},
			timeout: 30000,  
			error: function(){alert("操作出错,请刷新页面后重试！");},
			success: function(ans){ 
				$("#cata"+cataid).remove();
				$("#forcata"+cataid).remove();
			}
		});
		$('#surebox').hide()
		$('.surebtn').unbind('click');
	});
	$("#sureboxmsg").empty();
	$("#sureboxmsg").append("删除目录也将删除目录下的备忘是否继续？");
	$("#surebox").show();
}
function mouseoverCata(c){
	cataid=c.find("#id").val();
}
function mouseleaveCata(){
	cataid=$(".checked").find("#id").val();
}
function mouseoverRecord(r){
	recordid=r.find("#id").val();
	var remark=r.find("#remark");
	remark.textareaAutoHeight();
	remark.trigger("change");
}
function mouseleaveRecord(r){
	recordid=-1;
}

var recordHTML="<div class='record'>"+
        "<p></p>"+
        "<img src='img/cha.png'><img src='img/bi.png'><img src='img/gou.png'>"+
      "</div>";
function  addARecord(){
	var t=$("#title")
	if(t.val()!=""){
		 $.ajax({
			url: base_url+"records/add",  
			type: 'POST',  
			data:{"cata_id":cataid,"title":t.val()},
			timeout: 30000,  
			error: function(){alert("操作出错,请刷新页面后重试！");},  
			success: function(ans){ 
					if(ans!="") {
					var recordHTML="<div class='record' id='record"+ans+
						"'><p>"+t.val()+"</p>"+
						"<input type='hidden' value='"+ans+"' id='id'/>"+
						"<img src='img/cha.png' class='rdelete'><img src='img/bi.png' class='rupdate'><img src='img/gou0.png' class='rcomp'>"+
						"<textarea class='remark' placeholder='您还未为此记录添加备注'  id='remark' ></textarea>"+
						"</div>";
					$("#forcata"+cataid).prepend(recordHTML);
					var newrecord=$("#record"+ans);
					newrecord.mouseover(function(){mouseoverRecord($(this));});					
					newrecord.mouseleave(function(){mouseleaveRecord($(this));});

					newrecord.find(".rdelete").click(function(){deleteRecord(recordid);});
					newrecord.find(".rcomp").click(function(){compRecord();});
					newrecord.find(".rupdate").click(function(){updateRecord(recordid);});

				}
			}
		});
	}
}

function deleteRecord(click_id){
	$(".surebtn").click(function(){
		$.ajax({
			url: base_url+"records/delete",  
			type: 'POST',  
			data:{"record_id":click_id},
			timeout: 30000,  
			error: function(){alert("操作出错,请刷新页面后重试！");},
			success: function(ans){ 
				$("#record"+click_id).remove();
			}
		});
		$('#surebox').hide()
		$('.surebtn').unbind('click');
	});
	$("#sureboxmsg").empty();
	$("#sureboxmsg").append("是否删除该备忘记录？");
	$("#surebox").show();
}
function compRecord(){
	$.ajax({
		url: base_url+"records/comp",  
		type: 'POST',  
		data:{"record_id":recordid},
		timeout: 30000,  
		error: function(){alert("操作出错,请刷新页面后重试！");},
		success: function(ans){ 
			if(ans!=""){
				var rr=$("#record"+recordid);
				var rp=rr.find('p');
				rp.removeClass();
				rp.addClass('state'+ans);
				if(ans==1){
					$("#forcata"+cataid).append(rr);
					rr.find(".rcomp").attr({"src":"img/gou1.png"});
				}else{
					$("#forcata"+cataid).prepend(rr);
					rr.find(".rcomp").attr({"src":"img/gou0.png"});
				}
			}
		}
	});
}
function updateRecord(click_id){
	var record=$("#record"+click_id);
	var oldtitle=record.find("p").text();
	var oldremark=record.find("#remark").val();
	$(".surebtn2").click(function(){
		var title=$("#edittitle").val();
		var remark=$("#editremark").val();
		if(title!=oldtitle||remark!=oldremark){
			$.ajax({
				url: base_url+"records/update",  
				type: 'POST',  
				data:{"record_id":click_id,"title":title,"remark":remark},
				timeout: 30000,  
				error: function(){alert("操作出错,请刷新页面后重试！");},
				success: function(ans){ 
					if(ans!=""&&ans=="ok"){
						record.find("p").text(title);
						record.find("#remark").val(remark);
					}
				}
			});
		}
		$('#editbox').hide()
		$('.surebtn2').unbind('click');
	});
	$("#edittitle").val(oldtitle);
	$("#editremark").val(oldremark);
	$("#editbox").show();
}