<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=$user['name']?>--随记录</title>
<base href="<?=base_url()."res/"?>"/>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/js.js"></script>
</head>

<body>
  <input type="hidden" id="cata_id" value="<?=$catas[0]->id?>"> 
  <input type="hidden" id="record_id">
  <div class="info">
    <a><?=$user['name']?></a><a href="<?=base_url()?>login/safeexit" >安全退出</a>
  </div>
<div class="main">
  <div class="ht"></div>
  <!-- left -->
  <div class="left">
    <div>
        <input id="title" type="text" class="gist">
        <input type="button" class="btn2 btn3" value="添加" id="addrecord">
    </div>
    <div class="context">
    </div>
  </div>
  <!-- /left --> 
  <!-- right -->
  <div class="right">
    <div class="rows">
      <div class="row1"> <img src="img/ss.png">
        <input type="text" name="username" class="ss">
      </div>
      <!-- catas area -->
      <?php foreach ($catas as $cata_item):?>
      <div class="cata" id="cata<?=$cata_item->id?>"> <img src="img/bz.png">
        <input type="text" readonly value="<?=$cata_item->name?>" id="cata_name">
        <input type="hidden" id="id" value="<?=$cata_item->id?>">
        <img class="cataadd update" src="img/bi.png">
        <img class="cataadd delete" src="img/cha.png">
        <img class="cataadd add" src="img/jia.png">
      </div>
      <?php endforeach?>

    </div>

  </div>
  <!-- /right --> 
</div>
<!-- msgbox -->
<div id="msgbox" class="black_overlay hidden minwh">
  <div class="error">
    <div id="msgboxmsg" class="errormsg">提示信息</div>
    <img src="img/x.png" class="fr" onclick="msgboxclose()"></div>
</div>
<!-- /msgbox --> 
<!-- surebox -->
<div id="surebox" class="black_overlay hidden minwh">
  <div class="error errorbg2">
    <div id="sureboxmsg" class="errormsg">提示信息</div>
    <input type="button" value="取消" onclick="canclesend()" class="canclebtn">
    <input type="button" value="确定" onclick="suresend()" class="surebtn">
    <img src="img/x.png" class="fr"></div>
</div>
<!-- /surebox -->
<script type="text/javascript">
$(function(){
  $("#addrecord").click(function(){
      addARecord();
    });

  var cataid=$("#cata_id").val();
  $("#cata"+cataid).addClass("checked");

  $(".cata").click(function(){
    selectCata($(this));
  });
  
  $(".add").click(function(){
    addCata();
  });
  $(".update").click(function(){
    updateCata();
  });
  $(".delete").click(function(){
    deleteCata();
  });

});
</script>
</body>
</html>
