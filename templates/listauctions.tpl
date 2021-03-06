			{foreach from=$list item=entry}
				<div class="row blockitem">
				{if $entry->class=='links'}
					<div class="col-md-2">
						<img src="{root_url}/uploads/images/products/small/{$entry->image}" class="img-responsive img-circle largepic" data-toggle="modal" data-target="#modal{$entry->id}">
						<div class="modal fade" id="modal{$entry->id}" tabindex="-1" role="dialog" aria-labelledby="Modal{$entry->id}" aria-hidden="true">

							<div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							        <h4 class="modal-title" id="myModalLabel">{$entry->pname}</h4>
							      </div>
							      <div class="modal-body">
							        <img src="{root_url}/uploads/images/products/large/{$entry->image}" class="img-responsive">
							      </div>
							    </div>
							 </div>

						</div>
					</div>

					<div class="col-md-10">
					    <div class="col-md-10 {$entry->class}">
					    	<h4 class="media-heading">{$entry->name}</h4>
					    	<p><small id={$entry->id} ></small></p>
					    	{$entry->adesc}
					    </div>
					    <div class="col-md-2">
					    	<h4>Hoogste Bod: €{$entry->bids['bprice']},-</h4>
					    	<p>
					    	{if $entry->currentdate < $entry->enddate && $entry->currentdate > $entry->startdate}
					    	<a href="{$entry->bieden}" class="btn btn-warning" role="button">Bieden</a><br/><br/>
					    	{/if}
					    	<a href="{$entry->meerinfo}" class="btn btn-warning" role="button">Meer info</a></p>
					    </div>
					</div>

					<script type="text/javascript">
						
						var start = new Date({$entry->startdate}*1000)
						// time = {$entry->startdate};
						// start.setTime(time);
						end = new Date({$entry->enddate}*1000);
						// time2 = {$entry->enddate}
						// end.setTime(time2);

						

						{literal}
						function checkTime(i) {
					    	if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
					    	return i;
						}

						
						h = checkTime(start.getHours());
						m = checkTime(start.getMinutes());

						u = checkTime(end.getHours());
						e = checkTime(end.getMinutes());

						display = 'van '+h+':'+m+' - '+start.toDateString()+' tot '+u+':'+e+' - '+end.toDateString()
						{/literal}
						dates = document.getElementById({$entry->id});
						dates.innerHTML = display;
						
					</script>


				{else}


					<div class="col-sm-2 hidden-md hidden-lg">
						<img src="{root_url}/uploads/images/products/small/{$entry->image}" class="img-responsive img-circle largepic" data-toggle="modal" data-target="#modals{$entry->id}">
						<div class="modal fade" id="modals{$entry->id}" tabindex="-1" role="dialog" aria-labelledby="Modal{$entry->id}" aria-hidden="true">
							<div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							        <h4 class="modal-title" id="myModalLabel">{$entry->pname}</h4>
							      </div>
							      <div class="modal-body">
							        <img src="{root_url}/uploads/images/products/large/{$entry->image}" class="img-responsive">
							      </div>
							    </div>
							 </div>
						</div>
					</div>
					<div class="col-md-10">
						<div class="col-md-2 hidden-sm hidden-xs">
					    	<h4>Hoogste Bod: €{$entry->bids['bprice']},-</h4>
					    	<p>
					    	{if $entry->currentdate < $entry->enddate && $entry->currentdate > $entry->startdate}
					    	<a href="{$entry->bieden}" class="btn btn-warning" role="button">Bieden</a><br/><br/>
					    	{/if}
					    	<a href="{$entry->meerinfo}" class="btn btn-warning" role="button">Meer info</a></p>
					    </div>
					    <div class="col-md-10 hidden-md hidden-lg">
					    	<h4 class="media-heading">{$entry->name}</h4>
					    	{$entry->adesc}
					    </div>
					    <div class="col-md-10 {$entry->class} hidden-sm hidden-xs">
					    	<h4 class="media-heading">{$entry->name}</h4>
					    	<p><small id={$entry->id}></small></p>
					    	{$entry->adesc}
					    </div>
					    <div class="col-md-2 hidden-md hidden-lg">
					    	<h4>Hoogste Bod: €{$entry->bids['bprice']},-</h4>
					    	<p>
					    	{if $entry->currentdate < $entry->enddate && $entry->currentdate > $entry->startdate }
					    	<a href="{$entry->bieden}" class="btn btn-warning" role="button">Bieden</a><br/><br/>
					    	{/if}
					    	<a href="{$entry->meerinfo}" class="btn btn-warning" role="button">Meer info</a></p>
					    </div>
					</div>
					<script type="text/javascript">
						
						start = new Date({$entry->startdate}*1000);
						end = new Date({$entry->enddate}*1000);

						{literal}
						function checkTime(i) {
					    	if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
					    	return i;
						}

						
						h = checkTime(start.getHours());
						m = checkTime(start.getMinutes());

						u = checkTime(end.getHours());
						e = checkTime(end.getMinutes());

						display = 'van '+h+':'+m+' - '+start.toDateString()+' tot '+u+':'+e+' - '+end.toDateString()
						{/literal}
						dates = document.getElementById({$entry->id});
						dates.innerHTML = display;
						
					</script>
					<div class="col-md-2 hidden-sm hidden-xs">
						<img src="{root_url}/uploads/images/products/small/{$entry->image}" class="img-responsive img-circle largepic" data-toggle="modal" data-target="#modalr{$entry->id}">
						<div class="modal fade" id="modalr{$entry->id}" tabindex="-1" role="dialog" aria-labelledby="Modal{$entry->id}" aria-hidden="true">
							<div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							        <h4 class="modal-title" id="myModalLabel">{$entry->pname}</h4>
							      </div>
							      <div class="modal-body">
							        <img src="{root_url}/uploads/images/products/large/{$entry->image}" class="img-responsive">
							      </div>
							    </div>
							 </div>
						</div>
					</div>

				{/if}
				</div>
			{/foreach}