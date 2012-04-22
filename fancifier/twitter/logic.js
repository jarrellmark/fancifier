
var last = '';
var timeOut;

function getTweets(id){
		$.getJSON("server.php?start="+id,
		function(data){
				$.each(data, function(count,item){
						addNew(item);
						last = item.id;
				});
		});
}

function addNew(item){
		if($('#tweets div.tweet').length>9){ //If we have more than nine tweets
				$('#tweets div.tweet:first').toggle(300);//remove it form the screen
				$('#tweets div.tweet:first').removeClass('tweet');//and it's class
				$("#tweets div:hidden").remove(); //sweeps the already hidden elements
		}
		$('#tweets').append(renderTweet(item, 'hidden'));
}

function renderTweet(item){
		importanceColor=getImportanceColor(item.followers_count);
		return '<div class="tweet" id="'+item.id+'">'+
		'<strong><a href="http://twitter.com/'+item.screen_name+'" style="color:'+importanceColor+'">'+
		item.screen_name+'</a></strong><span class="text">'+
		item.text
		+'</span><span class="created_at"><br /><a href="http://twitter.com/'+
		item.screen_name+'/status/'+item.id+'">'+
		item.created_at+'</span></div>';
}

function getImportanceColor(number){
		rgb = 255-Math.floor(16*(Math.log(number+1)+1)); //should return about 0 for 0 followers and 255 for 4million (Ashton Kutchner? Obama?)
		return 'rgb('+rgb+',0,0)';
}

function poll(){
		timeOut = setTimeout('poll()', 200);//It calls itself every 200ms
		getTweets(last);
}

$(document).ready(function() {
		poll();		
});