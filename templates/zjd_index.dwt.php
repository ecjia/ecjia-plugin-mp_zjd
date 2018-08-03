<!-- {nocache} -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=8,IE=9,IE=10,IE=11"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>砸金蛋</title>
    <link rel="stylesheet" type="text/css" href="{$css_url}">
</head>
<body>
<div class="grid">
		<div id="hammer"><img src="{$img6}" height="87" width="74" alt=""></div>
		<div id="f"><img src="{$img4}" /></div>
		<div id="banner">
			  <dl>
			    <dt>
			      <a href="javascript:;"><img src="{$egg1}" ></a>
			      <a href="javascript:;"><img src="{$egg1}" ></a>
			      <a href="javascript:;"><img src="{$egg1}" ></a>
			      <a href="javascript:;"><img src="{$egg1}" ></a>
			      <a href="javascript:;"><img src="{$egg1}" ></a>
			      <a href="javascript:;"><img src="{$egg1}" ></a>
			      <a href="javascript:;"><img src="{$egg1}" ></a>
			    </dt>
			    <dd></dd>
			  </dl>
		</div>
		
		<div class="block">
			<div class="title">剩余次数</div>
			<div class="content">
				<p>您当前还剩余<span style="font-size: 16px;"> {if $prize_num lt 0} 0 {else} {$prize_num} {/if} </span>次抽奖机会</p>
			</div>
		</div>
		<div class="block">
			<div class="title">活动规则</div>
			<div class="content">
				<p>{$description}</p>
			</div>	
		</div>
		<div class="block">
			<div class="title">奖项设置</div>
			{if $prize}
			<div class="content">
				<!-- {foreach from=$prize item=val }-->
				 	
				  	<p>
				  	{if $val.prize_level eq '0'}
				  		特等奖：
				  	{elseif $val.prize_level eq '1'}
				  		一等奖：
				  	{elseif $val.prize_level eq '2'}
				  		二等奖：
				  	{elseif $val.prize_level eq '3'}
				  		三等奖：
				  	{elseif $val.prize_level eq '4'}
				  		四等奖：
				  	{elseif $val.prize_level eq '5'}
				  		五等奖：
				  	{/if}
				  	{$val.prize_name}{$val.prize_value}(剩余奖品数量：{$val.prize_number})</p>
			 	<!-- {/foreach} -->
			</div>
			{else}
			 	 <p>暂无设置</p>
			{/if}
		</div>
		<div class="block">
			<div class="title">中奖记录</div>
			{if $list}
			<div class="content">
				 <!-- {foreach from=$list item=val}-->
				   <p> {$val.user_name} 获得奖品 ：{$val.prize_name}{if $val.prize_type eq '1' || $val.prize_type eq '3'}（{$val.prize_value}）{/if}</p>
				 <!-- {/foreach} -->
			</div>	 
			{else}
			 	 <p>暂无获奖记录</p>
			{/if}
		</div>
	</div>
<div id="mask"></div>
<div id="dialog" class="yes">
    <div id="content"></div>
    <a href="javascript:;" id="link">去看看</a>
    <button id="close">关闭</button>
</div>
<!-- 我的奖品 -->
<div class="content" style="margin: 0 auto;text-align:center">
    <a href="{$prize_url}"><img style="width: 50%" src="{$my_prize}" ></a>
</div>
<div style="margin-bottom: 10px"></div>


</body>
</html>


<script type="text/javascript" src="{$jq_url}"></script>
<script>
    $(function() {
//        var ISWeixin = !!navigator.userAgent.match(/MicroMessenger/i); //wp手机无法判断
//         if(!ISWeixin){
//             var rd_url = location.href.split('#')[0];  // remove hash
//             var oauth_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=APPID&redirect_uri='+encodeURIComponent(rd_url) + '&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
//             location.href = oauth_url;
//             return false;
//         }
        var timer,forceStop;
        var wxch_Marquee = function(id){
            try{
                document.execCommand("BackgroundImageCache", false, true);
                }
            catch(e){
               };
            var container = document.getElementById(id),
                original = container.getElementsByTagName("dt")[0],
                clone = container.getElementsByTagName("dd")[0],
                speed = arguments[1] || 10;
            clone.innerHTML=original.innerHTML;
            var rolling = function(){
                if(container.scrollLeft == clone.offsetLeft){
                    container.scrollLeft = 0;
                }else{
                    container.scrollLeft++;
                }
            }
            this.stop = function() {
                clearInterval(timer);
            }
            timer = setInterval(rolling,speed);//设置定时器
            container.onmouseover=function() {
                clearInterval(timer)
                }//鼠标移到marquee上时，清除定时器，停止滚动
            container.onmouseout=function() {
                if (forceStop) return;
                timer=setInterval(rolling,speed);
            }//鼠标移开时重设定时器
        };

        var wxch_stop = function() {
            clearInterval(timer);
            forceStop = true;
        };
        var wxch_start = function() {
            forceStop = false;
            wxch_Marquee("banner",20);
        };

        wxch_Marquee("banner",20);

        var $egg;

        $("#banner a").on('click',function() {
            wxch_stop();
            $egg = $(this);
            var offset = $(this).position();
            $hammer = $("#hammer");
            $hammer.animate({ left:(offset.left+30) }, 1000,function(){
                $(this).addClass('hit');
                $("#f").css('left',offset.left).show();
                $egg.find('img').attr('src','{$egg2}');
                setTimeout(function() {
                    wxch_result.call(window);
                }, 500);
            });
        });

        $("#mask").on('click',function() {
            $(this).hide();
            $("#dialog").hide();
            $egg.find('img').attr('src','{$egg1}');
            $("#f").hide();
            $("#hammer").css('left','-74px').removeClass('hit');
            wxch_start();
        });

        $("#close").click(function() {
            $("#mask").trigger('click');
            window.location.reload();
        });

        function wxch_result () {
            var url = '{$form_action}';
            $.get(url,{}, function(data){
                $("#mask").show();
                if(data.status == 1){
                    var success= '撒花，恭喜您获得'+'"'+data.msg+'"';
                    $("#content").html(success);
                    $(".num").html(data.num);
                    $("#link").attr("href", data.link);
                    $("#dialog").attr("class",'yes').show();
                }
                else if(data.status == 0){
                    var success= '撒花，恭喜您获得'+'"'+data.msg+'"';
                    $("#content").html(success);
                    $(".num").html(data.num);
                    $("#dialog").attr("class",'no').show();
                }
                else if(data.status == 2){
                    $("#content").html(data.msg);
                    $("#dialog").attr("class",'no').show();
                }
            }, 'json');
        }
    });

</script>
<!-- {nocache} -->