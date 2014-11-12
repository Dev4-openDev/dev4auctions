			{foreach from=$list item=entry}
				<div class="row blockitem">
				{if $entry->class=='links'}
					<div class="col-md-2">
						<img src="uploads/veilingnpo/images/primsmall.png" class="img-responsive img-circle" alt="...">
					</div>
					<div class="col-md-10">
					    <div class="col-md-10 {$entry->class}">
					    	<h4 class="media-heading">{$entry->name}</h4>
					    	{$entry->adesc}
					    	<h4>{$entry->pname}</h4>
					    	{$entry->pdesc}
					    </div>
					    <div class="col-md-2">
					    	<h4>Hoogste Bod: €{$entry->bids['bprice']},-</h4>
					    	<p><a href="#" class="btn btn-warning" role="button">Breng een bod uit</a></p>
					    </div>
					</div>
				{else}
					<div class="col-sm-2 hidden-md hidden-lg">
						<img src="uploads/veilingnpo/images/primsmall.png" class="img-responsive img-circle" alt="...">
					</div>
					<div class="col-md-10">
						<div class="col-md-2 hidden-sm hidden-xs">
					    	<h4>Hoogste Bod: €{$entry->bids['bprice']},-</h4>
					    	<p><a href="#" class="btn btn-warning" role="button">Breng een bod uit</a></p>
					    </div>
					    <div class="col-md-10 hidden-md hidden-lg">
					    	<h4 class="media-heading">{$entry->name}</h4>
					    	{$entry->adesc}
					    	<h4>{$entry->pname}</h4>
					    	{$entry->pdesc}
					    </div>
					    <div class="col-md-10 {$entry->class} hidden-sm hidden-xs">
					    	<h4 class="media-heading">{$entry->name}</h4>
					    	{$entry->adesc}
					    	<h4>{$entry->pname}</h4>
					    	{$entry->pdesc}
					    </div>
					    <div class="col-sm-2 hidden-md hidden-lg">
					    	<h4>Hoogste Bod: €{$entry->bids['bprice']},-</h4>
					    	<p><a href="#" class="btn btn-warning" role="button">Breng een bod uit</a></p>
					    </div>
					</div>
					<div class="col-md-2 hidden-sm hidden-xs">
						<img src="uploads/veilingnpo/images/primsmall.png" class="img-responsive img-circle" alt="...">
					</div>
				{/if}
				</div>
			{/foreach}