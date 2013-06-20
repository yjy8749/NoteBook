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
       <?php foreach ($records as $k=>$re_items):?>
       <div id="forcata<?=$k?>" class="hidden">
          <?php foreach ($re_items as $record_item):?>
        <div class="record" id="record<?=$record_item->id?>"><p class="state<?= $record_item->state?>"><?=$record_item->title?></p>
          <input type="hidden" value="<?=$record_item->id?>" id="id"/>
          <img src="img/cha.png" class="rdelete"><img src="img/bi.png" class="rupdate"><img src="img/gou.png" class="rcomp">
          <textarea class="remark" placeholder="您还未为此记录添加备注"  id="remark" ><?=$record_item->remark?></textarea>
        </div>
          <?php endforeach?>
      </div>
      <?php endforeach?>
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
      <?php foreach ($catas as $cata_item2):?>
      <div class="cata" id="cata<?=$cata_item2->id?>"> <img src="img/bz.png">
        <input type="text" readonly=true value="<?=$cata_item2->name?>" id="cata_name">
        <input type="hidden" id="id" value="<?=$cata_item2->id?>">
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
    <img src="img/x.png" class="fr" onclick="$('#msgbox').hide()"></div>
</div>
<!-- /msgbox --> 
<!-- surebox -->
<div id="surebox" class="black_overlay hidden minwh">
  <div class="error errorbg2">
    <div id="sureboxmsg" class="errormsg">提示信息</div>
    <input type="button" value="取消" onclick="$('#surebox').hide()" class="canclebtn">
    <input type="button" value="确定" class="surebtn">
    <img src="img/x.png" class="fr" onclick="$('#surebox').hide()"></div>
</div>
<!-- /surebox -->
<script type="text/javascript">
var base_url="<?=base_url()?>";
var cataid=<?=$catas[0]->id?>;
var recordid=-1;
$(function(){
  $("#addrecord").click(function(){
      addARecord();
    });
  $(".rows").mouseover(function(){  $(".rows").css("overflow","auto");});
  $(".rows").mouseleave(function(){  $(".rows").css("overflow","hidden");});
  
  $("#cata"+cataid).addClass("checked");
  $(".forcata").removeClass("forcata");
  $("#forcata"+cataid).addClass("forcata");


  $(".cata").click(function(){
    selectCata($(this));
  });
   $(".cata").mouseover(function(){
    mouseoverCata($(this));
   });
  $(".cata").mouseleave(function(){
    mouseleaveCata();
   });
    $(".record").mouseover(function(){
    mouseoverRecord($(this));
   });
    $(".record").mouseleave(function(){
    mouseleaveRecord($(this));
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
    $(".rdelete").click(function(){
    deleteRecord(recordid);
    });
    $(".rcomp").click(function(){
    compRecord();
    });

});
</script>
</body>
</html>
