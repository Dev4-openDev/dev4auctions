			{foreach from=$list item=entry}
				<div class="media blockitem">
				  <a class="{$entry->class}" href="#">
				    <img src="uploads/veilingnpo/images/primsmall.png" class="img-responsive img-circle" alt="...">
				  </a>
				  <div class="media-body">
				     <div class="col-md-8">
				     	<h4 class="media-heading">{$entry->name}</h4>
				    	{$entry->adesc}
				    	<h4>{$entry->pname}</h4>
				    	{$entry->pdesc}
				    </div>
				    <div class="col-md-4">
				    <h4>Hoogste Bod: {$entry->bids['bprice']}</h4>
				    <p><a href="#" class="btn btn-warning" role="button">Breng een bod uit</a></p>
				    </div>
				  </div>
				</div>
				{/foreach}