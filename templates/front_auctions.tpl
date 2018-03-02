{foreach from=$list item=entry}
	<div class="col-sm-4 col-md-4">
		<div class="tumbnail">
			<img class="img-responsive img-circle img-center largepic" src="{root_url}/uploads/images/products/medium/{$entry->image}" data-toggle="modal" data-target="#modal{$entry->id}">

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

			<div class="caption center-align-text">
				<h3>{$entry->name}</h3>
				<h4>Hoogste Bod: €{$entry->bids['bprice']},-</h4>
				<p><small id={$entry->id}></small></p>
				<p>
				{if $entry->currentdate < $entry->enddate && $entry->currentdate > $entry->startdate}
				<a href="{$entry->bieden}" class="btn btn-warning" role="button">Bied</a>{/if}   <a href="{$entry->meerinfo}" class="btn btn-warning" role="button">Meer info</a></p>
				{$entry->adesc}				
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
						
		</div>
	</div>
{/foreach}
